<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bujts extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('progres_konstruksi_daftar_bujt', $this->session->userdata('user_group_id'));
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
			'#' => 'Progres Konstruksi',
			'' => 'BUJT'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.bujt.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'BUJT'), true),
			'content' => $this->load->view('admin/bujts/index', array('flash'=>$this->session->flashdata('bujts_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('bujt', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Progres Konstruksi',
			'admin/bujts' => 'BUJT',
			'' => 'Lihat BUJT'
		);

		$bujt = $this->bujt->get_bujt($id);
		if (count($bujt) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Lihat BUJT'), true),
				'content' => $this->load->view('admin/bujts/show', array('bujt'=>$bujt[0], 'flash'=>$this->session->flashdata('bujt_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('bujt', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Progres Konstruksi',
			'admin/bujts' => 'BUJT',
			'' => 'Tambah BUJT'
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
		$stylesheets = array('admin.album.form.css');
		$bujt = null;
		if (isset($filled_value)) {
			$bujt = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Tambah BUJT'), true),
			'content' => $this->load->view('admin/bujts/add', array('bujt'=>$bujt), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('bujt', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			$this->form_validation->set_message('check_title', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');

			if ($this->form_validation->run()) {
				$data_id = array(
					'name'=>$this->input->post('name_id',true),
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->bujt->insert($data_id);
				$bujt_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'bujts', $bujt_id, 'Pengguna menambah data BUJT');

				$this->session->set_flashdata('bujts_success', true);
				redirect('admin/bujts/show/' . $bujt_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('bujt', 'comment'));
		$this->load->helper('form');

		$bujt = $this->bujt->get_bujt($id);

		if (count($bujt > 0)) {
			$breadcrumbs = array(
				'#' => 'Progres Konstruksi',
				'admin/bujts' => 'BUJT',
				'' => 'Ubah BUJT'
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
			$stylesheets = array('admin.album.form.css');

			if (isset($filled_value)) {
				$bujt[0]->name = $filled_value['name'];
				$bujt[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Ubah BUJT'), true),
				'content' => $this->load->view('admin/bujts/edit', array('bujt'=>$bujt[0], 'id'=>$id), true),
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
			$this->load->model(array('bujt', 'user_log'));
			$this->load->library('form_validation');

			$bujt = $this->bujt->get_bujt($id);

			if (count($bujt) > 0) {
				$this->form_validation->set_rules('name', 'Nama / Name', 'trim|required');
				$this->form_validation->set_message('required', 'Nama / Name harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'name' => $this->input->post('name',true),
						'status' => $this->input->post('status',true),
						'updated_at' => date('Y-m-d H:i:s')
					);

					$this->bujt->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'bujts', $id, 'Pengguna mengubah data BUJT');

					$this->session->set_flashdata('bujts_success', true);
					redirect('admin/bujts/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('bujt', 'user_log'));
		$bujt = $this->bujt->get_bujt($id);
		$bujt = $bujt[0];
		if ($bujt->status != "deleted") {
			if ($bujt->status == "published") {
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

			$this->bujt->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'bujts', $id, 'Pengguna mengubah status data BUJT');

			$this->session->set_flashdata('bujts_success', true);
			redirect('admin/bujts');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('bujt_ids',true)) {
			$this->load->model(array('bujt', 'user_log'));
			$bujt_ids = $this->input->post('bujt_ids',true);
			foreach($bujt_ids as $bujt_id) {
				$this->bujt->destroy($bujt_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'bujts', $bujt_id, 'Pengguna menghapus data BUJT');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_bujts() {
		$this->load->model('bujt');
		$bujts = $this->bujt->fetch_bujts("", "", null);

		$ret_bujts = array();
		$no = 1;
		foreach($bujts as $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);
    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/bujts/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/bujts/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_bujt = array($checkbox, $no, $value->name, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_bujts, $temp_bujt);
			$no++;
		}
		$json = array('aaData'=>$ret_bujts);

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
		if ($this->input->post('name',true)) {
			$title = $this->input->post('name',true);

			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else {
			$title_id = $this->input->post('name_id',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}
	}
}