<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Roads extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('info_tarif_tol_ruas_tol', $this->session->userdata('user_group_id'));
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
			'#' => 'Toll Roads Manager',
			'' => 'Ruas Jalan Tol'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.toll-road.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Mengelola Ruas Jalan Tol', 'title' => 'Ruas Jalan Tol'), true),
			'content' => $this->load->view('admin/toll_roads/index', array('flash'=>$this->session->flashdata('toll_roads_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('toll_road', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Toll Roads Manager',
			'admin/toll_roads' => 'Ruas Jalan Tol',
			'' => 'Lihat Ruas Jalan Tol'
		);

		$road = $this->toll_road->get_toll_road($id);
		if (count($road) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Mengelola Ruas Jalan Tol', 'title' => 'Lihat Ruas Jalan Tol'), true),
				'content' => $this->load->view('admin/toll_roads/show', array('road'=>$road[0], 'flash'=>$this->session->flashdata('road_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('toll_road', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Toll Roads Manager',
			'admin/toll_roads' => 'Ruas Jalan Tol',
			'' => 'Tambah Ruas Jalan Tol'
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
		$road = null;
		if (isset($filled_value)) {
			$road = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Mengelola Ruas Jalan Tol', 'title' => 'Tambah Ruas Jalan Tol'), true),
			'content' => $this->load->view('admin/toll_roads/add', array('road'=>$road), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('toll_road', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			//$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_imagetype');
			$this->form_validation->set_message('check_title', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			//$this->form_validation->set_message('check_imagetype', 'Silakan ganti image karena tipe image tidak dikenal.');

			if ($this->form_validation->run()) {
				$data_id = array(
					'name'=>$this->input->post('name_id',true),
					'developer'=>$this->input->post('developer_id',true),
					'road_length'=>$this->input->post('road_length_id',true),
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->toll_road->insert($data_id);
				$road_id = $this->db->insert_id();

				// if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
				// 	$filename = $_FILES['image_id']['name'];
				// 	$extensions = explode('.', $filename);
				// 	$extension = $extensions[1];
				// 	$filetype = $_FILES['image_id']['type'];
				// 	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/tolls/' . $road_id;

				// 	if (!is_dir($upload_dir)) {
				// 		mkdir($upload_dir, 0777, true);
				// 	}

				// 	$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
				// 	$new_imagepath = base_url() . 'uploads/images/tolls/' . $road_id . '/' . $new_filename;

				// 	move_uploaded_file($_FILES['image_id']['tmp_name'], $upload_dir . '/' . $new_filename);

				// 	list($width, $height) = getimagesize($new_imagepath);

				// 	$data = array(
				// 		'filename'=>$new_filename,
				// 		'url'=>$new_imagepath,
				// 		'width'=>$width,
				// 		'height'=>$height
				// 	);
				// 	$this->toll_road->update($road_id, $data);
				// }

				$this->user_log->add_log($this->session->userdata('user_id'), 'toll_roads', $road_id, 'Pengguna menambah data ruas jalan tol');

				$this->session->set_flashdata('roads_success', true);
				redirect('admin/toll_roads/show/' . $road_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('toll_road', 'comment'));
		$this->load->helper('form');

		$road = $this->toll_road->get_toll_road($id);

		if (count($road > 0)) {
			$breadcrumbs = array(
				'#' => 'Toll Roads Manager',
				'admin/toll_roads' => 'Ruas Jalan Tol',
				'' => 'Ubah Ruas Jalan Tol'
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
				$road[0]->name = $filled_value['name'];
				$road[0]->developer = $filled_value['developer'];
				$road[0]->road_length = $filled_value['road_length'];
				$road[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Mengelola Ruas Jalan Tol', 'title' => 'Ubah Ruas Jalan Tol'), true),
				'content' => $this->load->view('admin/toll_roads/edit', array('road'=>$road[0], 'id'=>$id), true),
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
			$this->load->model(array('toll_road', 'user_log'));
			$this->load->library('form_validation');

			$road = $this->toll_road->get_toll_road($id);

			if (count($road) > 0) {
				$this->form_validation->set_rules('name', 'Nama / Name', 'trim|required');
				$this->form_validation->set_message('required', 'Nama / Name harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'name' => $this->input->post('name',true),
						'developer' => $this->input->post('developer',true),
						'road_length' => $this->input->post('road_length',true),
						'status' => $this->input->post('status',true),
						'updated_at' => date('Y-m-d H:i:s')
					);
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$filename = $_FILES['image']['name'];
					// 	$extensions = explode('.', $filename);
					// 	$extension = $extensions[1];
					// 	$filetype = $_FILES['image']['type'];
					// 	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/tolls/' . $id;

					// 	if (!is_dir($upload_dir)) {
					// 		mkdir($upload_dir, 0777, true);
					// 	}

					// 	$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 	$new_imagepath = base_url() . 'uploads/images/tolls/' . $id . '/' . $new_filename;

					// 	move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);

					// 	list($width, $height) = getimagesize($new_imagepath);

					// 	$data = array(
					// 		'name' => $this->input->post('name',true),
					// 		'status' => $this->input->post('status',true),
					// 		'filename' => $new_filename,
					// 		'url' => $new_imagepath,
					// 		'width' => $width,
					// 		'height' => $height,
					// 		'updated_at' => date('Y-m-d H:i:s')
 				// 		);
					// } else {
					// 	$data = array(
					// 		'name' => $this->input->post('name',true),
					// 		'status' => $this->input->post('status',true),
					// 		'updated_at' => date('Y-m-d H:i:s')
					// 	);
					// }

					$this->toll_road->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'toll_roads', $id, 'Pengguna mengubah data ruas jalan tol');

					$this->session->set_flashdata('roads_success', true);
					redirect('admin/toll_roads/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('toll_road', 'user_log'));
		$toll_road = $this->toll_road->get_toll_road($id);
		$toll_road = $toll_road[0];
		if ($toll_road->status != "deleted") {
			if ($toll_road->status == "published") {
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

			$this->toll_road->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'toll_roads', $id, 'Pengguna mengubah status data ruas jalan tol');

			$this->session->set_flashdata('toll_roads_success', true);
			redirect('admin/toll_roads');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('road_ids',true)) {
			$this->load->model(array('toll_road', 'user_log'));
			$road_ids = $this->input->post('road_ids',true);
			foreach($road_ids as $road_id) {
				$this->toll_road->destroy($road_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'toll_roads', $road_id, 'Pengguna menghapus data ruas jalan tol');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_toll_roads() {
		$this->load->model('toll_road');
		$roads = $this->toll_road->fetch_toll_roads("", "", null);

		$ret_roads = array();
		$no = 1;
		foreach($roads as $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);

    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/toll_roads/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/toll_roads/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_road = array($checkbox, $no, $value->name, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_roads, $temp_road);
			$no++;
		}
		$json = array('aaData'=>$ret_roads);

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