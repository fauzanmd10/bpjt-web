<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regulations extends CI_Controller {
	private $allowed_type = array('application/pdf'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('peraturan', $this->session->userdata('user_group_id'));
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
	
	public $types = array(
		'0'=>'',
		'undang-undang'=>'Undang-Undang',
		'peraturan-pemerintah'=>'Peraturan Pemerintah',
		'peraturan-presiden'=>'Peraturan Presiden',
		'peraturan-menteri'=>'Peraturan Menteri',
		'keputusan-menteri'=>'Keputusan Menteri',
		'keputusan-kepala-bpjt'=>'Keputusan Kepala BPJT',
		'keputusan-gubernur'=>'Keputusan Gubernur',
		'lainnya'=>'Lainnya'
	);
	
	public function index() {
		$this->load->model(array('document', 'comment'));
		
		$breadcrumbs = array(
				'' => 'Peraturan'
		);
		$stylesheets = array('isotope.css', 'colorbox.css', 'jquery.fileupload-ui.css');
		$jscripts = array(
			'jquery.isotope.min.js'=>'vendor',
			'jquery.colorbox-min.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'admin.regulations.index.js'=>'application',
			//'elements.js'=>'application',
		);
		$entry = 20;
		$page = ($this->input->post('page',true)) ? intval($this->input->post('page',true)) : 1;
		$filename = ($this->input->post('filename',true)) ? $this->input->post('filename',true) : "";
		$prev_btn = $next_btn = array();
		
		$offset = (($page - 1) * $entry) + 1;
		$documents = $this->document->get_regulations($page, $entry, $filename);
		$count_documents = $this->document->count_regulations($filename);
		$total_page = $this->document->total_page($count_documents, $entry);
		$success = $this->session->flashdata('documents_success');
		$fail = $this->session->flashdata('documents_fail');
		
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Peraturan'), true),
			'content' => $this->load->view('admin/regulations/index', array('documents'=>$documents, 'count_documents'=>$count_documents, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page, 'flash_success'=>$success, 'flash_fail'=>$fail), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model('document');
		$this->load->helper('form');

		$document = $this->document->get_document($id);
		$document = $document[0];
		$jscripts = array(
			'jquery.fileupload.js'=>'vendor',
			'jquery.iframe-transport.js'=>'vendor',
			'jquery.ui.widget.js'=>'vendor',
			'admin.regulations.show.js'=>'application'
		);
		$data = array(
			'content' => $this->load->view('admin/regulations/show', array('document'=>$document), true),
			'jscripts' => $jscripts
		);
		$this->load->view('layouts/content_minimal.php', $data);
	}
	
	public function update($id) {
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
	
			$data_document = array(
				'title'=>$this->input->post('title',true),
				'caption'=>$this->input->post('caption',true),
				'url'=>$this->input->post('url',true)
			);
	
			if ($this->document->update($id, $data_document)) {
				$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data peraturan');
				$this->session->set_flashdata('document_success', true);
			} else {
				$this->session->set_flashdata('document_fail', true);
			}
	
			redirect('admin/regulations');
		}
	}
	
	public function update_file($id) {
		die();
		if ($this->input->post()) {
			$mime = mime_content_type($_FILES['file']['tmp_name']);
			if ($mime == 'application/pdf' ){				
				$this->load->model(array('document', 'user_log'));
		
				$filename = $_FILES['file']['name'];
				$extensions = explode('.', $filename);
				$extension = $extensions[count($extensions)-1];
				$filetype = $_FILES['file']['type'];
				$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/' . $id;
		
				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0777, true);
				}
		
				$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
				$new_filepath = base_url() . 'uploads/files/' . $id . '/' . $new_filename;
		
				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);
				$data_document = array(
					'filename'=>$new_filename,
					'url'=>$new_filepath
				);
				$this->document->update($id, $data_document);

				$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data file peraturan');
		
				$retjson = array(
					'status'=>'success',
					'new_filepath'=>$new_filepath
				);
			}else{
				$retjson = array(
					'status'=>'fail',
				);
			}
		
			echo json_encode($retjson);
		}
	}
	
	public function add($filled_value=null) {
		$this->load->model(array('comment', 'document'));
		$this->load->library('form_validation');
	
		$breadcrumbs = array(
			'admin/regulations' => 'Peraturan',
			'' => 'Tambah'
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
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Tambah Peraturan'), true),
			'content' => $this->load->view('admin/regulations/add', array('document'=>$document), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}
	
	public function create() {
		die();
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
			$this->load->library('form_validation');
	
			$this->form_validation->set_rules('file_id_file_en', 'File', 'trim|callback_check_required');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filetype');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filesize');
			$this->form_validation->set_message('check_required', 'File dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_filetype', 'Silakan ganti file karena tipe file tidak dikenal.');
			$this->form_validation->set_message('check_filesize', 'Ukuran dokumen yang anda upload terlalu besar.');
	
			if ($this->form_validation->run()) {
				$type_id = ($this->input->post('type_id',true) == "0") ? null : $this->types[$this->input->post('type_id',true)];
				$data_document = array(
					'title'=>$this->input->post('title_id',true),
					'caption'=>$this->input->post('content_id',true),
					'url'=>'',
					'semester'=>0,
					'year'=>0,
					'filename'=>'',
					'slug'=>$this->create_slug($this->input->post('title_id',true)),
					'content_type'=>'regulation',
					'sub_content_type'=>$this->input->post('type_id',true),
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);
	
				if ($this->document->insert($data_document)) {
					$mime = mime_content_type($_FILES['file_id']['tmp_name']);
					
					if ($mime == 'application/pdf' ){
						$doc_id = $this->db->insert_id();
	
						$filename = $_FILES['file_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions)-1];
						$filetype = $_FILES['file_id']['type'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/' . $doc_id;
						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0777, true);
						}
		
						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_filepath = base_url() . 'uploads/files/' . $doc_id . '/' . $new_filename;
		
						move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
						
						$data_document = array(
							'filename'=>$new_filename,
							'url'=>$new_filepath
						);
						$this->document->update($doc_id, $data_document);
					}else{
						// echo 'sini';
						$this->session->set_flashdata('fail','Type File Salah.SIlahkan Ganti File Lain!');
						// $this->add($this->input->post());
						redirect('admin/regulations/add');
					}
					// exit();
					if ($this->input->post('title_en',true) != "") {
						$mime = mime_content_type($_FILES['file_en']['tmp_name']);
						if ($mime == 'application/pdf' ){
							$type_en = ($this->input->post('type_en',true) == "0") ? null : $this->input->post('type_en',true);
							$data_document = array(
								'title'=>$this->input->post('title_en',true),
								'caption'=>$this->input->post('content_en',true),
								'url'=>'',
								'semester'=>0,
								'year'=>0,
								'slug'=>$this->create_slug($this->input->post('title_en',true)),
								'content_type'=>'regulation',
								'sub_content_type'=>$this->input->post('type_en',true),
								'lang'=>'en',
								'status'=>$this->input->post('status_en',true),
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s')
							);
							$this->document->insert($data_document);
							$en_doc_id = $this->db->insert_id();
		
							$filename = $_FILES['file_en']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['file_en']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/' . $en_doc_id;
		
							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0777, true);
							}
		
							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_filepath = base_url() . 'uploads/files/' . $en_doc_id . '/' . $new_filename;
		
							move_uploaded_file($_FILES['file_en']['tmp_name'], $upload_dir . '/' . $new_filename);
							$data_document = array(
								'filename'=>$new_filename,
								'url'=>$new_filepath
							);
							$this->document->update($en_doc_id, $data_document);
						}else{
							// echo 'sini';
							$this->session->set_flashdata('fail','Wrong File Type. Please Change Files!');
							// $this->add($this->input->post());
							redirect('admin/regulations/add');
						}
					}

					$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $doc_id, 'Pengguna menambah data peraturan');
		
						$this->session->set_flashdata('documents_success', true);
					
					redirect('admin/regulations');
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
			$document_id = $this->input->post('document_id',true);
			$this->document->destroy($document_id);
			$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $document_id, 'Pengguna menghapus data peraturan');
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}
	
	/* START: validation callback */
	public function check_required() {
		if ($_FILES['file_id']['error'] == UPLOAD_ERR_NO_FILE && $_FILES['file_en']['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		} else {
			return true;
		}
	}

	public function check_filesize() {
		if ($_FILES['file_id']['error'] == UPLOAD_ERR_INI_SIZE) {
			return false;
		} elseif ($_FILES['file_en']['error'] == UPLOAD_ERR_INI_SIZE) {
			return false;
		} else {
			return true;
		}
	}
	
	public function check_filetype() {
		if ($_FILES['file_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['file_id']['type']);
	
			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} elseif ($_FILES['file_en']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['file_en']['type']);
	
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
	
	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);
	
		return $string;
	}
}