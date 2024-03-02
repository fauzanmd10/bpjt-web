<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_Galleries extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
	}

	public function index() {
		$this->load->model('document');

		$breadcrumbs = array(
			'' => 'Document Manager'
		);
		$stylesheets = array('isotope.css', 'colorbox.css');
		$jscripts = array(
			'jquery.isotope.min.js'=>'vendor',
			'jquery.colorbox-min.js'=>'vendor',
			'admin.photo-gallery.index.js'=>'application'
		);
		$entry = 20;
		$page = ($this->input->get('page',true)) ? intval($this->input->get('page',true)) : 1;

		$categories = $this->document->get_all_document_categories();
		$db_documents = $this->document->get_documents_with_categories($entry, $page);
		$count_documents = $this->document->count_documents();
		$total_page = $this->document->total_page($count_documents, $entry);
		$offset = (($page-1)*$entry) + 1;
		$document_id = "";
		$documents = array();
		$temp_categories = array();
		$temp_documents = array();
		$counter = 0;

		foreach($db_documents->result() as $document) {
			if ($document_id != $document->id) {
				if ($counter > 0) {
					$temp_documents['categories'] = $temp_categories;
					array_push($documents, $temp_documents);
				}

				$temp_documents = array(
					'id'=>$document->id,
					'title'=>$document->title,
					'url'=>$document->url,
				);
				$temp_categories = array($document->meta_value);
				$document_id = $document->id;
				$counter++;
			} else {
				array_push($temp_categories, $document->meta_value);
			}
		}
		$temp_documents['categories'] = $temp_categories;
		array_push($documents, $temp_documents);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'document Manager'), true),
			'content' => $this->load->view('admin/photo_galleries/index', array('documents'=>$documents, 'categories'=>$categories, 'count_documents'=>$count_documents, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function add($filled_value=null) {
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/photo_galleries' => 'document Manager',
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
		$document = array();

		if (isset($filled_value)) {
			$document = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'MENGELOLA FOTO', 'title' => 'Upload File Baru'), true),
			'content' => $this->load->view('admin/photo_galleries/add', array('document'=>$document), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('document_id_document_en', 'Document', 'trim|callback_check_required');
			$this->form_validation->set_message('check_required', 'Dokumen dalam Bahasa Indonesia harus terisi');

			if ($this->form_validation->run()) {
				$data_document = array(
					'title'=>$this->input->post('title_id',true),
					'caption'=>$this->input->post('content_id',true),
					'url'=>'',
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);
				if ($this->document->insert($data_document)) {
					$mime = mime_content_type($_FILES['image_id']['tmp_name']);
					if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
						$document_id = $this->db->insert_id();

						$filename = $_FILES['image_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions)-1];
						$filetype = $_FILES['image_id']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/gal/' . $document_id;

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0777, true);
						}

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_imagepath = base_url() . 'uploads/gal/' . $document_id . '/' . $new_filename;

						move_uploaded_file($_FILES['image_id']['tmp_name'], $upload_dir . '/' . $new_filename);
						$data_document = array(
							'url'=>$new_imagepath
						);
						$this->document->update($document_id, $data_document);
					}
					/* keywords */
					if ($this->input->post('keywords_id',true) != "") {
						$keywords = trim($this->input->post('keywords_id',true));
						$keywords = explode(',', $keywords);
						foreach($keywords as $keyword) {
							$data_meta = array(
								'document_id'=>$document_id,
								'meta_key'=>'keyword',
								'meta_value'=>trim($keyword)
							);
							$this->document->insert_meta($data_meta);
						}
					}

					if ($this->input->post('title_en',true) != "") {
						$mime = mime_content_type($_FILES['image_id']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
					
							$data_document = array(
								'title'=>$this->input->post('title_en',true),
								'caption'=>$this->input->post('content_en',true),
								'url'=>'',
								'lang'=>'en',
								'status'=>$this->input->post('status_en',true),
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s')
							);
							$this->document->insert($data_document);
							$en_document_id = $this->db->insert_id();

							$filename = $_FILES['image_en']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image_en']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/gal/' . $en_document_id;

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0777, true);
							}

							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'uploads/gal/' . $en_document_id . '/' . $new_filename;

							move_uploaded_file($_FILES['image_en']['tmp_name'], $upload_dir . '/' . $new_filename);
							$data_document = array(
								'url'=>$new_imagepath
							);
							$this->document->update($en_document_id, $data_document);
						}
						/* keywords */
						if ($this->input->post('keywords_en',true) != "") {
							$keywords = trim($this->input->post('keywords_en',true));
							$keywords = explode(',', $keywords);
							foreach($keywords as $keyword) {
								$data_meta = array(
									'document_id'=>$en_document_id,
									'meta_key'=>'keyword',
									'meta_value'=>trim($keyword)
								);
								$this->document->insert_meta($data_meta);
							}
						}
					}

					redirect('admin/documents/' . $this->input->post('content_type',true));
				} else {
					$this->add($this->input->post());
				}
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function destroy() {
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
			$document_ids = $this->input->post('document_ids',true);
			foreach($document_ids as $document_id) {
				$this->document->destroy($document_id);
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	/* START: validation callback */
	public function check_required() {
		if ($_FILES['document_id']['error'] == UPLOAD_ERR_NO_FILE && $_FILES['document_en']['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		} else {
			return true;
		}
	}
	/* END: validation callback */
	
}

/* End of file photo_galleries.php */
/* Location: ./application/controllers/admin/photo_galleries.php */
