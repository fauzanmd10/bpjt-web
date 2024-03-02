<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Recaps extends CI_Controller {
	private $allowed_type = array('application/pdf'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('spm_keterangan_rekapitulasi', $this->session->userdata('user_group_id'));
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
		$this->load->model(array('document', 'comment'));
		
		$breadcrumbs = array(
				'' => 'Rekapitulasi SPM'
		);
		$stylesheets = array('isotope.css', 'colorbox.css', 'jquery.fileupload-ui.css');
		$jscripts = array(
			'jquery.isotope.min.js'=>'vendor',
			'jquery.colorbox-min.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'admin.spm-recap.index.js'=>'application',
			//'elements.js'=>'application',
		);
		$entry = 20;
		$page = ($this->input->get('page',true)) ? intval($this->input->get('page',true)) : 1;
		$filename = ($this->input->get('filename',true)) ? clean_str($this->input->get('filename',true)) : "";
		$prev_btn = $next_btn = array();
		
		$offset = (($page-1)*$entry) + 1;
		$documents = $this->document->get_spm_recaps($offset, $entry, $filename);
		$count_documents = $this->document->count_spm_recaps($filename);
		$total_page = $this->document->total_page($count_documents, $entry);
		$success = $this->session->flashdata('documents_success');
		$fail = $this->session->flashdata('documents_fail');
		
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Rekapitulasi SPM'), true),
			'content' => $this->load->view('admin/spm_recaps/index', array('documents'=>$documents, 'count_documents'=>$count_documents, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page, 'flash_success'=>$success, 'flash_fail'=>$fail), true),
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
			'admin.spm-recap.show.js'=>'application'
		);
		$data = array(
			'content' => $this->load->view('admin/spm_recaps/show', array('document'=>$document), true),
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
				'semester'=>$this->input->post('semester',true),
				'year'=>$this->input->post('year',true)
			);
	
			if ($this->document->update($id, $data_document)) {
				$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data rekapitulasi SPM');
				$this->session->set_flashdata('document_success', true);
			} else {
				$this->session->set_flashdata('document_fail', true);
			}
	
			redirect('admin/spm_recaps');
		}
	}
	
	public function update_file($id) {
		if ($this->input->post()) {
							
			$this->load->model(array('document', 'user_log'));
	
			$filename = $_FILES['file']['name'];
			$extensions = explode('.', $filename);
			$extension = $extensions[count($extensions)-1];
			$filetype = $_FILES['file']['type'];
			$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/spm/' . $id;
	
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}
	
			$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
			$new_filepath = base_url() . 'uploads/spm/' . $id . '/' . $new_filename;
	
			move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);
			$data_document = array(
				'filename'=>$new_filename,
				'url'=>$new_filepath
			);
			$this->document->update($id, $data_document);

			$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data file rekapitulasi SPM');
	
			$retjson = array(
				'status'=>'success',
				'new_filepath'=>$new_filepath
			);
	
			echo json_encode($retjson);
		}
	}
	
	public function add($filled_value=null) {
		$this->load->model(array('comment', 'document'));
		$this->load->library('form_validation');
	
		$breadcrumbs = array(
			'admin/spm_recaps' => 'Rekapitulasi SPM',
			'' => 'Tambah Rekapitulasi SPM'
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
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Tambah Rekapitulasi SPM'), true),
			'content' => $this->load->view('admin/spm_recaps/add', array('document'=>$document), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}
	
	public function create() {
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
				$data_document = array(
					'title'=>$this->input->post('title_id',true),
					'caption'=>$this->input->post('content_id',true),
					'url'=>'',
					'semester'=>$this->input->post('semester_id',true),
					'year'=>$this->input->post('year_id',true),
					'filename'=>'',
					'slug'=>$this->create_slug($this->input->post('title_id',true)),
					'content_type'=>'spm',
					'sub_content_type'=>'',
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);
	
				if ($this->document->insert($data_document)) {
					$doc_id = $this->db->insert_id();
	
					$filename = $_FILES['file_id']['name'];
					$extensions = explode('.', $filename);
					$extension = $extensions[count($extensions)-1];
					$filetype = $_FILES['file_id']['type'];
					$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/spm/' . $doc_id;
	
					if (!is_dir($upload_dir)) {
						mkdir($upload_dir, 0777, true);
					}
	
					$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					$new_filepath = base_url() . 'uploads/spm/' . $doc_id . '/' . $new_filename;
	
					move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
					$data_document = array(
						'filename'=>$new_filename,
						'url'=>$new_filepath
					);
					$this->document->update($doc_id, $data_document);

					$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $doc_id, 'Pengguna menambah data peraturan');
	
					$this->session->set_flashdata('documents_success', true);
					redirect('admin/spm_recaps');
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
			$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $document_id, 'Pengguna menghapus data rekapitulasi SPM');
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}
	
	/* START: validation callback */
	public function check_required() {
		if ($_FILES['file_id']['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		} else {
			return true;
		}
	}

	public function check_filesize() {
		if ($_FILES['file_id']['error'] == UPLOAD_ERR_INI_SIZE) {
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