<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lelangs extends CI_Controller {
	public $user_access;
	public $religion = array(
		"" => "- Pilih Agama -",
		"islam" => "Islam",
		"protestan" => "Kristen Protestan",
		"katholik" => "Kristen Katholik",
		"hindu" => "Hindu",
		"budha" => "Budha"
	);
	public $blood_type = array(
		"" => "- Pilih Golongan Darah -",
		"A" => "A",
		"B" => "B",
		"AB" => "AB",
		"O" => "O"
	);
	public $residence_status = array(
		"" => "- Pilih Status Tempat Tinggal -",
		"kontrak" => "Kontrak",
		"milik-sendiri" => "Milik Sendiri",
		"milik-orang-lain" => "Milik Orang Lain",
		"milik-orang-tua" => "Milik Orang Tua"
	);
	public $lelang_status = array(
		"" => "- Pilih Status Pegawai -",
		"pensiun" => "Pensiun",
		"aktif" => "Aktif",
		"cltn" => "CLTN",
		"tugas-belajar" => "Tugas Belajar",
		"berhenti-pindah" => "Berhenti / Pindah"
	);

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
		

		$method = $this->router->fetch_method();
		
		if ($method != 'edit') {
			$this->load->model('access');
			$this->user_access = $this->access->get_user_access_by_key('lelangusers', $this->session->userdata('user_group_id'));
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
				echo json_encode(array('status'=>'fail', 'code'=>1));
				exit;
			}
		}
	}

	public function index() {
		$this->load->model(['comment', 'menu']);

		$user_id = $this->session->userdata('user_id');
		$user_group_id= $this->session->userdata('user_group_id');
		$breadcrumbs = array(
			'#'=>'Pelelangan',
			'' => 'Pelelangan'
		);
		
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.lelanguser.index.js?v=' . time() =>'application'
		);

		if ($user_group_id == '18'|| $user_group_id == '20' || $user_group_id == '22'||$user_group_id == '23'||$user_group_id == '24'||$user_group_id == '26'||$user_group_id == '28'||$user_group_id == '30'||$user_group_id == '32'||$user_group_id == '34'||$user_group_id == '36'||$user_group_id == '42'||$user_group_id == '44') {
			# code...
			$menudoc = $this->load->view('layouts/menu_lelang', null, true);
		}else if ($user_group_id == '19'||$user_group_id == '21'||$user_group_id == '25'||$user_group_id == '27'||$user_group_id == '29'||$user_group_id == '31'||$user_group_id == '33'||$user_group_id == '35'||$user_group_id == '37'||$user_group_id == '43'||$user_group_id == '45') {
			# code...
			$menudoc = $this->load->view('layouts/admin_lelang', null, true);
		}else if ($user_group_id == '77') {
			# code...
			$menudoc = $this->load->view('layouts/admin_lelang_all', null, true);
		}else{
			$menudoc = $this->load->view('layouts/admin_menu', null, true);

		}

		$username= $this->session->userdata('username');
		if($username == 'adm_setakarat'){
			$ruas_list = $this->menu->get_menu_lelangjt(53, 73, true);
		} elseif($username == 'adm_gaetacim'){
			$ruas_list = $this->menu->get_menu_lelangjt(53, 85, true);
		} elseif($username == 'adm_gilmeng'){
			$ruas_list = $this->menu->get_menu_lelangjt(53, 63, true);
		} else {
			$ruas_list = $this->menu->get_menu_lelangjt();
		}
		

		$data = array(
			'menu' => $menudoc,
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pelelangan'), true),
			'content' => $this->load->view('admin/lelangusers/index', array('flash'=>$this->session->flashdata('employees_success'), 'ruas_list' => $ruas_list), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('lelang', 'comment', 'user_group'));
		

		$user_id = $this->session->userdata('user_id');
		$user_group_id= $this->session->userdata('user_group_id');
		$breadcrumbs = array(
			'#'=>'Pelelangan',
			'admin/lelangs' => 'Pelelangan',
			'' => 'Lihat Peserta'
		);

		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}

		$lelang = $this->lelang->get_lelang($id);
		if (count($lelang) > 0) {
			if ($user_group_id == '18'|| $user_group_id == '20' || $user_group_id == '22'||$user_group_id == '23'||$user_group_id == '24'||$user_group_id == '26'||$user_group_id == '28'||$user_group_id == '30'||$user_group_id == '32'||$user_group_id == '34'||$user_group_id == '36'||$user_group_id == '42'||$user_group_id == '44') {
				# code...
				$menudoc = $this->load->view('layouts/menu_lelang', null, true);
			}else if ($user_group_id == '19'||$user_group_id == '21'||$user_group_id == '25'||$user_group_id == '27'||$user_group_id == '29'||$user_group_id == '31'||$user_group_id == '33'||$user_group_id == '35'||$user_group_id == '37'||$user_group_id == '43'||$user_group_id == '45') {
				# code...
				$menudoc = $this->load->view('layouts/admin_lelang', null, true);
			}else if ($user_group_id == '77') {
				# code...
				$menudoc = $this->load->view('layouts/admin_lelang_all', null, true);
			}else{
				$menudoc = $this->load->view('layouts/admin_menu', null, true);
	
			}
			$data = array(
				'menu' => $menudoc,
				// 'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Lihat Peserta'), true),
				'content' => $this->load->view('admin/lelangusers/show', array('lelang'=>$lelang[0], 'flash'=>$this->session->flashdata('lelang_success'), 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'admin/lelangusers' => 'Pelelangan',
			'' => 'Pendaftaran'
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
			'wysiwyg.js'=>'vendor',
			'bootstrap-fileupload.min.js'=>'vendor'
		);
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelangusers.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		if ($user_group_id == '18') {
			# code...
			$menudoc = $this->load->view('layouts/menu_lelang', null, true);
		}else if ($user_group_id == '19'||$user_group_id == '21'||$user_group_id == '25'||$user_group_id == '27'||$user_group_id == '29'||$user_group_id == '31'||$user_group_id == '33'||$user_group_id == '35'||$user_group_id == '37'||$user_group_id == '43'||$user_group_id == '45') {
			# code...
			$menudoc = $this->load->view('layouts/admin_lelang', null, true);
		}else{
			$menudoc = $this->load->view('layouts/admin_menu', null, true);

		}
		$data = array(
			'menu' => $menudoc,
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register', array('lelang'=>$lelang, 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('ceo_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|callback_check_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|callback_check_username');
			$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|callback_numeric_wcomma');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('check_password', 'Password atau confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			$this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');

			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				$data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				if(!empty($this->input->post('bdate',true)) && !empty($this->input->post('bmonth',true)) && !empty($this->input->post('byear',true))) {
					$data['birthdate'] = $this->input->post('byear',true).'-'.$this->input->post('bmonth',true).'-'.$this->input->post('bdate',true);
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate',true)) && !empty($this->input->post('dmonth',true)) && !empty($this->input->post('dyear',true))) {
					$data['date_of_death'] = $this->input->post('dyear',true).'-'.$this->input->post('dmonth',true).'-'.$this->input->post('ddate',true);
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image']['tmp_name']);
						if ($mime == 'application/pdf' ){
							$filename = $_FILES['image']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}
							
							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
							move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
							$photo = array(
								'photo'=>$new_imagepath
							);
							$this->lelang->update($id, $photo);
						}
					}
				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password',true);
                $fullname = $data['ceo_name']." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				$this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');

				$this->session->set_flashdata('employee_success', true);
				redirect('admin/lelangs/show/' . $id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('kepegawaian_sistem_informasi_kepegawaian', $this->session->userdata('user_group_id'));
		$this->user_access = $this->user_access[0];
		$current_user_id = $this->session->userdata('user_id');
		if ($id != $current_user_id && !$this->user_access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		}

		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');

		$employee = $this->lelang->get_employee($id);
		
		if (count($employee > 0)) {
			$breadcrumbs = array(
				'#'=>'Kepegawaian',
				'admin/employees' => 'Kepegawaian',
				'' => 'Edit Pegawai'
			);
			$jscripts = array(
				'jquery.fileupload.js'=>'vendor',
				'jquery.iframe-transport.js'=>'vendor',
				'jquery.ui.widget.js'=>'vendor',
				'admin.lelangusers.show.js'=>'application',
				'jquery.alerts.js'=>'vendor',
			);
			$stylesheets = array('admin.lelanguser.form.css', 'jquery.fileupload-ui.css');

			$db_user_groups = $this->user_group->get_published_user_groups();
			foreach($db_user_groups as $db_user_group) {
				$user_groups[$db_user_group->id] = $db_user_group->name;
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Ubah Pegawai'), true),
				'content' => $this->load->view('admin/employees/edit', array('employee'=>$employee[0], 'id'=>$id, 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
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
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

			$lelang_user = $this->lelang->get_user_by_id($id);
			
			if (count($lelang_user) > 0) {
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
				$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim|required');
				$this->form_validation->set_rules('nik', 'ID Number', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('telephone', 'Phone', 'trim|required');
				$this->form_validation->set_rules('mobile', 'Handphone', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|callback_check_email');
				$this->form_validation->set_rules('username', 'Username', 'trim|callback_check_username');
				$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_update_password');
				$this->form_validation->set_message('check_name', 'Nama lengkap required.');
				$this->form_validation->set_message('check_email', 'Email required.');
				$this->form_validation->set_message('check_username', 'Username required.');
				$this->form_validation->set_message('check_update_password', 'Konfirmasi Password not Match.');
				$this->form_validation->set_message('required', 'Name required.');

				if ($this->form_validation->run()) {
					foreach($this->input->post() as $key => $value) {
						$data[$key] = clean_str($value);
					}

					if ($this->input->post('password',true) == '') {
						unset($data['password']);
					} else {
						$data['password'] = md5($data['password']);
					}
					unset($data['password_confirmation']);
					unset($data['doc_jabatan']);
					unset($data['doc_ktp_direktur']);
					unset($data['doc_ktp_pendaftar']);
					unset($data['doc_surat_kuasa']);
				
					// if(!empty($this->input->post('bdate',true)) && !empty($this->input->post('bmonth',true)) && !empty($this->input->post('byear',true))) {
					// 	$data['birthdate'] = $this->input->post('byear',true).'-'.$this->input->post('bmonth',true).'-'.$this->input->post('bdate',true);
					// }
					// unset($data['bdate']);
					// unset($data['bmonth']);
					// unset($data['byear']);
					// if(!empty($this->input->post('ddate',true)) && !empty($this->input->post('dmonth',true)) && !empty($this->input->post('dyear',true))) {
					// 	$data['date_of_death'] = $this->input->post('dyear',true).'-'.$this->input->post('dmonth',true).'-'.$this->input->post('ddate',true);
					// }
					// unset($data['ddate']);
					// unset($data['dmonth']);
					// unset($data['dyear']);

					$doc_jabatan = $this->upload_file('doc_jabatan', $id);
					$doc_ktp_direktur = $this->upload_file('doc_ktp_direktur', $id);
					$doc_ktp_pendaftar = $this->upload_file('doc_ktp_pendaftar', $id);
					$doc_surat_kuasa = $this->upload_file('doc_surat_kuasa', $id);
					
					if($doc_jabatan){
						$data['doc_jabatan'] = $doc_jabatan;
					}
					if($doc_ktp_direktur){
						$data['doc_ktp_direktur'] = $doc_ktp_direktur;
					}
					if($doc_ktp_pendaftar){
						$data['doc_ktp_pendaftar'] = $doc_ktp_pendaftar;
					}
					if($doc_surat_kuasa){
						$data['doc_surat_kuasa'] = $doc_surat_kuasa;
					}
					
					$data['updated_at'] = date('Y-m-d H:i:s');
					
					$this->lelang->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'lelang_user', $id, 'Pengguna mengubah data pegawai');

					$this->session->set_flashdata('lelang_user_success', true);
					redirect('admin/lelangs/show/' . $id);
				} else {
					$this->session->set_flashdata('lelang_user_failed', true);
					$this->show($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_image($id) { 
		if ($this->input->post()) {
			/* need to be validated for size and image type */
			$mime = mime_content_type($_FILES['file']['tmp_name']);
			if ($mime == 'application/pdf' ){
				
				$this->load->model(array('lelang', 'user_log'));
				$this->load->library('image_lib');

				$config['image_library'] = 'imagemagick';
				$config['library_path'] = $this->config->item('imagemagick');
		
				$filename = $_FILES['file']['name'];
				$extensions = explode('.', $filename);
				$extension = $extensions[count($extensions)-1];
				$filetype = $_FILES['file']['type'];
				$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/employees/' . $id;
		
				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0755, true);
				}
		
				$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
				$new_imagepath = base_url() . 'uploads/employees/' . $id . '/' . $new_filename;
		
				move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . '/' . $new_filename);

				list($img_width, $img_height) = getimagesize($upload_dir . '/' . $new_filename);
				$x = $y = $size = 0;
				if($img_width>$img_height) {
					$size = $img_height;
					$x = intval(($img_width - $size)/2);
				} else {
					$size = $img_width;
					$y = intval(($img_height- $size)/2);
				}

				$sq_dir = $upload_dir . '/sq';
				if (!is_dir($sq_dir)) {
					mkdir($sq_dir, 0755, true);
				}
				$config['source_image'] = $upload_dir . '/' . $new_filename;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = $size;
				$config['height'] = $size;
				$config['new_image'] = $sq_dir . '/' . $new_filename;
				$config['x_axis'] = $x;
				$config['y_axis'] = $y;
				$this->image_lib->initialize($config);

				if (!$this->image_lib->crop()) {
					echo $this->image_lib->display_errors();
					exit;
				}
				$this->image_lib->clear();

				/* sq177 */
				$sq177_dir = $upload_dir . '/sq177';
				if (!is_dir($sq177_dir)) {
					mkdir($sq177_dir, 0755, true);
				}
				$config['source_image']	= $sq_dir . '/' . $new_filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 177;
				$config['height'] = 177;
				$config['new_image'] = $sq177_dir . '/' . $new_filename;
				unset($config['x_axis']);
				unset($config['y_axis']);
				$this->image_lib->initialize($config);

				if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
					exit;
				}
				$this->image_lib->clear();

				/* sq100 */
				$sq100_dir = $upload_dir . '/sq100';
				if (!is_dir($sq100_dir)) {
					mkdir($sq100_dir, 0755, true);
				}
				$config['source_image']	= $sq_dir . '/' . $new_filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 100;
				$config['height'] = 100;
				$config['new_image'] = $sq100_dir . '/' . $new_filename;
				unset($config['x_axis']);
				unset($config['y_axis']);
				$this->image_lib->initialize($config);

				if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
					exit;
				}
				$this->image_lib->clear();

				$parsed = explode('/', $new_imagepath);
				$filename = $parsed[count($parsed)-1];
				unset($parsed[count($parsed)-1]);
				$new_url = implode('/', $parsed);
				$new_url = $new_url . '/sq177/' . $filename;

				$photo = array(
					'photo' => $new_imagepath
				);
				$this->session->set_userdata(array('photo'=>$new_imagepath));
				$this->lelang->update($id, $photo);

				$this->user_log->add_log($this->session->userdata('user_id'), 'employees', $id, 'Pengguna mengubah foto pegawai');
		
				$retjson = array(
					'status' => 'success',
					'new_imgpath' => $new_url
				);
			}else{
				$retjson = array(
					'status' => 'fail'
				);
			}
	
			echo json_encode($retjson);
		}
	}

	public function update_status($id) {
		$this->load->model(array('lelang', 'user_log'));
		$employee = $this->lelang->get_lelang($id);
		$employee = $employee[0];
		if ($employee->status != "deleted") {
			if ($employee->status == "published") {
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
			// print_r($employee);

			$this->lelang->update($id, $data);
			$this->user_log->add_log($this->session->userdata('user_id'), 'lelang_users', $id, 'Pengguna mengubah status data user ');
			redirect('auctions_list');
			// $send = "gagal";//$this->send_mail($employee);
			// print_r($send);
			// if ($send=='sukses') {
			// 	# code...
			// 	$this->user_log->add_log($this->session->userdata('user_id'), 'lelang_users', $id, 'Pengguna mengubah status data user ');

			// 	$this->session->set_flashdata('employees_success', true);
			// 	redirect('auctions_list');
			// }else{
			// 	$this->user_log->add_log($this->session->userdata('user_id'), 'lelang_users', $id, 'Pengguna mengubah status data user namun email gagal terkirim');
			// 	// $this->session->set_flashdata('employees_success', true);
			// 	$this->session->set_flashdata('notif','Email gagal terkirim.');
			// 	redirect('auctions_list');
			// }
		} else {
			redirect('/admin');
		}
	}
	
	public function destroy() {
		if ($this->input->post('ids',true)) {
			$this->load->model(array('lelang', 'user_log'));
			$ids = $this->input->post('ids',true);
			foreach($ids as $value) {
				$this->lelang->destroy($value);
				$this->user_log->add_log($this->session->userdata('user_id'), 'employees', $value, 'Pengguna menghapus data pegawai');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_lelanguser() {
		$this->load->model('lelang');
		$id_ruas = (int)$this->input->get('id_ruas');

		if(!$id_ruas){
			$username= $this->session->userdata('username');
			if($username == 'adm_setakarat'){
				$id_ruas = 73;
			} elseif($username == 'adm_gaetacim'){
				$id_ruas = 85;
			} elseif($username == 'adm_gilmeng'){
				$id_ruas = 63;
			}
		}

		$lelang = $this->lelang->fetch_lelang("", "", null, $id_ruas);

		$ret_employee = array();
		$no = 1;
		foreach($lelang as $key =>  $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);

    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/lelangs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/lelangs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}
	    	
			$name = null;
			if(!empty($value->front_title)) $name .= trim($value->front_title, '.').'. ';
			$name .= $value->ceo_name;
			// if(!empty($value->middle_name)) $name .= ' '.$value->middle_name;
			// if(!empty($value->last_name)) $name .= ' '.$value->last_name;
			// if(!empty($value->back_title)) $name .= ' '.trim($value->back_title).'.';
    		
			$temp_employee = array($checkbox, $no,$value->ruas, $value->company_name, $name,$value->contact_name,  $status, date('d M Y H:i:s', $created_at));//, date('d M Y H:i:s', $updated_at));
			array_push($ret_employee, $temp_employee);
			$no++;
		}
		$json = array('aaData'=>$ret_employee);

		echo json_encode($json);
	}

	public function destroy_image() {
		if ($this->input->post('id',true)) {
			$this->load->model(array('lelang', 'user_log'));
			$id = $this->input->post('id',true);
			$this->lelang->destroy_image($id);
			$this->user_log->add_log($this->session->userdata('user_id'), 'employees', $id, 'Pengguna menghapus photo pegawai');			
			echo json_encode(array(
				'status'=>'success',
				'new_imgpath'=>base_url().'assets/images/profilethumb.png'
			));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}
	
	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	private function get_provinces() {
		$this->load->model('province');

		$result = array('0' => '- Pilih Propinsi -');
		$provinces = $this->province->fetch_provinces("", "", null);
		foreach($provinces as $key => $value) {
			$result[$value->id] = $value->name;
		}
				
		return $result;
	}

	private function get_districts() {
		$this->load->model('district');

		$result = array('0' => '- Pilih Kabupaten -');
		$districts = $this->district->fetch_districts("", "", null);
		foreach($districts as $key => $value) {
			$result[$value->id] = $value->name;
		}
		return $result;
	}

	private function get_subdistricts() {
		$this->load->model('subdistrict');

		$result = array('0' => '- Pilih Kecamatan -');
		$subdistricts = $this->subdistrict->fetch_subdistricts("", "", null);
		foreach($subdistricts as $key => $value) {
			$result[$value->id] = $value->name;
		}
		return $result;
	}

	public function check_name() {
		if (!empty($this->input->post('ceo_name',true))) {
			return true;
		}else return false;
	}
	
		public function check_email() {
		if ($this->input->post('email',true) == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_username() {
		if ($this->input->post('username',true) == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_password() {
		if ($this->input->post('password',true) == "" || $this->input->post('password_confirmation',true) == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_password_confirmation() {
		if ($this->input->post('password',true) == $this->input->post('password_confirmation',true)) {
			return true;
		} else {
			return false;
		}
	}

	public function check_update_password() {
		if ($this->input->post('password',true) != "" && $this->input->post('password_confirmation',true) != $this->input->post('password',true)) {
			return false;
		} else {
			return true;
		}
	}

	public function upload_file($field, $id) {
		/* image uploaded */
		if($_FILES[$field]){
			if ($_FILES[$field]['error'] != UPLOAD_ERR_NO_FILE) {
				$mime = mime_content_type($_FILES[$field]['tmp_name']);
				if ($mime == 'application/pdf'){
					
					$filename = $_FILES[$field]['name'];
					$extensions = explode('.', $filename);
					$extension = $extensions[count($extensions)-1];
					$filetype = $_FILES[$field]['type'];
					$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id . '/';

					if (!is_dir($upload_dir)) {
						mkdir($upload_dir, 0755, true);
					}

					$new_filename = sha1($field . $id . $filename . time()) . '.' . $extension;
					
					$destination =  $upload_dir . $new_filename;
					$source = $_FILES[$field]['tmp_name'];
					
					move_uploaded_file($source, $destination);
					
					return $new_filename;
				}
			}
		}

		return null;
	}

	function numeric_wcomma ($str){
		return preg_match('/^[0-9,]+$/', $str);
	}

	public function send_mail($employee) { 
		// print_r($employee);
		if ($employee->status == "draft") {
			$status_message = "<h1>User account has been <strong>activated</strong></h1><p>you will now be able to 
			<a href=".base_url('auction')." target=\"_blank\" class=\"email-masthead_name\">
				Sign In
			</a>
			to Procurement Following is the details.
			</p>";
		} else {
			$status_message = "<h1>User account has been <strong>deactivated</strong></h1><p>you will not be able to 
			<a href=\"#\" class=\"email-masthead_name\">
				Sign In
			</a>
			to Procurement Following is the details.
			</p>";
		}
		$bodymail ="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns=\"http://www.w3.org/1999/xhtml\">
		
		<head>
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			<title>CodeRanks</title>
			<style type=\"text/css\" rel=\"stylesheet\" media=\"all\">
				*:not(br):not(tr):not(html) {
					font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
					box-sizing: border-box;
				}
		
				body {
					width: 100% !important;
					height: 100%;
					margin: 0;
					line-height: 1.4;
					background-color: #F2F4F6;
					color: #74787E;
					-webkit-text-size-adjust: none;
				}
		
				p,
				ul,
				ol,
				blockquote {
					line-height: 1.4;
					text-align: left;
				}
		
				a {
					color: #3869D4;
				}
		
		
				/* Layout ------------------------------ */
		
				.email-wrapper {
					width: 100%;
					margin: 0;
					padding: 0;
					-premailer-width: 100%;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
					background-color: #F2F4F6;
				}
		
				.email-content {
					width: 100%;
					margin: 0;
					padding: 0;
					-premailer-width: 100%;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
				}
		
				/* Masthead ----------------------- */
		
				.email-masthead {
					padding: 25px 0;
					text-align: center;
				}
		
				.email-masthead_logo {
					width: 94px;
				}
		
				.email-masthead_name {
					font-size: 16px;
					font-weight: bold;
					color: #bbbfc3;
					text-decoration: none;
					text-shadow: 0 1px 0 white;
				}
		
				/* Body ------------------------------ */
		
				.email-body {
					width: 100%;
					margin: 0;
					padding: 0;
					-premailer-width: 100%;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
					border-top: 1px solid #EDEFF2;
					border-bottom: 1px solid #EDEFF2;
					background-color: #FFFFFF;
				}
		
				.email-body_inner {
					width: 570px;
					margin: 0 auto;
					padding: 0;
					-premailer-width: 570px;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
					background-color: #FFFFFF;
				}
		
				.email-footer {
					width: 570px;
					margin: 0 auto;
					padding: 0;
					-premailer-width: 570px;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
					text-align: center;
				}
		
				.email-footer p {
					color: #AEAEAE;
				}
		
				.body-action {
					width: 100%;
					margin: 30px auto;
					padding: 0;
					-premailer-width: 100%;
					-premailer-cellpadding: 0;
					-premailer-cellspacing: 0;
				}
		
				.details td{
					padding:5px;
					border: 1px solid #f2f4f6;
				}
		
				.body-sub {
					margin-top: 25px;
					padding-top: 25px;
					border-top: 1px solid #EDEFF2;
				}
		
				.content-cell {
					padding: 35px;
				}
		
				.preheader {
					display: none !important;
					visibility: hidden;
					mso-hide: all;
					font-size: 1px;
					line-height: 1px;
					max-height: 0;
					max-width: 0;
					opacity: 0;
					overflow: hidden;
				}
		
		
		
		
				.align-right {
					text-align: right;
				}
		
				.align-left {
					text-align: left;
				}
		
				.align-center {
					text-align: center;
				}
		
				/*Media Queries ------------------------------ */
		
				@media only screen and (max-width: 600px) {
		
					.email-body_inner,
					.email-footer {
						width: 100% !important;
					}
				}
		
				@media only screen and (max-width: 500px) {
					.button {
						width: 100% !important;
					}
				}
		
				/* Buttons ------------------------------ */
		
				.button {
					background-color: #3869D4;
					border-top: 10px solid #3869D4;
					border-right: 18px solid #3869D4;
					border-bottom: 10px solid #3869D4;
					border-left: 18px solid #3869D4;
					display: inline-block;
					color: #FFF;
					text-decoration: none;
					border-radius: 3px;
					box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
					-webkit-text-size-adjust: none;
				}
		
				.button--green {
					background-color: #22BC66;
					border-top: 10px solid #22BC66;
					border-right: 18px solid #22BC66;
					border-bottom: 10px solid #22BC66;
					border-left: 18px solid #22BC66;
				}
		
		
				h1 {
					margin-top: 0;
					color: #2F3133;
					font-size: 19px;
					font-weight: bold;
					text-align: left;
				}
		
				h2 {
					margin-top: 0;
					color: #2F3133;
					font-size: 16px;
					font-weight: bold;
					text-align: left;
				}
		
				h3 {
					margin-top: 0;
					color: #2F3133;
					font-size: 14px;
					font-weight: bold;
					text-align: left;
				}
		
				p {
					margin-top: 0;
					color: #74787E;
					font-size: 16px;
					line-height: 1.5em;
					text-align: left;
				}
		
				p.sub {
					font-size: 12px;
				}
		
				p.center {
					text-align: center;
				}
			</style>
		</head>
		
		<body>
			<span class=\"preheader\">Use this link to reset your password. The link is only valid for 24 hours.</span>
			<table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td align=\"center\">
						<table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
							<tr>
								<td class=\"email-masthead\">
										Procurement Multi Lane Free Flow
								</td>
							</tr>
							<!-- Email Body -->
							<tr>
								<td class=\"email-body\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
									<table class=\"email-body_inner\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\">
										<!-- Body content -->
										<tr>
											<td class=\"content-cell\">											
												".$status_message."
												<!-- Action -->
												<table class=\"body-action\" align=\"left\" width=\"100%\" cellpadding=\"0\"
													cellspacing=\"0\">
													<tr>
														<td bgcolor=\"blue\"><img src=".base_url('assets/images/logo-bpjt-medium.png')." alt=\"\" /></td>
													</tr>
													<tr>
														<td align=\"center\">
															<table class=\"details\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
																<tr>
																	<td>
																		<b>Company Name</b>
																	</td>
																	<td>
																		".$employee->company_name."
																	</td>
																</tr>
																<tr>
																	<td>
																		<b>Email</b>
																	</td>
																	<td>
																	".$employee->email."
																	</td>
																</tr>
																<tr>
																	<td>
																		<b>Username</b>
																	</td>
																	<td>
																	".$employee->username."
																	</td>
																</tr>
																
															</table>
														</td>
													</tr>
													
												</table>
											</td>
										</tr>
		
									</table>
								</td>
							</tr>
							<tr>
								
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		
		</html>";

		// echo $bodymail;

	// 	$from_email = "procurement.mlff@pu.go.id"; 
	// 	// $to_email = "just.hardinal@gmail.com";//$this->input->post('email',true); 
	// 	$to_email = $employee->email; 

	// 	$config = Array(
	// 		   'protocol' => 'smtp',
	// 		   'smtp_host' => 'ssl://mail.pu.go.id',
	// 		   'smtp_port' => 465,
	// 		   'smtp_user' => $from_email,
	// 		   'smtp_pass' => 'Pattimura2020',
	// 		   'mailtype'  => 'html', 
	// 		   'charset'   => 'iso-8859-1'
	//    );
	$from_email = "bpjt.it@gmail.com"; 
		$to_email = "just.hardinal@gmail.com";//$this->input->post('email',true); 
	$config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => 'bpjt.it@gmail.com',
		'smtp_pass' => '@0pdev8pjt2020',
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1'
);

		   $this->load->library('email', $config);
		   $this->email->set_newline("\r\n");   

		$this->email->from($from_email, 'BPJT'); 
		$this->email->to($to_email);
		$this->email->subject('Account Activation'); 
		$this->email->message($bodymail); 

		//Send mail 
		if($this->email->send()){
			//    $this->session->set_flashdata("notif","Email berhasil terkirim."); 
			   echo "sukses";
			// return true;
		}else {
			//    $this->session->set_flashdata("notif","Email gagal dikirim."); 
			   echo "gagal";
			//    echo $this->email->print_debugger();
			//    redirect('admin/lelangs');
			// return false;
		} 
	 }
	 

}
