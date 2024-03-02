<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_Galleries extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('galeri_foto', $this->session->userdata('user_group_id'));
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
		$this->load->model(array('media', 'comment', 'album'));

		$breadcrumbs = array(
			'' => 'Media Manager'
		);
		$stylesheets = array('isotope.css', 'colorbox.css', 'jquery.fileupload-ui.css');
		$jscripts = array(
			'jquery.isotope.min.js'=>'vendor',
			'jquery.colorbox-min.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'admin.photo-gallery.index.js'=>'application',
			//'elements.js'=>'application',
		);
		$entry = 20;
		$page = ($this->input->get('page',true)) ? intval($this->input->get('page',true)) : 1;
		$filename = ($this->input->get('filename',true)) ? clean_str($this->input->get('filename',true)) : "";
		$prev_btn = $next_btn = array();

		$offset = (($page-1)*$entry) + 1;
		$categories = $this->album->get_published_albums("all");
		$db_medias = $this->media->get_medias($page, $entry, $filename);
		$count_medias = $this->media->count_medias($filename);
		$total_page = $this->media->total_page($count_medias, $entry);

		if ($page == 1) {
			$next_btn['page'] = ($page+1);
			$next_btn['filename'] = ($filename != "") ? $filename : null;
		} elseif ($page == $total_page) {
			$prev_btn['page'] = ($page-1);
			$prev_btn['filename'] = ($filename != "") ? $filename : null;
		} else {
			$next_btn['page'] = ($page+1);
			$next_btn['filename'] = ($filename != "") ? $filename : null;
			$prev_btn['page'] = ($page-1);
			$prev_btn['filename'] = ($filename != "") ? $filename : null;
		}

		$prev_btn = http_build_query($prev_btn);
		$next_btn = http_build_query($next_btn);
		
		$success = $this->session->flashdata('medias_success');
		$fail = $this->session->flashdata('medias_fail');

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Media Manager'), true),
			'content' => $this->load->view('admin/photo_galleries/index', array('medias'=>$db_medias, 'categories'=>$categories, 'count_medias'=>$count_medias, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page, 'prev_btn'=>$prev_btn, 'next_btn'=>$next_btn, 'flash_success'=>$success, 'flash_fail'=>$fail), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model('media');
		$this->load->helper('form');

		$media = $this->media->get_media($id);
		$media = $media[0];
		$jscripts = array(
			'jquery.fileupload.js'=>'vendor',
			'jquery.iframe-transport.js'=>'vendor',
			'jquery.ui.widget.js'=>'vendor',
			'admin.photo-gallery.show.js'=>'application'
		);
		$data = array(
			'content' => $this->load->view('admin/photo_galleries/show', array('media'=>$media), true),
			'jscripts' => $jscripts
		);
		$this->load->view('layouts/content_minimal.php', $data);
	}

	public function update($id) {
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		if ($this->input->post()) {
			$this->load->model(array('media', 'user_log'));

			$data_media = array(
				'title'=>$this->input->post('title',true),
				'caption'=>$this->input->post('caption',true),
				'status'=>$this->input->post('status',true),
				'updated_at'=>date('Y-m-d H:i:s')
			);

			if ($this->media->update($id, $data_media)) {
				$this->user_log->add_log($this->session->userdata('user_id'), 'medias', $id, 'Pengguna mengubah data galeri foto');

				$this->session->set_flashdata('medias_success', true);
			} else {
				$this->session->set_flashdata('medias_fail', true);
			}
			redirect('admin/photo_galleries');
		}
	}

	public function update_image($id) {
		if ($this->input->post()) {
			/* need to be validated for size and image type */
			
			$this->load->model(array('media', 'user_log'));
			$mime = mime_content_type($_FILES['file']['tmp_name']);
			if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
				echo 'if';
				$filename = $_FILES['file']['name'];
				$extensions = explode('.', $filename);
				$extension = $extensions[1];
				$filetype = $_FILES['file']['type'];
				$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/gal/' . $id;

				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0777, true);
				}

				$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
				$new_imagepath = base_url() . 'uploads/gal/' . $id . '/' . $new_filename;

				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

				/* image processing */
				$this->media->gallery_image_processing($upload_dir, $new_filename);

				$data_media = array(
					'url'=>$new_imagepath
				);
				$this->media->update($id, $data_media);

				$this->user_log->add_log($this->session->userdata('user_id'), 'medias', $id, 'Pengguna mengubah gambar galeri foto');

				$retjson = array(
					'status'=>'success',
					'new_imgpath'=>$new_imagepath
				);
			}else{
				$retjson = array(
					'status'=>'fail'
				);
				echo 'else';

			}
			exit();
			echo json_encode($retjson);
		}
	}

	public function add($filled_value=null) {
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		$this->load->model(array('comment', 'album'));
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/photo_galleries' => 'Media Manager',
			'' => 'Upload File Baru'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js'=>'vendor',
			'bootstrap-timepicker.min.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
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
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.photo-gallery.form.css');
		$media = array();

		if (isset($filled_value)) {
			$media = $filled_value;
		}

		$album_ids = array("0"=>"- Pilih Album Foto -");
		$album_ens = array("0"=>"- Choose Photo Album -");
		$albums = $this->album->get_published_albums();
		foreach($albums as $album) {
			$album_ids[$album->id] = $album->name;
		}

		$albums = $this->album->get_published_albums("en");
		foreach($albums as $album) {
			$album_ens[$album->id] = $album->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Upload File Baru'), true),
			'content' => $this->load->view('admin/photo_galleries/add', array('media'=>$media, 'album_ids'=>$album_ids, 'album_ens'=>$album_ens), true),
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
			$this->load->model(array('media', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('image_id_image_en', 'Image', 'trim|callback_check_required');
			$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_imagetype');
			$this->form_validation->set_message('check_required', 'Gambar dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_imagetype', 'Silakan ganti image karena tipe image tidak dikenal.');

			if ($this->form_validation->run()) {
				
				
				if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
					
					$mime = mime_content_type($_FILES['image_id']['tmp_name']);
					if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
						$album_id = ($this->input->post('album_id',true) == "0") ? null : $this->input->post('album_id',true);
						$data_media = array(
							'title'=>$this->input->post('title_id',true),
							'caption'=>$this->input->post('content_id',true),
							'url'=>'',
							'lang'=>'id',
							'status'=>$this->input->post('status_id',true),
							'album_id'=>$album_id,
							'media_type'=>'image',
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);

						$this->media->insert($data_media);

						$media_id = $this->db->insert_id();

						$filename = $_FILES['image_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions)-1];
						$filetype = $_FILES['image_id']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/gal/' . $media_id;

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0777, true);
						}

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_imagepath = base_url() . 'bpjt_ci3/uploads/gal/' . $media_id . '/' . $new_filename;

						move_uploaded_file($_FILES['image_id']['tmp_name'], $upload_dir . '/' . $new_filename);

						/* image processing */
						$this->media->gallery_image_processing($upload_dir, $new_filename);

						$data_media = array(
							'url'=>$new_imagepath
						);
						$this->media->update($media_id, $data_media);
					}
				}	
				if ($_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
					$mime = mime_content_type($_FILES['image_en']['tmp_name']);
					if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
						$album_id = ($this->input->post('album_en',true) == "0") ? null : $this->input->post('album_en',true);
						$data_media = array(
							'title'=>$this->input->post('title_en',true),
							'caption'=>$this->input->post('content_en',true),
							'url'=>'',
							'lang'=>'en',
							'status'=>$this->input->post('status_en',true),
							'album_id'=>$album_id,
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);
						$this->media->insert($data_media);
						$en_media_id = $this->db->insert_id();

						$filename = $_FILES['image_en']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions)-1];
						$filetype = $_FILES['image_en']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/gal/' . $en_media_id;

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0777, true);
						}

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_imagepath = base_url() . 'bpjt_ci3/uploads/gal/' . $en_media_id . '/' . $new_filename;

						move_uploaded_file($_FILES['image_en']['tmp_name'], $upload_dir . '/' . $new_filename);

						/* image processing */
						$this->media->gallery_image_processing($upload_dir, $new_filename);

						$data_media = array(
							'url'=>$new_imagepath
						);
						$this->media->update($en_media_id, $data_media);

						if (!isset($media_id)) {
							$media_id = $en_media_id;
						}
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'medias', $media_id, 'Pengguna menambah data galeri foto');

				$this->session->set_flashdata('medias_success', true);
				redirect('admin/photo_galleries');
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function destroy() {
		if ($this->input->post()) {
			$this->load->model(array('media', 'user_log'));
			$media_id = $this->input->post('media_id',true);
			$this->media->destroy($media_id);
			$this->user_log->add_log($this->session->userdata('user_id'), 'medias', $media_id, 'Pengguna menghapus data galeri foto');
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	/* START: validation callback */
	public function check_required() {
		if ($_FILES['image_id']['error'] == UPLOAD_ERR_NO_FILE && $_FILES['image_en']['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		} else {
			return true;
		}
	}

	public function check_imagetype() {
		if (@$_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_id']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} elseif (@$_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_en']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	/* END: validation callback */
	
}

/* End of file photo_galleries.php */
/* Location: ./application/controllers/admin/photo_galleries.php */