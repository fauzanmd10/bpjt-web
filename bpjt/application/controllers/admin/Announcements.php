<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements extends CI_Controller {
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('artikel_pengumuman', $this->session->userdata('user_group_id'));
		$this->user_access = $this->user_access[0];
		if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
			echo json_encode(array('status'=>'fail', 'code'=>1));
			exit;
		}
	}

	public function index() {
		$this->load->model('comment');

		$breadcrumbs = array(
			'#' => 'Artikel',
			'' => 'Pengumuman'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.announcement.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Pengumuman'), true),
			'content' => $this->load->view('admin/announcements/index', array('flash'=>$this->session->flashdata('announcement_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function add($filled_value=null) {
		$this->load->model(array('content', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Artikel',
			'admin/announcements' => 'Pengumuman',
			'' => 'Tambah Pengumuman'
		);
		$jscripts = array(
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			'ckeditor/ckeditor.js'=>'vendor',
			//'tinymce/jquery.tinymce.js'=>'vendor',
			//'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('admin.announcement.form.css');
		$announcement = null;
		if (isset($filled_value)) {
			$announcement = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Tambah Pengumuman'), true),
			'content' => $this->load->view('admin/announcements/add', array('announcement'=>$announcement), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('content', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('announcement', 'Pengumuman / Announcement', 'trim|callback_check_announcement');
			$this->form_validation->set_message('check_announcement', 'Minimal salah satu pengumuman Bahasa Indonesia atau Bahasa Inggris harus terisi.');

			if ($this->form_validation->run()) {
				if ($this->input->post('announcement_id',true) != "") {
					$data_id = array(
						'title'=>"",
						'slug'=>$this->create_slug(strip_tags($this->input->post('announcement_id',true))),
						'content'=>$this->input->post('announcement_id',true),
						'content_type'=>'pengumuman',
						'sub_content_type'=>'',
						'status'=>$this->input->post('status_id',true),
						'lang'=>'id',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->content->insert($data_id);
					$content_id = $this->db->insert_id();
				}

				if ($this->input->post('announcement_en',true) != "") {
					$data_en = array(
						'title'=>"",
						'slug'=>$this->create_slug(strip_tags($this->input->post('announcement_en',true))),
						'content'=>$this->input->post('announcement_en',true),
						'content_type'=>'pengumuman',
						'sub_content_type'=>'',
						'status'=>$this->input->post('status_en',true),
						'lang'=>'en',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->content->insert($data_en);

					if (!isset($content_id)) {
						$content_id = $this->db->insert_id();
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $content_id, 'Pengguna menambahkan data pengumuman');

				redirect('admin/announcements/');
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('content', 'comment'));
		$this->load->helper('form');

		$announcement = $this->content->get_content($id);

		if (!empty($announcement)) {
			$breadcrumbs = array(
				'#' => 'Artikel',
				'admin/announcements' => 'Pengumuman',
				'' => 'Ubah Pengumuman'
			);
			$jscripts = array(
				'jquery.validate.min.js'=>'vendor',
				'jquery.tagsinput.min.js'=>'vendor',
				'jquery.autogrow-textarea.js'=>'vendor',
				'charCount.js'=>'vendor',
				'ui.spinner.min.js'=>'vendor',
				'chosen.jquery.min.js'=>'vendor',
				'forms.js'=>'vendor',
				'ckeditor/ckeditor.js'=>'vendor',
				//'tinymce/jquery.tinymce.js'=>'vendor',
				//'wysiwyg.js'=>'vendor'
			);
			$stylesheets = array('admin.announcement.form.css');

			if (isset($filled_value)) {
				$announcement[0]->content = $filled_value['content'];
				$announcement[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Ubah Pengumuman'), true),
				'content' => $this->load->view('admin/announcements/edit', array('announcement'=>$announcement[0], 'id'=>$id), true),
				'jscripts' => $jscripts,
				'stylesheets' => $stylesheets,
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function update($id) {
		if ($this->input->post()) {
			$this->load->model(array('content', 'user_log'));
			$this->load->library('form_validation');

			$announcement = $this->content->get_content($id);

			if (!empty($announcement)) {
				$this->form_validation->set_rules('announcement', 'Pengumuman / Announcement', 'trim|callback_check_announcement');
				$this->form_validation->set_message('check_announcement', 'Minimal salah satu pengumuman Bahasa Indonesia atau Bahasa Inggris harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'content'=>$this->input->post('announcement',true),
						'status'=>$this->input->post('status',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->content->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $id, 'Pengguna mengubah data pengumuman');

					redirect('admin/announcements/');
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('content', 'user_log'));
		$content = $this->content->get_content($id);
		$content = $content[0];
		if ($content->status != "deleted") {
			if ($content->status == "published") {
				$data = array(
					'status'=>'draft',
					'updated_at'=>date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'status'=>'published',
					'updated_at'=>date('Y-m-d H:i:s')
				);
			}

			$this->content->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $id, 'Pengguna mengubah status data pengumuman');

			$this->session->set_flashdata('announcement_success', true);
			redirect('admin/announcements');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('announcement_ids',true)) {
			$this->load->model(array('content', 'user_log'));
			$announcement_ids = $this->input->post('announcement_ids',true);
			foreach($announcement_ids as $announcement_id) {
				$this->content->destroy($announcement_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $announcement_id, 'Pengguna menghapus data pengumuman');
			}
			
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_announcements() {
		$this->load->model('content');
		$announcements = $this->content->get_contents_by_content_type("pengumuman");

		$ret_announcements = array();
		$no = 1;
		foreach($announcements as $announcement) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $announcement->id . "\" id=\"checker-" . $announcement->id . "\" /></span></div></span>";
			$created_at = strtotime($announcement->created_at);
    		$updated_at = strtotime($announcement->updated_at);
    		$lang = ($announcement->lang == "id") ? "Indonesia" : "Inggris";
    		if ($this->user_access->edit) {
	    		if ($announcement->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/announcements/update_status/' . $announcement->id) . "\" class=\"announcement-status\" data-id=\"" . $announcement->id . "\" id=\"announcement-status-" . $announcement->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/announcements/update_status/' . $announcement->id) . "\" class=\"announcement-status\" data-id=\"" . $announcement->id . "\" id=\"announcement-status-" . $announcement->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_announcement = array($checkbox, $no, $announcement->content, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $lang);
			array_push($ret_announcements, $temp_announcement);
			$no++;
		}
		$json = array('aaData'=>$ret_announcements);

		echo json_encode($json);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_announcement() {
		if ($this->input->post('announcement',true)) {
			$title = $this->input->post('announcement',true);

			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else {
			$title_id = $this->input->post('announcement_id',true);
			$title_en = $this->input->post('announcement_en',true);

			if ($title_id == "" && $title_en == "") {
				return false;
			} else {
				return true;
			}
		}
	}
}

/* End of file article_categories.php */
/* Location: ./application/controllers/admin/article_categories.php */