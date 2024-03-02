<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {
	public $user_access;
	
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('konten_dinamis', $this->session->userdata('user_group_id'));
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
			'#' => 'Konten Dinamis',
			'' => 'Menu'
		);

		//$this->menu->print_admin_menu();
		
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.menu.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN DINAMIS', 'title' => 'Menu'), true),
			'content' => $this->load->view('admin/menus/index', array('flash'=>$this->session->flashdata('menus_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('menu', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Konten Dinamis',
			'admin/menus' => 'Menu',
			'' => 'Lihat Menu'
		);

		$menu = $this->menu->get_menu($id);
		if (count($menu) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Lihat Klasifikasi'), true),
				'content' => $this->load->view('admin/menus/show', array('menu'=>$menu[0], 'flash'=>$this->session->flashdata('menu_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('menu', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Konten Dinamis',
			'admin/menus' => 'Menu',
			'' => 'Tambah Menu'
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
		
		$stylesheets = array('admin.album.form.css');
		
		$menu = array();
		if (isset($filled_value)) {
			$menu = $filled_value;
		}
		
		$parents = $this->menu->fetch_menus("", "", null);
				
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN DINAMIS', 'title' => 'Tambah Menu'), true),
			'content' => $this->load->view('admin/menus/add', array('menu'=>$menu, 'parents' => $parents), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('menu', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name_id', 'Nama / Name', 'trim|callback_check_required');
			$this->form_validation->set_message('check_required', 'Nama menu bahasa indonesia dan bahasa inggris harus terisi.');

			if ($this->form_validation->run()) {
				$parent = ($this->input->post('parent_id',true) == 0) ? null : $this->input->post('parent_id',true);

				$data_id = array(
					'name'=>trim($this->input->post('name_id',true)),
					'parent_id' => $parent,
					'slug'=>$this->create_slug($this->input->post('name_id',true)),
					'name_en'=>trim($this->input->post('name_en',true)),
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->menu->insert($data_id);
				$menu_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'menus', $menu_id, 'Pengguna menambah data menu');

				$this->session->set_flashdata('menu_success', true);
				redirect('admin/menus/show/' . $menu_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('menu', 'comment'));
		$this->load->helper('form');

		$parents = $this->menu->fetch_menus("", "", null);
		$menu = $this->menu->get_menu($id);
		unset($parents[$id]);
				
		if (count($menu > 0)) {
			$breadcrumbs = array(
				'#' => 'Konten Dinamis',
				'admin/menus' => 'Menu',
				'' => 'Ubah Menu'
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
			$stylesheets = array('admin.album.form.css');

			if (isset($filled_value)) {
				$menu[0]->name = $filled_value['name'];
				$menu[0]->name_en = $filled_value['name_en'];
				$menu[0]->parent_id = $filled_value['parent_id'];
				$menu[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN DINAMIS', 'title' => 'Ubah Menu'), true),
				'content' => $this->load->view('admin/menus/edit', array('menu'=>$menu[0], 'id'=>$id, 'parents' => $parents), true),
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
			$this->load->model(array('menu', 'content', 'user_log'));
			$this->load->library('form_validation');

			$menu = $this->menu->get_menu($id);

			if (count($menu) > 0) {
				$this->form_validation->set_rules('name_id', 'Nama / Name', 'trim|callback_check_required');
				$this->form_validation->set_message('check_required', 'Nama menu bahasa indonesia dan bahasa inggris harus terisi.');

				if ($this->form_validation->run()) {
					$parent = ($this->input->post('parent_id',true) == 0) ? null : $this->input->post('parent_id',true);

					$target_menu = array();
					if (!is_null($parent)) {
						$target_menu = $this->menu->get_menu($parent);
					}
					
					if (!empty($target_menu)) {
						if($target_menu[0]->parent_id == $menu[0]->id) {
							$this->menu->update($target_menu[0]->id, array('parent_id' => $menu[0]->parent_id));
						}
					}
					
					$data = array(
						'name' => $this->input->post('name_id',true),
						'name_en' => $this->input->post('name_en',true),
						'parent_id' => $parent,
						'status' => $this->input->post('status_id',true),
						'updated_at' => date('Y-m-d H:i:s')
					);

					$this->menu->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'menus', $id, 'Pengguna mengubah data menu');

					$this->session->set_flashdata('menu_success', true);
					redirect('admin/menus/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('menu', 'user_log'));
		$menu = $this->menu->get_menu($id);
		$menu = $menu[0];
		if ($menu->status != "deleted") {
			if ($menu->status == "published") {
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

			$this->menu->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'menus', $id, 'Pengguna mengubah status data menu');

			$this->session->set_flashdata('menus_success', true);
			redirect('admin/menus');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('menu_ids',true)) {
			$this->load->model(array('menu', 'user_log'));
			$menu_ids = $this->input->post('menu_ids',true);
			foreach($menu_ids as $menu_id) {
				$this->menu->destroy($menu_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'menus', $menu_id, 'Pengguna menghapus data menu');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_menu() {
		$this->load->model('menu');
		$menu = $this->menu->fetch_menus("", "", null, 'tree');

		$ret_menu = array();
		$no = 1;
		if (!empty($menu['tree'])) {
			foreach($menu['tree'] as $value) {
				$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value['id'] . "\" id=\"checker-" . $value['id'] . "\" /></span></div></span>";
				$created_at = strtotime($value['created_at']);
	    		$updated_at = strtotime($value['updated_at']);

	    		if ($this->user_access->edit) {
		    		if ($value['status'] == "published") {
		    			$status = "<a href=\"" . site_url('admin/menus/update_status/' . $value['id']) . "\" class=\"album-status\" data-id=\"" . $value['id'] . "\" id=\"album-status-" . $value['id'] . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
		    		} else {
		    			$status = "<a href=\"" . site_url('admin/menus/update_status/' . $value['id']) . "\" class=\"album-status\" data-id=\"" . $value['id'] . "\" id=\"album-status-" . $value['id'] . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
		    		}
		    	} else {
		    		$status = "";
		    	}
				if(isset($value['parent_id'])) $parent = str_replace('-', '', $menu['array'][$value['parent_id']]);
				else $parent = 'root';
	    		
				$temp_class = array($checkbox, $no, $value['name'] . '/' . $value['name_en'], $parent, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
				array_push($ret_menu, $temp_class);
				$no++;
			}
		}
		$json = array('aaData'=>$ret_menu);

		echo json_encode($json);
	}

	public function tree() {
		$this->load->model('menu');
		$menus = $this->menu->get_parsedtree_menus();

		echo json_encode($menus);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_required() {
		if ($this->input->post('name_id',true) == "" || $this->input->post('name_en',true) == "") {
			return false;
		} else {
			return true;
		}
	}

}