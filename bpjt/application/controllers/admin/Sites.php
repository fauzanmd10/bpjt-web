<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('situs_terkait', $this->session->userdata('user_group_id'));
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
			'#' => 'Pengaturan',
			'' => 'Situs Terkait'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.site.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Situs Terkait'), true),
			'content' => $this->load->view('admin/sites/index', array('flash'=>$this->session->flashdata('sites_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('content', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Pengaturan',
			'admin/sites' => 'Situs Terkait',
			'' => 'Lihat Situs Terkait'
		);

		$site = $this->content->get_content($id);
		$logo = $this->content->get_content_meta($id, 'logo');
		if (count($site) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Lihat Situs Terkait'), true),
				'content' => $this->load->view('admin/sites/show', array('site'=>$site[0], 'logo'=>$logo, 'flash'=>$this->session->flashdata('site_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		$this->load->model(array('content', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Pengaturan',
			'admin/sites' => 'Situs Terkait',
			'' => 'Tambah Situs Terkait'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js'=>'vendor',
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			'tinymce/jquery.tinymce.js'=>'vendor',
			'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'admin.album.form.css');
		$site = null;
		if (isset($filled_value)) {
			$site = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Tambah Situs Terkait'), true),
			'content' => $this->load->view('admin/sites/add', array('site'=>$site), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		if ($this->input->post()) {
			$this->load->model(array('content', 'user_log'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('logo_id', 'Logo', 'trim|callback_check_imagetype');
			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			$this->form_validation->set_message('check_name', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_imagetype', 'Silakan ganti file karena file tidak dikenal.');


			if ($this->form_validation->run()) {
				$data_id = array(
					'title'=>$this->input->post('title_id',true),
					'slug'=>'logo/' . $this->create_slug($this->input->post('title_id',true)),
					'content'=>$this->input->post('content_id',true),
					'content_type'=>$this->input->post('content_type',true),
					'sub_content_type'=>$this->input->post('sub_content_type',true),
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->content->insert($data_id);
				$site_id = $this->db->insert_id();

				if ($_FILES['logo_id']['error'] != UPLOAD_ERR_NO_FILE) {
					$mime = mime_content_type($_FILES['logo_id']['tmp_name']);
					if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
						$filename = $_FILES['logo_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[1];
						$filetype = $_FILES['logo_id']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/front/img/sites/';
						// echo $upload_dir;exit();
						// if (!is_dir($upload_dir)) {
						// 	mkdir($upload_dir, 0777, true);
						// }

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_imagepath = base_url() . 'front/img/sites/' . $new_filename;
							// echo $new_imagepath;exit();
						move_uploaded_file($_FILES['logo_id']['tmp_name'], $upload_dir . $new_filename);
				
						$data = array(
							'content_id'=>$site_id,
							'meta_key'=>'logo',
							'meta_value'=>$new_imagepath
						);
						$this->content->insert_meta($data);
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $site_id, 'Pengguna menambah data situs terkait');

				$this->session->set_flashdata('sites_success', true);
				redirect('admin/sites/show/' . $site_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		$this->load->model(array('content', 'comment'));
		$this->load->helper('form');

		$site = $this->content->get_content($id);

		if (count($site)  > 0) {
			$breadcrumbs = array(
				'#' => 'Pengaturan',
				'admin/sites' => 'Situs Terkait',
				'' => 'Ubah Situs Terkait'
			);
			$jscripts = array(
				'bootstrap-fileupload.min.js'=>'vendor',
				'jquery.validate.min.js'=>'vendor',
				'jquery.tagsinput.min.js'=>'vendor',
				'jquery.autogrow-textarea.js'=>'vendor',
				'charCount.js'=>'vendor',
				'ui.spinner.min.js'=>'vendor',
				'chosen.jquery.min.js'=>'vendor',
				'forms.js'=>'vendor',
				'tinymce/jquery.tinymce.js'=>'vendor',
				'wysiwyg.js'=>'vendor'
			);
			$stylesheets = array('bootstrap-fileupload.min.css', 'admin.album.form.css');

			if (isset($filled_value)) {
				$site[0]->title = $filled_value['title'];
				$site[0]->content = $filled_value['content'];
				$site[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Ubah Situs Terkait'), true),
				'content' => $this->load->view('admin/sites/edit', array('site'=>$site[0], 'id'=>$id), true),
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

			$site = $this->content->get_content($id);

			if (count($site) > 0) {
				$this->form_validation->set_rules('logo', 'Logo', 'trim|callback_check_type');
				$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
				$this->form_validation->set_message('check_name', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');
				$this->form_validation->set_message('check_type', 'Silakan ganti file karena file tidak dikenal.');

				if ($this->form_validation->run()) {
					$data = array(
						'title'=>$this->input->post('title',true),
						'slug'=>'logo/' . $this->create_slug($this->input->post('title',true)),
						'content'=>$this->input->post('content',true),
						'content_type'=>$this->input->post('content_type',true),
						'sub_content_type'=>$this->input->post('sub_content_type',true),
						'lang'=>'id',
						'status'=>$this->input->post('status',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					if ($_FILES['logo']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['logo']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
							$filename = $_FILES['logo']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[1];
							$filetype = $_FILES['logo']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/front/img/sites/';

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0777, true);
							}

							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'front/img/sites/' . $new_filename;

							move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir . '/' . $new_filename);

							$data_meta = array(
								'content_id'=>$id,
								'meta_key'=>'logo',
								'meta_value'=>$new_imagepath
							);

							$this->content->remove_meta($id, 'logo');
							$this->content->insert_meta($data_meta);
						}
					}

					$this->content->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $id, 'Pengguna mengubah data situs terkait');

					$this->session->set_flashdata('sites_success', true);
					redirect('admin/sites/show/' . $id);
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
		$site = $this->content->get_content($id);
		$site = $site[0];
		if ($site->status != "deleted") {
			if ($site->status == "published") {
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

			$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $id, 'Pengguna mengubah status data situs terkait');

			$this->session->set_flashdata('sites_success', true);
			redirect('admin/sites');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('site_ids',true)) {
			$this->load->model(array('content', 'user_log'));
			$site_ids = $this->input->post('site_ids',true);
			foreach($site_ids as $site_id) {
				$this->content->destroy($site_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $site_id, 'Pengguna menghapus data situs terkait');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_sites() {
		$this->load->model('content');
		$sites = $this->content->get_contents_by_content_type("site");

		$ret_sites = array();
		$no = 1;
		foreach($sites as $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);

    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/sites/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/sites/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_site = array($checkbox, $no, $value->title, $value->content, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_sites, $temp_site);
			$no++;
		}
		$json = array('aaData'=>$ret_sites);

		echo json_encode($json);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_name() {
		if ($this->input->post('title',true)) {
			$title = $this->input->post('title',true);

			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else {
			$title_id = $this->input->post('title_id',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_imagetype() {

		if ($_FILES['logo_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['logo_id']['tmp_name']);
			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		}
			return false;
	}

	public function check_type() {
		$this->session->unset_userdata('idUser');
		
		if (@$_FILES['logo']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['logo']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} 
		return false;
	}

	
}