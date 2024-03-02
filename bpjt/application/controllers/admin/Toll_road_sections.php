<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Road_Sections extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('progres_konstruksi_segment_ruas_tol', $this->session->userdata('user_group_id'));
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
			'' => 'Segment Ruas Tol'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.toll-road-section.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Segment Ruas Tol'), true),
			'content' => $this->load->view('admin/toll_road_sections/index', array('flash'=>$this->session->flashdata('toll_road_sections_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('toll_road_section', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Progres Konstruksi',
			'admin/toll_road_sections' => 'Segment Ruas Tol',
			'' => 'Lihat Segment Ruas Tol'
		);

		$toll_road_section = $this->toll_road_section->get_toll_road_section($id);
		if (count($toll_road_section) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Lihat Segment Ruas Tol'), true),
				'content' => $this->load->view('admin/toll_road_sections/show', array('toll_road_section'=>$toll_road_section[0], 'flash'=>$this->session->flashdata('toll_road_section_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('constructing_toll_road', 'toll_road_section', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Progres Konstruksi',
			'admin/toll_road_sections' => 'Segment Ruas Tol',
			'' => 'Tambah Segment Ruas Tol'
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
		$toll_road_section = null;
		if (isset($filled_value)) {
			$toll_road_section = $filled_value;
		}

		$db_constructing_toll_roads = $this->constructing_toll_road->get_published_constructing_toll_roads();
		$constructing_toll_roads = array();
		foreach($db_constructing_toll_roads as $constructing_toll_road) {
			$constructing_toll_roads[$constructing_toll_road->id] = $constructing_toll_road->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Tambah Segment Ruas Tol'), true),
			'content' => $this->load->view('admin/toll_road_sections/add', array('toll_road_section'=>$toll_road_section, 'constructing_toll_roads'=>$constructing_toll_roads), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('toll_road_section', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			$this->form_validation->set_message('check_name', 'Nama Segment Ruas Tol harus diisi.');

			if ($this->form_validation->run()) {
				$data_id = array(
					'constructing_toll_road_id'=>$this->input->post('constructing_toll_road_id',true),
					'name'=>$this->input->post('name_id',true),
					'road_length'=>$this->input->post('road_length_id',true),
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->toll_road_section->insert($data_id);
				$toll_road_section_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'toll_road_sections', $toll_road_section_id, 'Pengguna menambah data segment Ruas Tol');

				$this->session->set_flashdata('toll_road_sections_success', true);
				redirect('admin/toll_road_sections/show/' . $toll_road_section_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('toll_road_section', 'constructing_toll_road', 'comment'));
		$this->load->helper('form');

		$toll_road_section = $this->toll_road_section->get_toll_road_section($id);

		if (count($toll_road_section > 0)) {
			$breadcrumbs = array(
				'#' => 'Progres Konstruksi',
				'admin/toll_road_sections' => 'Segment Ruas Tol',
				'' => 'Ubah Segment Ruas Tol'
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
			$stylesheets = array( 'admin.album.form.css');

			if (isset($filled_value)) {
				$toll_road_section[0]->constructing_toll_road_id = $filled_value['constructing_toll_road_id'];
				$toll_road_section[0]->name = $filled_value['name'];
				$toll_road_section[0]->road_length = $filled_value['road_length'];
				$toll_road_section[0]->status = $filled_value['status'];
			}

			$db_constructing_toll_roads = $this->constructing_toll_road->get_published_constructing_toll_roads();
		$constructing_toll_roads = array();
		foreach($db_constructing_toll_roads as $constructing_toll_road) {
			$constructing_toll_roads[$constructing_toll_road->id] = $constructing_toll_road->name;
		}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PROGRES KONSTRUKSI', 'title' => 'Ubah Segment Ruas Tol'), true),
				'content' => $this->load->view('admin/toll_road_sections/edit', array('toll_road_section'=>$toll_road_section[0], 'id'=>$id, 'constructing_toll_roads'=>$constructing_toll_roads), true),
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
			$this->load->model(array('toll_road_section', 'user_log'));
			$this->load->library('form_validation');

			$toll_road_section = $this->toll_road_section->get_toll_road_section($id);

			if (count($toll_road_section) > 0) {
				$this->form_validation->set_rules('name', 'Nama / Name', 'trim|required');
				$this->form_validation->set_message('required', 'Nama Segment Ruas Tol harus diisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'constructing_toll_road_id'=>$this->input->post('constructing_toll_road_id',true),
						'name' => $this->input->post('name',true),
						'road_length' => $this->input->post('road_length',true),
						'status' => $this->input->post('status',true),
						'updated_at' => date('Y-m-d H:i:s')
					);

					$this->toll_road_section->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'toll_road_sections', $id, 'Pengguna mengubah data Segment Ruas Tol');

					$this->session->set_flashdata('toll_road_sections_success', true);
					redirect('admin/toll_road_sections/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('toll_road_section', 'user_log'));
		$toll_road_section = $this->toll_road_section->get_toll_road_section($id);
		$toll_road_section = $toll_road_section[0];
		if ($toll_road_section->status != "deleted") {
			if ($toll_road_section->status == "published") {
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

			$this->toll_road_section->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'toll_road_sections', $id, 'Pengguna mengubah status data Segment Ruas Tol');

			$this->session->set_flashdata('toll_road_sections_success', true);
			redirect('admin/toll_road_sections');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('toll_road_section_ids',true)) {
			$this->load->model(array('toll_road_section', 'user_log'));
			$toll_road_section_ids = $this->input->post('toll_road_section_ids',true);
			foreach($toll_road_section_ids as $toll_road_section_id) {
				$this->toll_road_section->destroy($toll_road_section_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'toll_road_sections', $toll_road_section_id, 'Pengguna menghapus data Segment Ruas Tol');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_toll_road_sections() {
		$this->load->model('toll_road_section');
		$toll_road_sections = $this->toll_road_section->fetch_toll_road_sections("", "", null);

		$ret_toll_road_sections = array();
		$no = 1;
		foreach($toll_road_sections as $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);

    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/toll_road_sections/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/toll_road_sections/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_toll_road_section = array($checkbox, $no, $value->name, $value->constructing_toll_road_name, $value->road_length, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_toll_road_sections, $temp_toll_road_section);
			$no++;
		}
		$json = array('aaData'=>$ret_toll_road_sections);

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

	public function check_imagetype() {
		if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_id']['type']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}