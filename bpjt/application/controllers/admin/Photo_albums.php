<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_Albums extends CI_Controller {
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('album_foto', $this->session->userdata('user_group_id'));
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
			'#' => 'Media Manager',
			'' => 'Album Foto'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.album.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Album Foto'), true),
			'content' => $this->load->view('admin/photo_albums/index', array('flash'=>$this->session->flashdata('photo_albums_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('album', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Media Manager',
			'admin/photo_albums' => 'Album Foto',
			'' => 'Lihat Album Foto'
		);

		$album = $this->album->get_album($id);
		if (count($album) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Lihat Album Foto'), true),
				'content' => $this->load->view('admin/photo_albums/show', array('album'=>$album[0], 'flash'=>$this->session->flashdata('albums_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('album', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Media Manager',
			'admin/photo_albums' => 'Album Foto',
			'' => 'Tambah Album Foto'
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
		$album = null;
		if (isset($filled_value)) {
			$album = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Tambah Album Foto'), true),
			'content' => $this->load->view('admin/photo_albums/add', array('album'=>$album), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('album', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			$this->form_validation->set_message('check_title', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');

			if ($this->form_validation->run()) {
				if ($this->input->post('name_id',true) != '') {
					$data_id = array(
						'name'=>$this->input->post('name_id',true),
						'description'=>$this->input->post('description_id',true),
						'slug'=>$this->create_slug($this->input->post('name_id',true)),
						'status'=>$this->input->post('status_id',true),
						'lang'=>'id',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->album->insert($data_id);
					$album_id = $this->db->insert_id();
				}

				if ($this->input->post('name_en',true) && $this->input->post('name_en',true) != "") {
					$data_en = array(
						'name'=>$this->input->post('name_en',true),
						'description'=>$this->input->post('description_en',true),
						'slug'=>$this->create_slug($this->input->post('name_en',true)),
						'status'=>$this->input->post('status_en',true),
						'lang'=>'en',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->album->insert($data_en);

					if (!isset($album_id)) {
						$album_id = $this->db->insert_id();
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'albums', $album_id, 'Pengguna menambah data album foto');

				$this->session->set_flashdata('albums_success', true);
				redirect('admin/photo_albums/show/' . $album_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('album', 'comment'));
		$this->load->helper('form');

		$album = $this->album->get_album($id);
	
		if (count(@$album)  > 0) {
			$breadcrumbs = array(
				'#' => 'Media Manager',
				'admin/photo_albums' => 'Album Foto',
				'' => 'Ubah Album Foto'
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
				$album[0]->name = $filled_value['name'];
				$album[0]->description = $filled_value['description'];
				$album[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Ubah Album Foto'), true),
				'content' => $this->load->view('admin/photo_albums/edit', array('album'=>$album[0], 'id'=>$id), true),
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
			$this->load->model(array('album', 'user_log'));
			$this->load->library('form_validation');

			$album = $this->album->get_album($id);

			if (count($album) > 0) {
				$this->form_validation->set_rules('name', 'Nama / Name', 'trim|required');
				$this->form_validation->set_message('required', 'Nama / Name harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'name' => $this->input->post('name',true),
						'description' => $this->input->post('description',true),
						'slug'=>$this->create_slug($this->input->post('name',true)),
						'status' => $this->input->post('status',true)
					);

					$this->album->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'albums', $id, 'Pengguna mengubah data album foto');

					$this->session->set_flashdata('albums_success', true);
					redirect('admin/photo_albums/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('album', 'user_log'));
		$album = $this->album->get_album($id);
		$album = $album[0];
		if ($album->status != "deleted") {
			if ($album->status == "published") {
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

			$this->album->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'albums', $id, 'Pengguna mengubah status data album foto');

			$this->session->set_flashdata('toll_tariffs_success', true);
			redirect('admin/photo_albums');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('album_ids',true)) {
			$this->load->model(array('album', 'user_log'));
			$album_ids = $this->input->post('album_ids',true);
			foreach($album_ids as $album_id) {
				$this->album->destroy($album_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'albums', $album_id, 'Pengguna menghapus data album foto');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_albums() {
		$this->load->model('album');
		$albums = $this->album->fetch_albums("", "", null);

		$ret_albums = array();
		$no = 1;
		foreach($albums as $album) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $album->id . "\" id=\"checker-" . $album->id . "\" /></span></div></span>";
			$created_at = strtotime($album->created_at);
    		$updated_at = strtotime($album->updated_at);
    		$lang = ($album->lang == "id") ? "Indonesia" : "Inggris";
    		if ($this->user_access->edit) {
	    		if ($album->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/photo_albums/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/photo_albums/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_album = array($checkbox, $no, $album->name, $album->slug, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $lang);
			array_push($ret_albums, $temp_album);
			$no++;
		}
		$json = array('aaData'=>$ret_albums);

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
			$title_en = $this->input->post('name_en',true);

			if ($title_id == "" && $title_en == "") {
				return false;
			} else {
				return true;
			}
		}
	}
}