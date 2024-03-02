<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Groups extends CI_Controller {
	public $parent_level = array('super_admin'=>'Super Admin', 'admin'=>'Admin', 'user'=>'User');
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('pengguna_grup_pengguna', $this->session->userdata('user_group_id'));
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
			'#' => 'Pengguna',
			'' => 'Grup Pengguna'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.user-group.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Grup Pengguna'), true),
			'content' => $this->load->view('admin/user_groups/index', array('flash'=>$this->session->flashdata('user_groups_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('user_group', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Pengguna',
			'admin/user_groups' => 'Grup Pengguna',
			'' => 'Lihat Grup Pengguna'
		);

		$user_group = $this->user_group->get_user_group_by_id($id);

		if (!empty($user_group)) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Lihat Grup Pengguna'), true),
				'content' => $this->load->view('admin/user_groups/show', array('user_group'=>$user_group[0], 'flash'=>$this->session->flashdata('user_groups_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('user_group', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Pengguna',
			'admin/user_groups' => 'Grup Pengguna',
			'' => 'Tambah Grup'
		);
		$jscripts = array(
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
		$stylesheets = array('admin.user-group.form.css');
		$user_group = null;
		if (isset($filled_value)) {
			$user_group = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Tambah Grup Pengguna'), true),
			'content' => $this->load->view('admin/user_groups/add', array('user_group'=>$user_group), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('user_group', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Nama', 'trim|callback_check_name');
			$this->form_validation->set_message('check_title', 'Nama grup harus terisi.');

			if ($this->form_validation->run()) {
				$data = array(
					'name'=>$this->input->post('name',true),
					'user_level'=>$this->input->post('user_level',true),
					'status'=>$this->input->post('status',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->user_group->insert($data);
				$user_group_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'user_groups', $user_group_id, 'Pengguna menambah data grup pengguna');

				$this->session->set_flashdata('user_groups_success', true);
				redirect('admin/user_groups/show/' . $user_group_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('user_group', 'comment'));
		$this->load->helper('form');

		$user_group = $this->user_group->get_user_group_by_id($id);

		if (!empty($user_group)) {
			$breadcrumbs = array(
				'#' => 'Pengguna',
				'admin/user_groups' => 'Grup Pengguna',
				'' => 'Ubah Grup Pengguna'
			);
			$jscripts = array(
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
			$stylesheets = array('admin.user-group.form.css');

			if (isset($filled_value)) {
				$user_group[0]->name = $filled_value['name'];
				$user_group[0]->status = $filled_value['status'];
				$user_group[0]->user_level = $filled_value['user_level'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Ubah Grup Pengguna'), true),
				'content' => $this->load->view('admin/user_groups/edit', array('user_group'=>$user_group[0], 'id'=>$id), true),
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
			$this->load->model(array('user_group', 'user_log'));
			$this->load->library('form_validation');

			$user_group = $this->user_group->get_user_group_by_id($id);

			if (!empty($user_group)) {
				$this->form_validation->set_rules('name', 'Nama Grup', 'trim|required');
				$this->form_validation->set_message('required', 'Nama grup harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'name' => $this->input->post('name',true),
						'user_level'=>$this->input->post('user_level',true),
						'status' => $this->input->post('status',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->user_group->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'user_groups', $id, 'Pengguna mengubah data grup pengguna');

					$this->session->set_flashdata('user_groups_success', true);
					redirect('admin/user_groups/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('user_group', 'user_log'));
		$user_group = $this->user_group->get_user_group_by_id($id);
		$user_group = $user_group[0];
		if ($user_group->status != "deleted") {
			if ($user_group->status == "published") {
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

			$this->user_group->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'user_groups', $id, 'Pengguna mengubah status data grup pengguna');

			$this->session->set_flashdata('user_groups_success', true);
			redirect('admin/user_groups');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('user_group_ids',true)) {
			$this->load->model(array('user_group', 'user_log'));
			$user_group_ids = $this->input->post('user_group_ids',true);
			foreach($user_group_ids as $user_group_id) {
				$this->user_group->destroy($user_group_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'user_groups', $user_group_id, 'Pengguna menghapus data grup pengguna');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_user_groups() {
		$this->load->model('user_group');

		$user_groups = $this->user_group->get_user_groups();

		$ret_user_groups = array();
		$no = 1;
		foreach($user_groups as $user_group) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $user_group->id . "\" id=\"checker-" . $user_group->id . "\" /></span></div></span>";
			$created_at = strtotime($user_group->created_at);
    		$updated_at = strtotime($user_group->updated_at);

    		if ($this->user_access->edit) {
	    		if ($user_group->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/user_groups/update_status/' . $user_group->id) . "\" class=\"user-group-status\" data-id=\"" . $user_group->id . "\" id=\"user-group-status-" . $user_group->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/user_groups/update_status/' . $user_group->id) . "\" class=\"user-group-status\" data-id=\"" . $user_group->id . "\" id=\"user-group-status-" . $user_group->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_user_group = array($checkbox, $no, $user_group->name, $this->parent_level[$user_group->user_level], date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $status);
			array_push($ret_user_groups, $temp_user_group);
			$no++;
		}
		$json = array('aaData'=>$ret_user_groups);

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
			$name = $this->input->post('name',true);

			if ($name == "") {
				return false;
			} else {
				return true;
			}
		}
	}
}