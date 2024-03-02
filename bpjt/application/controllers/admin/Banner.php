<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {
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
			'#' => 'Banner',
			'' => 'Banner'
		);

		//$this->menu->print_admin_menu();
		
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.banner.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Banner', 'title' => 'Banner'), true),
			'content' => $this->load->view('admin/banner/index', array('flash'=>$this->session->flashdata('menus_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('banner_model', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Banner',
			'admin/menus' => 'Banner',
			'' => 'Lihat Banner'
		);

		$banner = $this->banner_model->get_first_banner($id);
		if (count($banner) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Banner', 'title' => 'Lihat Banner'), true),
				'content' => $this->load->view('admin/banner/show', array('banner'=>$banner[0], 'flash'=>$this->session->flashdata('banner_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('banner_model', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Banner',
			'admin/menus' => 'Banner',
			'' => 'Tambah Banner'
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
		
		$banner = (object)array();
		if (isset($filled_value)) {
			$banner->judul = $filled_value['judul'];
			$banner->deskripsi = $filled_value['deskripsi'];
			$banner->jenis = $filled_value['jenis'];
			$banner->url_video = $filled_value['url_video'];
			$banner->image = $filled_value['image'];
			$banner->status = $filled_value['status'];
		}
				
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Banner', 'title' => 'Tambah Banner'), true),
			'content' => $this->load->view('admin/banner/add', array('banner'=>$banner), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('banner_model', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('judul', 'ID Ruas', 'trim|callback_check_judul');
			$this->form_validation->set_rules('jenis', 'Nama Ruas', 'trim|callback_check_jenis');
			$this->form_validation->set_rules('url_video', 'Nama Ruas', 'trim|callback_check_url_video');
			//$this->form_validation->set_rules('image', 'Nama Banner', 'trim|callback_check_image');
			$this->form_validation->set_rules('status', 'Status', 'trim|callback_check_status');
			
			$this->form_validation->set_message('check_judul', 'Judul harus terisi.');
			$this->form_validation->set_message('check_jenis', 'Jenis harus terisi.');
			$this->form_validation->set_message('check_url_video', 'URL Video harus terisi.');
			$this->form_validation->set_message('check_image', 'Image harus terisi.');
			$this->form_validation->set_message('check_status', 'Status harus terisi.');
			
			if ($this->form_validation->run()) {
				$data = array(
					'judul' => $this->input->post('judul',true),
					'deskripsi' => $this->input->post('deskripsi',true),
					'jenis' => $this->input->post('jenis',true),
					'url_video' => $this->input->post('url_video',true),
					'status' => $this->input->post('status',true),
				);

				/* image uploaded */
				if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					$mime = mime_content_type($_FILES['image']['tmp_name']);
					if ($mime == 'image/jpeg' || $mime == 'image/jpg'){
						
						$filename = $_FILES['image']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions)-1];
						$filetype = $_FILES['image']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/front/img/banner/';

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0755, true);
						}

						$new_filename = $this->create_slug($this->input->post('judul',true) . date('YmdHis')) . '.' . $extension;
						$new_imagepath = base_url() . 'img/banner/' . $new_filename;

						move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);

						$data['image'] = $new_filename;
					}
				}

				$this->banner_model->insert($data);
				$banner_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'banner', $banner_id, 'Pengguna menambah data banner');

				$this->session->set_flashdata('banner_success', true);
				redirect('admin/banner/show/' . $banner_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('banner_model', 'comment'));
		$this->load->helper('form');

		$banner = $this->banner_model->get_first_banner($id);
				
		if (count($banner) > 0) {
			$breadcrumbs = array(
				'#' => 'Banner',
				'admin/banner' => 'Banner',
				'' => 'Ubah Banner'
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
				$banner[0]->judul = $filled_value['judul'];
				$banner[0]->deskripsi = $filled_value['deskripsi'];
				$banner[0]->jenis = $filled_value['jenis'];
				$banner[0]->url_video = $filled_value['url_video'];
				$banner[0]->image = $filled_value['image'];
				$banner[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Banner', 'title' => 'Ubah Banner'), true),
				'content' => $this->load->view('admin/banner/edit', array('banner'=>$banner[0], 'id'=>$id), true),
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
			$this->load->model(array('banner_model', 'content', 'user_log'));
			$this->load->library('form_validation');

			$banner = $this->banner_model->get_first_banner($id);

			if (count($banner) > 0) {
				$this->form_validation->set_rules('judul', 'ID Ruas', 'trim|callback_check_judul');
				$this->form_validation->set_rules('url_video', 'Nama Ruas', 'trim|callback_check_url_video');
				//$this->form_validation->set_rules('image', 'Nama Banner', 'trim|callback_check_image');
				$this->form_validation->set_rules('status', 'Status', 'trim|callback_check_status');
				
				$this->form_validation->set_message('check_judul', 'Judul harus terisi.');
				$this->form_validation->set_message('check_url_video', 'URL Video harus terisi.');
				$this->form_validation->set_message('check_image', 'Image harus terisi.');
				$this->form_validation->set_message('check_status', 'Status harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'judul' => $this->input->post('judul',true),
						'deskripsi' => $this->input->post('deskripsi',true),
						'jenis' => $this->input->post('jenis',true),
						'url_video' => $this->input->post('url_video',true),
						'status' => $this->input->post('status',true),
					);

					/* image uploaded */
					if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg'){
							
							$filename = $_FILES['image']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/front/img/banner/';

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$new_filename = $this->create_slug($this->input->post('judul',true) . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'img/banner/' . $new_filename;

							move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);

							$data['image'] = $new_filename;
						}
					}

					$this->banner_model->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'banner', $id, 'Pengguna mengubah data banner');

					$this->session->set_flashdata('banner_success', true);
					redirect('admin/banner/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('banner_model', 'user_log'));

		$banner = $this->banner_model->get_first_banner($id);
		$banner = $banner[0];
		if ($banner->status != "deleted") {
			if ($banner->status == "aktif") {
				$data = array(
					'status'=>'draft'
				);
			} else {
				$data = array(
					'status'=>'aktif'
				);
			}

			$this->banner_model->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'banner', $id, 'Pengguna mengubah status data banner');

			$this->session->set_flashdata('banner_success', true);
			redirect('admin/banner');
		} else {
			redirect('/admin');
		}
	}

	public function update_sequence() {
		if ($this->input->post('banner_ids',true)) {
			$this->load->model(array('banner_model', 'user_log'));
			$banner_ids = $this->input->post('banner_ids',true);
			$sequences = $this->input->post('sequences',true);
			foreach($banner_ids as $banner_idx => $banner_id){
				$this->banner_model->update($banner_id, [
					'sequence' => $sequences[$banner_idx]
				]);
			}
			
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function destroy() {
		if ($this->input->post('banner_ids',true)) {
			$this->load->model(array('banner_model', 'user_log'));
			$banner_ids = $this->input->post('banner_ids',true);
			foreach($banner_ids as $banner_id) {
				$this->banner_model->destroy($banner_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'banner', $banner_id, 'Pengguna menghapus data banner');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_banner() {
		$this->load->model('banner_model');
		$banner = $this->banner_model->fetch_all_banner("", "", null, 'tree');

		$ret_banner = array();
		$no = 1;
		if (!empty($banner)) {
			foreach($banner as $value) {
				$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
				
				if ($this->user_access->edit) {
					if ($value->status == "aktif") {
						$status = "<a href=\"" . site_url('admin/banner/update_status/' . $value->id) . "\" class=\"banner-status\" data-id=\"" . $value->id . "\" id=\"banner-status-" . $value->id . "\" data-status=\"aktif\" style=\"color: #333\"><i class=\"fa fa-2x fa-check\" style=\"color: #47c157\"></i> Aktif</a>";
					} else {
						$status = "<a href=\"" . site_url('admin/banner/update_status/' . $value->id) . "\" class=\"banner-status\" data-id=\"" . $value->id . "\" id=\"banner-status-" . $value->id . "\" data-status=\"draft\" style=\"color: #333\"><i class=\"fa fa-2x fa-ban\" style=\"color: #db1111\"></i> Draft</a>";
					}

					$urutan = '<input type="text" name="sequence_'.$value->id.'" id="sequence_'.$value->id.'" class="form-control" value="'.$value->sequence.'" style="width:50px;">';
					if($value->image){
						$image = '<img src="'.base_url() . 'front/img/banner/' . $value->image.'" style="width: 100px;">';
					} else {
						$image = '';
					}
				} else {
					$status = "";
					$urutan = "";
					$image = "";
				}

	    		$temp_class = array($checkbox, $no, $value->judul, $value->jenis, $image, $value->url_video, $status);
				array_push($ret_banner, $temp_class);
				$no++;
			}
		}
		$json = array('aaData'=>$ret_banner);

		echo json_encode($json);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_judul() {
		return $this->input->post('judul',true) == "" ? false : true;
	}

	public function check_deskripsi() {
		return $this->input->post('deskripsi',true) == "" ? false : true;
	}

	public function check_jenis() {
		return $this->input->post('jenis',true) == "" ? false : true;
	}

	public function check_url_video() {
		return ($this->input->post('jenis',true) == "video" && $this->input->post('url_video',true) == "") ? false : true;
	}

	public function check_image() {
		return ($this->input->post('jenis',true) == "image" && $this->input->post('image',true) == "") ? false : true;
	}

	public function check_status() {
		return $this->input->post('status',true) == "" ? false : true;
	}

}