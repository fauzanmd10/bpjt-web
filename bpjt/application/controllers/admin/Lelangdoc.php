<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lelangdoc extends CI_Controller
{
	private $allowed_type = array('application/pdf' => 1);
	public $user_access;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('lelangdocs', $this->session->userdata('user_group_id'));
		$this->user_access = $this->user_access[0];
		if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
			$this->session->set_flashdata('access_denied', true);
			redirect('auctions');
		} elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
			$this->session->set_flashdata('access_denied', true);
			redirect('auctions');
		} elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('auctions');
		} elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
			echo json_encode(array('status' => 'fail', 'code' => 1));
			exit;
		}
	}

	public $types = array(
		'0' => '',
		'doc_pq' => 'Document Praqualification',
		'form_a' => 'Form A',
		'form_b' => 'Form B',
		'form_c' => 'Form C',
		'form_d' => 'Form D',
		'form_e' => 'Form E',
		'form_f' => 'Form F',
		'form_g' => 'Form G',
		'form_h' => 'Form H',
		'form_i' => 'Form I',
		'form_j' => 'Form J',
		'form_k' => 'Form K',
		'form_l' => 'Form L',
		'form_m' => 'Form M',
		'lainnya' => 'Others'
	);
	public $types_pq = array(
		'0' => '',
		'form-pq' => 'Dokumen PraQualification',
		'lainnya' => 'Lainnya'
	);
	public $types_pqinvest = array(
		'0' => '',
		'form-pqinvest' => 'Dokumen PQ Investment Gedebage',
		'lainnya' => 'Lainnya'
	);
	public $types_investgili = array(
		'0' => '',
		'form-investgili' => 'Dokumen PQ Investment Gilimanuk',
		'lainnya' => 'Lainnya'
	);
	public $types_pqjorr2 = array(
		'0' => '',
		'form-pqjorr2' => 'Dokumen PQ Investment Cikunir - Ulujami (JORR 2 Elevated)',
		'lainnya' => 'Lainnya'
	);
	public $types_pqpatimban = array(
		'0' => '',
		'form-pqpatimban' => 'Dokumen PQ Investment Akses Patimban',
		'lainnya' => 'Lainnya'
	);
	public $types_pqkater = array(
		'0' => '',
		'form-pqkater' => 'Dokumen PQ Investment Kamal - Teluk Naga - Rajeg',
		'lainnya' => 'Lainnya'
	);
	public $types_pqsetakarat = array(
		'0' => '',
		'form-pqsetakarat' => 'Dokumen PQ Investment Sentul Selatan - Karawang Barat',
		'lainnya' => 'Lainnya'
	);
	public $types_pqboser = array(
		'0' => '',
		'form-pqboser' => 'Dokumen PQ Investment Bogor - Sentul via Parung',
		'lainnya' => 'Lainnya'
	);
	public $types_pqkedigung = array(
		'0' => '',
		'form-pqboser' => 'Dokumen PQ Kediri - Tulung Agung',
		'lainnya' => 'Lainnya'
	);
	public $types_rfp = array(
		'0' => '',
		'form-pqinvest' => 'Dokumen Proposal',
		'lainnya' => 'Lainnya'
	);

	public function index()
	{
		$this->load->model(array('document', 'document_lelang', 'comment'));
		$user_id = $this->session->userdata('user_id');
		$user_group_id = $this->session->userdata('user_group_id');
		$breadcrumbs = array(
			'' => 'Lelang'
		);
		$stylesheets = array('isotope.css', 'colorbox.css', 'jquery.fileupload-ui.css');
		$jscripts = array(
			'jquery.isotope.min.js' => 'vendor',
			'jquery.colorbox-min.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'elements.js' => 'application',
			'prettify/prettify.js' => 'vendor',
			'jquery.jgrowl.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.dataTables.min.js' => 'vendor',
			'admin.lelangdocs.index.js' => 'application',
			//'elements.js'=>'application',
			'admin.lelangdocsalbum.index.js?v=' . time() => 'application',
			// 'admin.regulations.index.js'=>'application',
			'admin.formlelangdocsalbum.index.js?v=' . time() => 'application',

		);
		$entry = 20;
		$page = ($this->input->get('page', true)) ? intval($this->input->get('page', true)) : 1;
		$filename = ($this->input->get('filename', true)) ? clean_str($this->input->get('filename', true)) : "";
		$prev_btn = $next_btn = array();

		$offset = (($page - 1) * $entry) + 1;
		$documents = $this->document_lelang->get_regulations($page, $entry, $filename, $user_id, $user_group_id);
		$documentspq = $this->document->get_documentspq($page, $entry, $filename);
		$count_documents = $this->document_lelang->count_regulations($filename, $user_id, $user_group_id);
		$total_page = $this->document_lelang->total_page($count_documents, $entry);
		$success = $this->session->flashdata('documents_success');
		$fail = $this->session->flashdata('documents_fail');
		if ($user_group_id == '18' || $user_group_id == '20' || $user_group_id == '22' || $user_group_id == '23' || $user_group_id == '24' || $user_group_id == '26' || $user_group_id == '28' || $user_group_id == '30' || $user_group_id == '32' || $user_group_id == '34' || $user_group_id == '36' || $user_group_id == '42' || $user_group_id == '44') {
			# code...
			$menudoc = $this->load->view('layouts/menu_lelang', null, true);
		} else if ($user_group_id == '19' || $user_group_id == '21' || $user_group_id == '25' || $user_group_id == '27' || $user_group_id == '29' || $user_group_id == '31' || $user_group_id == '33' || $user_group_id == '35' || $user_group_id == '37' || $user_group_id == '43' || $user_group_id == '45') {
			# code...
			$menudoc = $this->load->view('layouts/admin_lelang', null, true);
		} else if ($user_group_id == '77') {
			# code...
			$menudoc = $this->load->view('layouts/admin_lelang_all', null, true);
		} else {
			$menudoc = $this->load->view('layouts/admin_menu', null, true);
		}

		if ($this->session->userdata('user_group_id') == '22' || $this->session->userdata('user_group_id') == '23') {
			$title = "Document Proposal";
		} else {
			$title = "PreQualification";
		}

		$data = array(
			'menu' => $menudoc,
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'Dokumen', 'title' => $title), true),
			'content' => $this->load->view('admin/lelangdoc/index', array('documentspq' => $documentspq, 'documents' => $documents, 'count_documents' => $count_documents, 'offset' => $offset, 'page' => $page, 'total_page' => $total_page, 'flash_success' => $success, 'flash_fail' => $fail), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
		//  print_r($this->session->userdata());
		// print_r($this->user_access);
	}

	public function show($id)
	{
		$this->load->model('document_lelang');
		$this->load->helper('form');

		$document_lelang = $this->document_lelang->get_document($id);
		$document_lelang = $document_lelang[0];
		$jscripts = array(
			'jquery.fileupload.js' => 'vendor',
			'jquery.iframe-transport.js' => 'vendor',
			'jquery.ui.widget.js' => 'vendor',
			'admin.lelangdocs.show.js' => 'application'
		);
		$data = array(
			'content' => $this->load->view('admin/lelangdoc/show', array('document_lelang' => $document_lelang), true),
			'jscripts' => $jscripts
		);
		$this->load->view('layouts/content_minimal.php', $data);
		// print_r($data);
	}

	public function shows($id)
	{
		$this->load->model('document');
		$this->load->helper('form');

		$document = $this->document->get_document($id);
		$document = $document[0];
		$jscripts = array(
			'jquery.fileupload.js' => 'vendor',
			'jquery.iframe-transport.js' => 'vendor',
			'jquery.ui.widget.js' => 'vendor',
			'admin.regulations.show.js' => 'application'
		);
		$data = array(
			'content' => $this->load->view('admin/regulations/show', array('document' => $document), true),
			'jscripts' => $jscripts
		);
		$this->load->view('layouts/content_minimal.php', $data);
	}

	public function update($id)
	{
		if ($this->input->post()) {
			// echo "test";
			$this->load->model(array('document_lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('file_id_file_en', 'File', 'trim|callback_check_required');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filetype');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filesize');
			$this->form_validation->set_message('check_required', 'File dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_filetype', 'Silakan ganti file karena tipe file tidak dikenal.');
			$this->form_validation->set_message('check_filesize', 'Ukuran dokumen yang anda upload terlalu besar.');

			if ($this->form_validation->run()) {
				$type_id = ($this->input->post('type_id', true) == "0") ? null : $this->types[$this->input->post('type_id', true)];

				$sub_content_type = 'form-pqnull';
				$user_group_id = $this->session->userdata('user_group_id');
				if ($user_group_id == '33') {
					$sub_content_type = 'form-pqsetakarat';
				} elseif ($user_group_id == '43') {
					$sub_content_type = 'form-pqgaetacim';
				} elseif ($user_group_id == '45') {
					$sub_content_type = 'form-pqgilmeng';
				}

				$data_document = array(
					'title' => $this->input->post('title_id', true),
					'caption' => $this->input->post('content_id', true),
					'url' => '',
					'semester' => 0,
					'year' => 0,
					'filename' => '',
					'slug' => $this->create_slug($this->input->post('title_id', true)),
					'content_type' => 'regulation',
					'sub_content_type' => $sub_content_type,
					'lang' => 'id',
					'status' => 'published',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				);



				if ($this->document_lelang->update($id, $data_document)) {
					// if ($this->document_lelang->insert($data_document)) {
					// 	$mime = mime_content_type($_FILES['file_id']['tmp_name']);
					// 	// if ($mime == 'application/pdf') {

					// 	// 	$doc_id = $this->db->insert_id();

					// 	// 	$filename = $_FILES['file_id']['name'];
					// 	// 	$extensions = explode('.', $filename);
					// 	// 	$extension = $extensions[count($extensions) - 1];
					// 	// 	$filetype = $_FILES['file_id']['type'];
					// 	// 	// $size = $_FILES['file']['size'];
					// 	// 	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/lelangform/' . $doc_id;

					// 	// 	if (!is_dir($upload_dir)) {
					// 	// 		mkdir($upload_dir, 0755, true);
					// 	// 	}

					// 	// 	$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 	// 	$new_filepath = base_url() . 'uploads/files/lelangform/' . $doc_id . '/' . $new_filename;

					// 	// 	move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 	// 	$data_document = array(
					// 	// 		'filename' => $new_filename,
					// 	// 		'url' => $new_filepath
					// 	// 	);
					// 	// 	$this->document->update($doc_id, $data_document);
					// 	// }
					// 	if ($mime == 'application/pdf') {

					// 		$this->load->model(array('document_lelang', 'user_log'));
					// 		// $doc_id = $this->db->insert_id();

					// 		$filename = $_FILES['file']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions) - 1];
					// 		$filetype = $_FILES['file']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $id;
					// 		// $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/';


					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}

					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_filepath = base_url() . 'uploads/lelangdocs/' . $id . '/' . $new_filename;
					// 		// $new_filepath = base_url() . 'uploads/lelangdocs/' . $new_filename;


					// 		move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

					// 		$data_document = array(
					// 			'filename' => $new_filename,
					// 			'url' => $new_filepath,

					// 		);
					// 		$this->document_lelang->update($id, $data_document);
					// 	}
					// }
					if ($this->document_lelang->insert($data_document)) {
						// Handle PDF upload
						$mime = mime_content_type($_FILES['file']['tmp_name']);
						if ($mime == 'application/pdf') {
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $id;
							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$filename = $_FILES['file']['name'];
							$new_filename = md5($filename . date('YmdHis')) . '.pdf';
							$new_filepath = base_url() . 'uploads/lelangdocs/' . $id . '/' . $new_filename;

							move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

							// Update database with file information
							$data_document = array(
								'filename' => $new_filename,
								'url' => $new_filepath,
							);
							$this->document_lelang->update($id, $data_document);
						}
					}
					$this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $id, 'Pengguna mengubah data lelang');
					$this->session->set_flashdata('document_success', true);
					redirect('admin/lelangdoc');
				} else {
					$this->session->set_flashdata('document_failed', true);
				}
			} else {
				$this->add($this->input->post());
			}

			//pembatas
			// $data_document = array(
			// 	'title' => $this->input->post('title_id', true),
			// 	'caption' => $this->input->post('content_id', true)
			// );



			// if ($this->document_lelang->update($id, $data_document)) {
			// 	if ($this->document_lelang->insert($data_document)) {
			// 		$mime = mime_content_type($_FILES['file_id']['tmp_name']);
			// 		// if ($mime == 'application/pdf') {

			// 		// 	$doc_id = $this->db->insert_id();

			// 		// 	$filename = $_FILES['file_id']['name'];
			// 		// 	$extensions = explode('.', $filename);
			// 		// 	$extension = $extensions[count($extensions) - 1];
			// 		// 	$filetype = $_FILES['file_id']['type'];
			// 		// 	// $size = $_FILES['file']['size'];
			// 		// 	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/lelangform/' . $doc_id;

			// 		// 	if (!is_dir($upload_dir)) {
			// 		// 		mkdir($upload_dir, 0755, true);
			// 		// 	}

			// 		// 	$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
			// 		// 	$new_filepath = base_url() . 'uploads/files/lelangform/' . $doc_id . '/' . $new_filename;

			// 		// 	move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
			// 		// 	$data_document = array(
			// 		// 		'filename' => $new_filename,
			// 		// 		'url' => $new_filepath
			// 		// 	);
			// 		// 	$this->document->update($doc_id, $data_document);
			// 		// }
			// 		if ($mime == 'application/pdf') {

			// 			$this->load->model(array('document_lelang', 'user_log'));

			// 			$filename = $_FILES['file']['name'];
			// 			$extensions = explode('.', $filename);
			// 			$extension = $extensions[count($extensions) - 1];
			// 			$filetype = $_FILES['file']['type'];
			// 			// $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $id;
			// 			$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/';


			// 			if (!is_dir($upload_dir)) {
			// 				mkdir($upload_dir, 0755, true);
			// 			}

			// 			$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
			// 			// $new_filepath = base_url() . 'uploads/lelangdocs/' . $id . '/' . $new_filename;
			// 			$new_filepath = base_url() . 'uploads/lelangdocs/' . $new_filename;


			// 			move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

			// 			$data_document = array(
			// 				'filename' => $new_filename,
			// 				'url' => $new_filepath,

			// 			);
			// 			$this->document_lelang->update($id, $data_document);
			// 		}
			// 	}
			// 	$this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $id, 'Pengguna mengubah data lelang');
			// 	$this->session->set_flashdata('document_success', true);
			// 	redirect('admin/lelangdoc');
			// } else {
			// 	$this->session->set_flashdata('document_failed', true);
			// }


			//pembatas
			// $data_document = array(
			// 	'title' => $this->input->post('title_id', true),
			// 	'caption' => $this->input->post('content_id', true)
			// );
			// if ($this->document->insert($data_document)) {
			// 	$mime = mime_content_type($_FILES['file']['tmp_name']);
			// 	if ($mime == 'application/pdf') {

			// 		$this->load->model(array('document_lelang', 'user_log'));

			// 		$filename = $_FILES['file']['name'];
			// 		$extensions = explode('.', $filename);
			// 		$extension = $extensions[count($extensions) - 1];
			// 		$filetype = $_FILES['file']['type'];
			// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $id;
			// 		// $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/';


			// 		if (!is_dir($upload_dir)) {
			// 			mkdir($upload_dir, 0755, true);
			// 		}

			// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
			// 		$new_filepath = base_url() . 'uploads/lelangdocs/' . $id . '/' . $new_filename;
			// 		// $new_filepath = base_url() . 'uploads/lelangdocs/' . $new_filename;


			// 		move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

			// 		$data_document = array(
			// 			'filename' => $new_filename,
			// 			'url' => $new_filepath,

			// 		);
			// 		// $this->document_lelang->update($id, $data_document);
			// 		if ($this->document->update($id, $data_document)) {
			// 			$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data lelang');
			// 			$this->session->set_flashdata('document_success', true);
			// 		} else {
			// 			$this->session->set_flashdata('document_failed', true);
			// 		}
			// 	}
			// 	redirect('admin/lelangdoc');
			// 	// $this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $id, 'Pengguna mengubah data file lelang');

			// 	// $retjson = array(
			// 	// 	'status' => 'success',
			// 	// 	'new_filepath' => $new_filepath
			// 	// );
			// } else {
			// 	$retjson = array(
			// 		'status' => 'fail'
			// 	);
			// }

			// echo json_encode($retjson);
		}
	}

	public function update_file($id)
	{
		if ($this->input->post()) {
			$mime = mime_content_type($_FILES['file']['tmp_name']);
			if ($mime == 'application/pdf') {

				$this->load->model(array('document_lelang', 'user_log'));

				$filename = $_FILES['file']['name'];
				$extensions = explode('.', $filename);
				$extension = $extensions[count($extensions) - 1];
				$filetype = $_FILES['file']['type'];
				$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $id;

				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0755, true);
				}

				$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
				$new_filepath = base_url() . 'uploads/lelangdocs/' . $id . '/' . $new_filename;

				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);
				$data_document = array(
					'filename' => $new_filename,
					'url' => $new_filepath
				);
				$this->document_lelang->update($id, $data_document);

				$this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $id, 'Pengguna mengubah data file lelang');

				$retjson = array(
					'status' => 'success',
					'new_filepath' => $new_filepath
				);
			} else {
				$retjson = array(
					'status' => 'fail'
				);
			}

			echo json_encode($retjson);

			redirect('admin/lelangdoc');
		}
	}

	public function update_form($id)
	{
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));

			$data_document = array(
				'title' => $this->input->post('title_id', true),
				'caption' => $this->input->post('content_id', true)
			);

			if ($this->document->update($id, $data_document)) {
				$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $id, 'Pengguna mengubah data lelang');
				$this->session->set_flashdata('document_success', true);
			} else {
				$this->session->set_flashdata('document_failed', true);
			}

			redirect('admin/lelangdoc');
		}
	}

	public function add($filled_value = null)
	{
		$this->load->model(array('comment', 'document_lelang'));
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/lelang' => 'Pelelangan',
			'' => 'Tambah'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js' => 'vendor',
			'bootstrap-timepicker.min.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.validate.min.js' => 'vendor',
			'jquery.tagsinput.min.js' => 'vendor',
			'jquery.autogrow-textarea.js' => 'vendor',
			'charCount.js' => 'vendor',
			'ui.spinner.min.js' => 'vendor',
			'chosen.jquery.min.js' => 'vendor',
			'forms.js' => 'vendor',
			'tinymce/jquery.tinymce.js' => 'vendor',
			'wysiwyg.js' => 'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.photo-gallery.form.css');

		$document = array();
		if (isset($filled_value)) {
			$document = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/menu_lelang', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Tambah Dokumen'), true),
			'content' => $this->load->view('admin/lelangdoc/add_edit', array('document_lelang' => $document, 'form_url' => 'admin/lelangdoc/create'), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create()
	{

		if ($this->input->post()) {
			$this->load->model(array('document_lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('file_id_file_en', 'File', 'trim|callback_check_required');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filetype');
			$this->form_validation->set_rules('file', 'File', 'trim|callback_check_filesize');
			$this->form_validation->set_message('check_required', 'File dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_filetype', 'Silakan ganti file karena tipe file tidak dikenal.');
			$this->form_validation->set_message('check_filesize', 'Ukuran dokumen yang anda upload terlalu besar.');

			if ($this->form_validation->run()) {
				$type_id = ($this->input->post('type_id', true) == "0") ? null : $this->types[$this->input->post('type_id', true)];
				$data_document = array(
					'title' => clean_str($this->input->post('title_id', true)),
					'caption' => clean_str($this->input->post('content_id', true)),
					'url' => '',
					'semester' => 0,
					'year' => 0,
					'filename' => '',
					'slug' => $this->create_slug($this->input->post('title_id', true)),
					'content_type' => 'Lelang',
					'sub_content_type' => $this->input->post('type_id', true),
					'lang' => 'id',
					// 'status'=>$this->input->post('status_id',true),
					'status' => 'published',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
					'lelang_user_id' => $this->session->userdata('user_id')
				);

				if ($this->document_lelang->insert($data_document)) {
					$mime = mime_content_type($_FILES['file_id']['tmp_name']);
					if ($mime == 'application/pdf') {

						$doc_id = $this->db->insert_id();

						$filename = $_FILES['file_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions) - 1];
						$filetype = $_FILES['file_id']['type'];
						// $size = $_FILES['file']['size'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $doc_id;

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0755, true);
						}

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_filepath = base_url() . 'uploads/lelangdocs/' . $doc_id . '/' . $new_filename;

						move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
						$data_document = array(
							'filename' => $new_filename,
							'url' => $new_filepath
						);
						$this->document_lelang->update($doc_id, $data_document);
					}

					if ($this->input->post('title_en', true) != "") {
						$mime = mime_content_type($_FILES['file_id']['tmp_name']);
						if ($mime == 'application/pdf') {

							$type_en = ($this->input->post('type_en', true) == "0") ? null : $this->input->post('type_en', true);
							$data_document = array(
								'title' => $this->input->post('title_en', true),
								'caption' => $this->input->post('content_en', true),
								'url' => '',
								'semester' => 0,
								'year' => 0,
								'slug' => $this->create_slug($this->input->post('title_en', true)),
								'content_type' => 'regulation',
								'sub_content_type' => $this->input->post('type_en', true),
								'lang' => 'en',
								// 'status'=>$this->input->post('status_en',true),
								'status' => 'published',
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s'),
								'lelang_user_id' => $this->session->userdata('user_id')

							);
							$this->document_lelang->insert($data_document);
							$en_doc_id = $this->db->insert_id();

							$filename = $_FILES['file_en']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions) - 1];
							$filetype = $_FILES['file_en']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangdocs/' . $en_doc_id;

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_filepath = base_url() . 'uploads/lelangdocs/' . $en_doc_id . '/' . $new_filename;

							move_uploaded_file($_FILES['file_en']['tmp_name'], $upload_dir . '/' . $new_filename);
							$data_document = array(
								'filename' => $new_filename,
								'url' => $new_filepath
							);
							$this->document_lelang->update($en_doc_id, $data_document);
						}
					}

					$this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $doc_id, 'Pengguna menambah data lelang');

					$this->session->set_flashdata('documents_success', true);
					redirect('auctions');
				} else {
					$this->add($this->input->post());
				}
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function add_form($filled_value = null)
	{
		$this->load->model(array('comment', 'document_lelang'));
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/lelang' => 'Pelelangan',
			'' => 'Tambah'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js' => 'vendor',
			'bootstrap-timepicker.min.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.validate.min.js' => 'vendor',
			'jquery.tagsinput.min.js' => 'vendor',
			'jquery.autogrow-textarea.js' => 'vendor',
			'charCount.js' => 'vendor',
			'ui.spinner.min.js' => 'vendor',
			'chosen.jquery.min.js' => 'vendor',
			'forms.js' => 'vendor',
			'tinymce/jquery.tinymce.js' => 'vendor',
			'wysiwyg.js' => 'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.photo-gallery.form.css');

		$document = array();
		if (isset($filled_value)) {
			$document = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/menu_lelang', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Tambah Dokumen'), true),
			'content' => $this->load->view('admin/lelangdoc/add_edit_form', array('document_lelang' => $document, 'form_url' => 'admin/lelangdoc/create_form'), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create_form()
	{

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
				$type_id = ($this->input->post('type_id', true) == "0") ? null : $this->types[$this->input->post('type_id', true)];

				$sub_content_type = 'form-pqnull';
				$user_group_id = $this->session->userdata('user_group_id');
				if ($user_group_id == '33') {
					$sub_content_type = 'form-pqsetakarat';
				} elseif ($user_group_id == '43') {
					$sub_content_type = 'form-pqgaetacim';
				} elseif ($user_group_id == '45') {
					$sub_content_type = 'form-pqgilmeng';
				}

				$data_document = array(
					'title' => $this->input->post('title_id', true),
					'caption' => $this->input->post('content_id', true),
					'url' => '',
					'semester' => 0,
					'year' => 0,
					'filename' => '',
					'slug' => $this->create_slug($this->input->post('title_id', true)),
					'content_type' => 'regulation',
					'sub_content_type' => $sub_content_type,
					'lang' => 'id',
					'status' => 'published',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($this->document->insert($data_document)) {
					$mime = mime_content_type($_FILES['file_id']['tmp_name']);
					if ($mime == 'application/pdf') {

						$doc_id = $this->db->insert_id();

						$filename = $_FILES['file_id']['name'];
						$extensions = explode('.', $filename);
						$extension = $extensions[count($extensions) - 1];
						$filetype = $_FILES['file_id']['type'];
						// $size = $_FILES['file']['size'];
						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/lelangform/' . $doc_id;

						if (!is_dir($upload_dir)) {
							mkdir($upload_dir, 0755, true);
						}

						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
						$new_filepath = base_url() . 'uploads/files/lelangform/' . $doc_id . '/' . $new_filename;

						move_uploaded_file($_FILES['file_id']['tmp_name'], $upload_dir . '/' . $new_filename);
						$data_document = array(
							'filename' => $new_filename,
							'url' => $new_filepath
						);
						$this->document->update($doc_id, $data_document);
					}

					$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $doc_id, 'Pengguna menambah dokumen');

					$this->session->set_flashdata('documents_success', true);
					redirect('auctions');
				} else {
					$this->add($this->input->post());
				}
			} else {
				$this->add($this->input->post());
			}
		}
	}

	// public function create_form()
	// {
	// 	if ($this->input->post()) {
	// 		$this->load->model(array('document', 'user_log'));
	// 		$this->load->library('form_validation');

	// 		// Set validation rules for the file upload field
	// 		$this->form_validation->set_rules('file', 'File', 'callback_check_required|callback_check_filetype|callback_check_filesize');
	// 		$this->form_validation->set_message('check_required', 'File dalam Bahasa Indonesia harus terisi');
	// 		$this->form_validation->set_message('check_filetype', 'Silakan ganti file karena tipe file tidak dikenal.');
	// 		$this->form_validation->set_message('check_filesize', 'Ukuran dokumen yang anda upload terlalu besar.');

	// 		if ($this->form_validation->run()) {
	// 			// File validation passed, proceed with other data processing
	// 			$type_id = ($this->input->post('type_id', true) == "0") ? null : $this->types[$this->input->post('type_id', true)];

	// 			// Determine sub content type based on user group
	// 			$sub_content_type = 'form-pqnull';
	// 			$user_group_id = $this->session->userdata('user_group_id');
	// 			if ($user_group_id == '33') {
	// 				$sub_content_type = 'form-pqsetakarat';
	// 			} elseif ($user_group_id == '43') {
	// 				$sub_content_type = 'form-pqgaetacim';
	// 			} elseif ($user_group_id == '45') {
	// 				$sub_content_type = 'form-pqgilmeng';
	// 			}

	// 			// Prepare document data
	// 			$data_document = array(
	// 				'title' => $this->input->post('title_id', true),
	// 				'caption' => $this->input->post('content_id', true),
	// 				'url' => '',
	// 				'semester' => 0,
	// 				'year' => 0,
	// 				'filename' => '',
	// 				'slug' => $this->create_slug($this->input->post('title_id', true)),
	// 				'content_type' => 'regulation',
	// 				'sub_content_type' => $sub_content_type,
	// 				'lang' => 'id',
	// 				'status' => 'published',
	// 				'created_at' => date('Y-m-d H:i:s'),
	// 				'updated_at' => date('Y-m-d H:i:s')
	// 			);

	// 			if ($this->document->insert($data_document)) {
	// 				// Document inserted, proceed with file upload
	// 				$doc_id = $this->db->insert_id();
	// 				$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/lelangform/' . $doc_id;

	// 				if (!is_dir($upload_dir)) {
	// 					mkdir($upload_dir, 0755, true);
	// 				}

	// 				// Generate new filename to avoid conflicts
	// 				$filename = $_FILES['file']['name'];
	// 				$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// 				$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
	// 				$new_filepath = base_url() . 'uploads/files/lelangform/' . $doc_id . '/' . $new_filename;

	// 				$this->load->library('upload', $config);
	// 				// Move uploaded file to the upload directory
	// 				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

	// 				// Update document record with file details
	// 				$data_document = array(
	// 					'filename' => $new_filename,
	// 					'url' => $new_filepath
	// 				);
	// 				$this->document->update($doc_id, $data_document);

	// 				// Log user action
	// 				$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $doc_id, 'Pengguna menambah dokumen');

	// 				// Set flash message and redirect
	// 				$this->session->set_flashdata('documents_success', true);
	// 				redirect('auctions');
	// 			} else {
	// 				// Document insertion failed, handle accordingly
	// 				$this->add($this->input->post());
	// 			}
	// 		} else {
	// 			// Form validation failed, re-display the form with validation errors
	// 			$this->add($this->input->post());
	// 		}
	// 	}
	// }

	public function edit($id)
	{
		$this->load->model(array('comment', 'document_lelang'));
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/lelang' => 'Pelelangan',
			'' => 'Tambah'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js' => 'vendor',
			'bootstrap-timepicker.min.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.validate.min.js' => 'vendor',
			'jquery.tagsinput.min.js' => 'vendor',
			'jquery.autogrow-textarea.js' => 'vendor',
			'charCount.js' => 'vendor',
			'ui.spinner.min.js' => 'vendor',
			'chosen.jquery.min.js' => 'vendor',
			'forms.js' => 'vendor',
			'tinymce/jquery.tinymce.js' => 'vendor',
			'wysiwyg.js' => 'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.photo-gallery.form.css');

		$document = $this->document_lelang->get_document($id);
		if (isset($document[0])) {
			$document = $document[0];
		}

		$data = array(
			'menu' => $this->load->view('layouts/menu_lelang', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Edit Dokumen'), true),
			'content' => $this->load->view('admin/lelangdoc/add_edit', array('document' => $document, 'form_url' => 'admin/lelangdoc/update/' . ($document->id ?? '')), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function edit_form($id)
	{
		$this->load->model(array('comment', 'document'));
		$this->load->library('form_validation');

		$breadcrumbs = array(
			'admin/lelang' => 'Pelelangan',
			'' => 'Tambah'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js' => 'vendor',
			'bootstrap-timepicker.min.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.validate.min.js' => 'vendor',
			'jquery.tagsinput.min.js' => 'vendor',
			'jquery.autogrow-textarea.js' => 'vendor',
			'charCount.js' => 'vendor',
			'ui.spinner.min.js' => 'vendor',
			'chosen.jquery.min.js' => 'vendor',
			'forms.js' => 'vendor',
			'tinymce/jquery.tinymce.js' => 'vendor',
			'wysiwyg.js' => 'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.photo-gallery.form.css');

		$document = $this->document->get_document($id);
		if (isset($document[0])) {
			$document = $document[0];
		}

		$data = array(
			'menu' => $this->load->view('layouts/menu_lelang', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Edit Dokumen'), true),
			'content' => $this->load->view('admin/lelangdoc/add_edit_form', array('document' => $document, 'form_url' => 'admin/lelangdoc/update_form/' . ($document->id ?? '')), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function destroy()
	{
		if ($this->input->post()) {
			$this->load->model(array('document_lelang', 'user_log'));
			$document_id = $this->input->post('document_id', true);
			$this->document_lelang->destroy($document_id);
			$this->user_log->add_log($this->session->userdata('user_id'), 'documents_lelang', $document_id, 'Pengguna menghapus data lelang');
			echo json_encode(array('status' => 'success'));
			$this->session->set_flashdata('documents_delete_success', true);
		} else {
			$this->session->set_flashdata('documents_delete_failed', true);
		}
		redirect('auctions');
	}

	public function destroy_form()
	{
		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
			$document_id = $this->input->post('document_id', true);
			$this->document->destroy($document_id);
			$this->user_log->add_log($this->session->userdata('user_id'), 'documents', $document_id, 'Pengguna menghapus data lelang');
			echo json_encode(array('status' => 'success'));
			$this->session->set_flashdata('documents_delete_success', true);
		} else {
			$this->session->set_flashdata('documents_delete_failed', true);
		}
		redirect('auctions');
	}

	/* START: validation callback */
	public function check_required()
	{
		if ($_FILES['file_id']['error'] == UPLOAD_ERR_NO_FILE && $_FILES['file_en']['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		} else {
			return true;
		}
	}

	public function check_filesize()
	{
		define('MB', 3048576);
		if ($_FILES['file_id']['size'] > 5 * MB) {
			# code...
			if ($_FILES['file_id']['error'] == UPLOAD_ERR_INI_SIZE) {
				return false;
			} elseif ($_FILES['file_en']['error'] == UPLOAD_ERR_INI_SIZE) {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_filetype()
	{
		if ($_FILES['file_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['file_id']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} elseif ($_FILES['file_en']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['file_en']['tmp_name']);

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

	private function create_slug($string)
	{
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}


	public function api_get_all_docalbums()
	{
		$this->load->model(array('document_lelang', 'comment'));
		$user_id = $this->session->userdata('user_id');
		$user_group_id = $this->session->userdata('user_group_id');
		$entry = 20;
		$page = ($this->input->get('page', true)) ? intval($this->input->get('page', true)) : 1;
		$filename = ($this->input->get('filename', true)) ? clean_str($this->input->get('filename', true)) : "";
		$prev_btn = $next_btn = array();

		$offset = (($page - 1) * $entry) + 1;
		$count_documents = $this->document_lelang->count_regulations($filename, $user_id, $user_group_id);
		$total_page = $this->document_lelang->total_page($count_documents, $entry);

		$id_ruas = (int)$this->input->get('id_ruas');
		$username = $this->session->userdata('username');
		if ($username == 'adm_setakarat') {
			$id_ruas = 73;
		} elseif ($username == 'adm_gaetacim') {
			$id_ruas = 85;
		} elseif ($username == 'adm_gilmeng') {
			$id_ruas = 63;
		}

		$albums = $this->document_lelang->get_documents($page, $entry, $filename, $user_id, $user_group_id, $id_ruas);


		// print_r($albums);
		$ret_albums = array();
		$no = 1;
		foreach ($albums as $album) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $album->id . "\" id=\"checker-" . $album->id . "\" /></span></div></span>";
			$created_at = strtotime($album->created_at);
			$updated_at = strtotime($album->updated_at);
			$lang = ($album->lang == "id") ? "Indonesia" : "Inggris";
			// if ($this->user_access->edit) {
			// 	if ($album->status == "published") {
			// 		$status = "<a href=\"" . site_url('admin/photo_albums/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
			// 	} else {
			// 		$status = "<a href=\"" . site_url('admin/photo_albums/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
			// 	}
			// } else {
			// 	$status = "";
			// }

			$file = "<a href=\"" . $album->url . "\"><img src=\"" . site_url('assets/images/thumbs/doc.png') . "\" target=\"_blank\"  alt=\"\" width=\"125\" /></a>";

			$edit_url = base_url() . 'admin/lelangdoc/edit/' . $album->id;
			$action = "<a href=\"" . $edit_url . "\" class=\"btn btn-warning m-r-10\">Edit</a>";
			$action .= "<button type=\"button\" class=\"btn btn-danger\" onclick=\"javascript:deleteDoc('" . $album->id . "')\">Hapus</button>";

			if ($this->session->userdata('user_group_id') == '19' || $this->session->userdata('user_group_id') == '21' || $this->session->userdata('user_group_id') == '23' || $this->session->userdata('user_group_id') == '25' || $this->session->userdata('user_group_id') == '27' || $this->session->userdata('user_group_id') == '29' || $this->session->userdata('user_group_id') == '31' || $this->session->userdata('user_group_id') == '33' || $this->session->userdata('user_group_id') == '35' || $this->session->userdata('user_group_id') == '43' || $this->session->userdata('user_group_id') == '45') {
				$temp_album = array($no, $album->ruas, $album->company_name, $album->title, $album->caption, $album->sub_content_type, date('d M Y H:i:s', $updated_at), $file, $action);
			} else {
				$temp_album = array($no, $album->ruas, $album->company_name, $album->title, $album->caption, $album->sub_content_type, date('d M Y H:i:s', $updated_at), $file);
			}
			array_push($ret_albums, $temp_album);
			$no++;
		}
		$json = array('aaData' => $ret_albums);

		echo json_encode($json);
	}

	public function api_get_all_formalbums()
	{
		$this->load->model(array('document', 'comment'));
		$entry = 20;
		$page = ($this->input->get('page', true)) ? intval($this->input->get('page', true, true)) : 1;
		$filename = ($this->input->get('filename', true)) ? clean_str($this->input->get('filename', true, true)) : "";
		$prev_btn = $next_btn = array();

		$offset = (($page - 1) * $entry) + 1;

		$id_ruas = (int)$this->input->get('id_ruas');
		$albums = $this->document->get_documentspq($page, $entry, $filename, $id_ruas);


		// print_r($albums);
		$ret_albums = array();
		$no = 1;
		foreach ($albums as $album) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $album->id . "\" id=\"checker-" . $album->id . "\" /></span></div></span>";
			$created_at = strtotime($album->created_at);
			$updated_at = strtotime($album->updated_at);
			$lang = ($album->lang == "id") ? "Indonesia" : "Inggris";
			if ($this->user_access->edit) {
				if ($album->status == "published") {
					$status = "<a href=\"" . site_url('admin/lelangdoc/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
				} else {
					$status = "<a href=\"" . site_url('admin/lelangdoc/update_status/' . $album->id) . "\" class=\"album-status\" data-id=\"" . $album->id . "\" id=\"album-status-" . $album->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
				}
			} else {
				$status = "";
			}
			// $file = "<a href=\"" .site_url('admin/lelangdoc/shows/'. $album->id)."\"><img src=\"" . site_url('assets/images/thumbs/doc.png')."\" alt=\"\" width=\"125\" id=\"medialist2\"/></a>";
			if ($this->session->userdata('user_group_id') == '22' || $this->session->userdata('user_group_id') == '23') {
				# code...
				$file = "<a href=\"#\" onclick=\"javascript:myFunc('" . $album->id . "','" . $album->url . "') \"><img src=\"" . site_url('assets/images/thumbs/doc.png') . "\" target=\"_blank\"  alt=\"\" width=\"125\" /></a>";
			} else {
				$file = "<a  href=\"" . $album->url . "\"><img src=\"" . site_url('assets/images/thumbs/doc.png') . "\" alt=\"\" width=\"125\"/></a>";
			}

			$edit_url = base_url() . 'admin/lelangdoc/edit_form/' . $album->id;
			$action = "<a href=\"" . $edit_url . "\" class=\"btn btn-warning m-r-10\">Edit</a>";
			$action .= "<button type=\"button\" class=\"btn btn-danger\" onclick=\"javascript:deleteForm('" . $album->id . "')\">Hapus</button>";

			if ($this->session->userdata('user_group_id') == '19' || $this->session->userdata('user_group_id') == '21' || $this->session->userdata('user_group_id') == '23' || $this->session->userdata('user_group_id') == '25' || $this->session->userdata('user_group_id') == '27' || $this->session->userdata('user_group_id') == '29' || $this->session->userdata('user_group_id') == '31' || $this->session->userdata('user_group_id') == '33' || $this->session->userdata('user_group_id') == '35' || $this->session->userdata('user_group_id') == '43' || $this->session->userdata('user_group_id') == '45') {
				$temp_album = array($no, $album->title, $album->sub_content_type, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $file, $action);
			} else {
				$temp_album = array($no, $album->title, $album->sub_content_type, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $file);
			}
			array_push($ret_albums, $temp_album);
			$no++;
		}
		$json = array('aaData' => $ret_albums);

		echo json_encode($json);
	}

	public function update_download($id)
	{
		if ($this->input->post()) {
			$this->load->model(array('document_lelang', 'user_log'));
			// $document_id = $this->input->post('document_id',true);
			$this->user_log->add_log($this->session->userdata('user_id'), 'Dokumen', $id, 'Pengguna melakukan download ');
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'fail', 'code' => 0));
		}
	}

	public function cek_download($doc_id)
	{

		if ($this->input->post()) {
			$this->load->model(array('document', 'user_log'));
			$check = $this->document->downloadcek($doc_id);
			if (empty($check)) {
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'fail', 'code' => 0));
			}
		} else {
			echo json_encode(array('status' => 'fail', 'code' => 0));
		}
	}

	public function update_status($id)
	{
		$this->load->model(array('document', 'user_log'));
		$album = $this->document->get_document($id);
		$album = $album[0];
		if ($album->status != "deleted") {
			if ($album->status == "published") {
				$data = array(
					'status' => 'draft',
					'updated_at' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'status' => 'published',
					'updated_at' => date('Y-m-d H:i:s')
				);
			}

			$this->document->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'albums', $id, 'Pengguna mengubah status data Dokumen PQ');

			$this->session->set_flashdata('documents_success', true);
			redirect('auctions');
		} else {
			redirect('/admin');
		}
	}
}
