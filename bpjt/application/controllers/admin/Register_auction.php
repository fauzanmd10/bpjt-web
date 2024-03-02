<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_auction extends CI_Controller {
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

		// if (!$this->session->userdata('logged_in')) {
		// 	redirect('/admin');
		// }

		// $method = $this->router->fetch_method();
		
		// if ($method != 'edit') {
		// 	$this->load->model('access');
		// 	$this->user_access = $this->access->get_user_access_by_key('lelangusers', $this->session->userdata('user_group_id'));
		// 	$this->user_access = $this->user_access[0];
		// 	if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
		// 		$this->session->set_flashdata('access_denied', true);
		// 		redirect('/admin/dashboard');
		// 	} elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
		// 		$this->session->set_flashdata('access_denied', true);
		// 		redirect('/admin/dashboard');
		// 	} elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
		// 		$this->session->set_flashdata('access_denied', true);
		// 		redirect('/admin/dashboard');
		// 	} elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
		// 		echo json_encode(array('status'=>'fail', 'code'=>1));
		// 		exit;
		// 	}
		// }
	}

	// public function index() {
	// 	$this->load->model('comment');

	// 	$breadcrumbs = array(
	// 		'#'=>'Pelelangan',
	// 		'' => 'Pelelangan'
	// 	);
		
	// 	$jscripts = array(
	// 		'elements.js'=>'application',
	// 		'prettify/prettify.js'=>'vendor',
	// 		'jquery.jgrowl.js'=>'vendor',
	// 		'jquery.alerts.js'=>'vendor',
	// 		'jquery.dataTables.min.js'=>'vendor',
	// 		'admin.lelanguser.index.js'=>'application'
	// 	);

	// 	$data = array(
	// 		'menu' => $this->load->view('layouts/admin_menu', null, true),
	// 		'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pelelangan'), true),
	// 		'content' => $this->load->view('admin/lelangusers/index', array('flash'=>$this->session->flashdata('employees_success')), true),
	// 		'jscripts' => $jscripts,
	// 		'unread_comments' => $this->comment->get_total_unread_comments()
	// 	);
		
	// 	$this->load->view('layouts/admin_content.php', $data);
	// }

	// public function show($id) {
	// 	$this->load->model(array('lelang', 'comment', 'user_group'));
		
	// 	$breadcrumbs = array(
	// 		'#'=>'Pelelangan',
	// 		'admin/lelangs' => 'Pelelangan',
	// 		'' => 'Lihat Peserta'
	// 	);

	// 	$db_user_groups = $this->user_group->get_published_user_groups();
	// 	foreach($db_user_groups as $db_user_group) {
	// 		$user_groups[$db_user_group->id] = $db_user_group->name;
	// 	}

	// 	$lelang = $this->lelang->get_lelang($id);
	// 	if (count($lelang) > 0) {
	// 		$data = array(
	// 			'menu' => $this->load->view('layouts/admin_menu', null, true),
	// 			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Lihat Peserta'), true),
	// 			'content' => $this->load->view('admin/lelangusers/show', array('lelang'=>$lelang[0], 'flash'=>$this->session->flashdata('lelang_success'), 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
	// 			'unread_comments' => $this->comment->get_total_unread_comments()
	// 		);
	// 		$this->load->view('layouts/admin_content.php', $data);
	// 	} else {
	// 		redirect('admin');
	// 	}
	// }

//=============== mulai sini =======

	// public function add($filled_value=null) {
	// 	$this->load->model(array('lelang', 'comment', 'user_group'));
	// 	$this->load->helper('form');

	// 	$breadcrumbs = array(
	// 		'admin/lelangusers' => 'Pelelangan',
	// 		'' => 'Pendaftaran'
	// 	);
		
	// 	$jscripts = array(
	// 		'jquery.validate.min.js'=>'vendor',
	// 		'jquery.tagsinput.min.js'=>'vendor',
	// 		'jquery.autogrow-textarea.js'=>'vendor',
	// 		'charCount.js'=>'vendor',
	// 		'ui.spinner.min.js'=>'vendor',
	// 		'chosen.jquery.min.js'=>'vendor',
	// 		'forms.js'=>'vendor',
	// 		'tinymce/jquery.tinymce.js'=>'vendor',
	// 		'wysiwyg.js'=>'vendor',
	// 		'bootstrap-fileupload.min.js'=>'vendor'
	// 	);
		
	// 	$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
	// 	$lelang = array();
	// 	if (isset($filled_value)) {
	// 		$lelang = $filled_value;
	// 	}
		
	// 	$db_user_groups = $this->user_group->get_published_user_groups();
	// 	foreach($db_user_groups as $db_user_group) {
	// 		$user_groups[$db_user_group->id] = $db_user_group->name;
	// 	}
		
	// 	$data = array(
	// 		// 'menu' => $this->load->view('layouts/admin_menu', null, true),
	// 		// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
	// 		'content' => $this->load->view('admin/lelangusers/register', array('lelang'=>$lelang, 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
	// 		'jscripts' => $jscripts,
	// 		'stylesheets' => $stylesheets,
	// 		// 'unread_comments' => $this->comment->get_total_unread_comments()
	// 	);
	// 	$this->load->view('layouts/lelang_content.php', $data);
	// }

	// public function create() {
	// 	if ($this->input->post()) {
	// 		$this->load->model(array('lelang', 'user_log'));
	// 		$this->load->library('form_validation');

			
	// 		$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
	// 		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
	// 		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
	// 		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
	// 		$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
	// 		$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
	// 		$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
	// 		$this->form_validation->set_message('check_email', 'Email required.');
	// 		$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
	// 		$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
	// 		$this->form_validation->set_message('check_username', 'Username required.');
	// 		$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
	// 		$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
	// 		// $this->form_validation->set_message('required', 'Name required.');
	// 		$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
	// 		if ($this->form_validation->run()) {
	// 			foreach($this->input->post() as $key => $value) {
	// 				$data[$key] = $value;
	// 			}
	// 			unset($data['reg']);

	// 			$data['password'] = md5($data['password']);
	// 			unset($data['password_confirmation']);
	// 			if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
	// 				$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
	// 			}
	// 			unset($data['bdate']);
	// 			unset($data['bmonth']);
	// 			unset($data['byear']);
	// 			if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
	// 				$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
	// 			}
	// 			unset($data['ddate']);
	// 			unset($data['dmonth']);
	// 			unset($data['dyear']);
	// 			$data['created_at'] = date('Y-m-d H:i:s');
	// 			$data['updated_at'] = date('Y-m-d H:i:s');
	// 			unset($data['image']);
	// 			$data['status'] = 'draft';
	// 			$data['user_group_id'] = '18';
	// 			if ($this->lelang->insert($data)) {
	// 				$id = $this->db->insert_id();
					
	// 				if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
	// 					$mime = mime_content_type($_FILES['image']['tmp_name']);
	// 					if ($mime == 'application/pdf' ){
	// 						$filename = $_FILES['image']['name'];
	// 						$extensions = explode('.', $filename);
	// 						$extension = $extensions[count($extensions)-1];
	// 						$filetype = $_FILES['image']['type'];
	// 						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
	// 						if (!is_dir($upload_dir)) {
	// 							mkdir($upload_dir, 0755, true);
	// 						}
							
	// 						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
	// 						$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
	// 						move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
	// 						$photo = array(
	// 							'photo'=>$new_imagepath
	// 						);
	// 						$this->lelang->update($id, $photo);
	// 					}
	// 				}else{
	// 					$photo = array(
	// 						'photo'=>''
	// 					);
	// 					$this->lelang->update($id, $photo);
	// 				}
	// 			}

	// 			// integration user kc
    //             $this->load->library('curl');
    //             $username = $data['username'];
    //             $password = $this->input->post('password');
    //             $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
    //             $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
    //             $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

    //             $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

	// 			// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
	// 			$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
	// 			if ($id) {
	// 				$this->session->set_flashdata('sukses', 'Registration Success');		
	// 				redirect('register');
	// 				# code...
	// 			}else{
	// 				$this->session->set_flashdata('failed', 'Registration Failed');		
	// 				// redirect('register');
	// 				$this->add($this->input->post());
	// 			}
	// 			// $this->session->set_flashdata('employee_success', true);
	// 			// redirect('admin');
	// 			// echo "cob";
	// 		} else {
	// 			$this->session->set_flashdata('failed', 'Registration Failed');	
	// 			$this->add($this->input->post());
	// 		}
	// 	}
	// }

	// public function api_get_all_lelanguser() {
	// 	$this->load->model('lelang');
	// 	$lelang = $this->lelang->fetch_lelang("", "", null);

	// 	$ret_employee = array();
	// 	$no = 1;
	// 	foreach($lelang as $key =>  $value) {
	// 		$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
	// 		$created_at = strtotime($value->created_at);
    // 		$updated_at = strtotime($value->updated_at);

    // 		if ($this->user_access->edit) {
	//     		if ($value->status == "published") {
	//     			$status = "<a href=\"" . site_url('admin/lelangs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	//     		} else {
	//     			$status = "<a href=\"" . site_url('admin/lelangs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	//     		}
	//     	} else {
	//     		$status = "";
	//     	}
	    	
	// 		$name = null;
	// 		if(!empty($value->company_name)) $name .= trim($value->company_name, '.').'. ';
	// 		$name .= $value->ceo_name;
	// 		// if(!empty($value->middle_name)) $name .= ' '.$value->middle_name;
	// 		// if(!empty($value->last_name)) $name .= ' '.$value->last_name;
	// 		// if(!empty($value->back_title)) $name .= ' '.trim($value->back_title).'.';
    		
	// 		$temp_employee = array($checkbox, $no, $name,  $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
	// 		array_push($ret_employee, $temp_employee);
	// 		$no++;
	// 	}
	// 	$json = array('aaData'=>$ret_employee);

	// 	echo json_encode($json);
	// }

	// public function destroy_image() {
	// 	if (isset($this->input->post('id'))) {
	// 		$this->load->model(array('lelang', 'user_log'));
	// 		$id = $this->input->post('id');
	// 		$this->lelang->destroy_image($id);
	// 		$this->user_log->add_log($this->session->userdata('user_id'), 'employees', $id, 'Pengguna menghapus photo pegawai');			
	// 		echo json_encode(array(
	// 			'status'=>'success',
	// 			'new_imgpath'=>base_url().'assets/images/profilethumb.png'
	// 		));
	// 	} else {
	// 		echo json_encode(array('status'=>'fail', 'code'=>0));
	// 	}
	// }
	
	// private function create_slug($string) {
	// 	$string = strtolower($string);
	// 	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	// 	$string = preg_replace("/[\s-]+/", " ", $string);
	// 	$string = preg_replace("/[\s_]/", "-", $string);

	// 	return $string;
	// }

	// private function get_provinces() {
	// 	$this->load->model('province');

	// 	$result = array('0' => '- Pilih Propinsi -');
	// 	$provinces = $this->province->fetch_provinces("", "", null);
	// 	foreach($provinces as $key => $value) {
	// 		$result[$value->id] = $value->name;
	// 	}
				
	// 	return $result;
	// }

	// private function get_districts() {
	// 	$this->load->model('district');

	// 	$result = array('0' => '- Pilih Kabupaten -');
	// 	$districts = $this->district->fetch_districts("", "", null);
	// 	foreach($districts as $key => $value) {
	// 		$result[$value->id] = $value->name;
	// 	}
	// 	return $result;
	// }

	// private function get_subdistricts() {
	// 	$this->load->model('subdistrict');

	// 	$result = array('0' => '- Pilih Kecamatan -');
	// 	$subdistricts = $this->subdistrict->fetch_subdistricts("", "", null);
	// 	foreach($subdistricts as $key => $value) {
	// 		$result[$value->id] = $value->name;
	// 	}
	// 	return $result;
	// }

	public function check_name() {
		if (!empty($this->input->post('ceo_name'))) {
			return true;
		}else return false;
	}
	
		public function check_email() {
		if ($this->input->post('email') == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_username() {
		if ($this->input->post('username') == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_password() {
		if ($this->input->post('password') == "" || $this->input->post('password_confirmation') == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_password_confirmation() {
		if ($this->input->post('password') == $this->input->post('password_confirmation')) {
			return true;
		} else {
			return false;
		}
	}

	public function check_update_password() {
		if ($this->input->post('password') != "" && $this->input->post('password_confirmation') != $this->input->post('password')) {
			return false;
		} else {
			return true;
		}
	}
	// function numeric_wcomma ($str){
	// 	return preg_match('/^[0-9,]+$/', $str);
	// }


	public function checkusernameavailable()
	{
		$this->load->model(array('lelang'));
		$this->load->helper('form');
		$check = $this->lelang->checkuser($this->input->post('username'),$this->input->post('reg'));
		if (($check)) {
			return false;
		} else {
			return true;
		}
	}
	public function checkcompanyavailable()
	{
		$this->load->model(array('lelang'));
		$this->load->helper('form');
		$check = $this->lelang->checkcompany($this->input->post('company_name'),$this->input->post('reg'));
		if (($check)) {
			return false;
		} else {
			return true;
		}
	}

	// ################################################################################################
	public function add_invest($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_invest', array('lelang'=>$lelang, 'ruas'=>$this->get_ruas(55), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_invest() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				$data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				unset($data['password']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '20';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $this->input->post('email');
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$mime = mime_content_type($_FILES['image']['tmp_name']);
					// 	if ($mime == 'application/pdf' ){
					// 		$filename = $_FILES['image']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions)-1];
					// 		$filetype = $_FILES['image']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}
							
					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
					// 		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 		$photo = array(
					// 			'photo'=>$new_imagepath
					// 		);
					// 		$this->lelang->update($id, $photo);
					// 	}
					// }else{
					// 	$photo = array(
					// 		'photo'=>''
					// 	);
					// 	$this->lelang->update($id, $photo);
					// }
					$this->sendEmail($id,$emaile,'invest_registration');

				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page?loc=invest_registration&sukses=true');
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('register_invest');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_invest($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_invest($this->input->post());
			}
		}
	}

	private function get_ruaslelang() {
		$this->load->model('menu');

		$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_lelangjt();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
				
		return $result;
	}
	private function get_ruas($id=null) {
		$this->load->model('menu');

		$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_by_id($id);
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}

				
		return $result;
	}
	
	
	// ################################################################################################
	public function add_invest2($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		

		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		

		
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_invest2', array('lelang'=>$lelang, 'ruas'=>$this->get_ruaslelang(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_invest2() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				$data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				unset($data['password']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '24';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $data['email'];
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$mime = mime_content_type($_FILES['image']['tmp_name']);
					// 	if ($mime == 'application/pdf' ){
					// 		$filename = $_FILES['image']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions)-1];
					// 		$filetype = $_FILES['image']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/lelangs/' . $id;
							
					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}
							
					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
					// 		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 		$photo = array(
					// 			'photo'=>$new_imagepath
					// 		);
					// 		$this->lelang->update($id, $photo);
					// 	}
					// }else{
					// 	$photo = array(
					// 		'photo'=>''
					// 	);
					// 	$this->lelang->update($id, $photo);
				// die('ok');
					// }
					$this->sendEmail($id,$emaile,'invest_registration2');
				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page?loc=invest_registration2&sukses=true');
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('register_invest2 ');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_invest($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_invest($this->input->post());
			}
		}
	}


	
	// ################################################################################################
	// public function add_investjorr2($filled_value=null) {
	// 	$this->load->model(array('lelang', 'comment', 'user_group'));
	// 	$this->load->helper('form');

	// 	$breadcrumbs = array(
	// 		'admin/lelangusers' => 'Pelelangan',
	// 		'' => 'Pendaftaran'
	// 	);
		
	// 	$jscripts = array(
	// 		'jquery.validate.min.js'=>'vendor',
	// 		'jquery.tagsinput.min.js'=>'vendor',
	// 		'jquery.autogrow-textarea.js'=>'vendor',
	// 		'charCount.js'=>'vendor',
	// 		'ui.spinner.min.js'=>'vendor',
	// 		'chosen.jquery.min.js'=>'vendor',
	// 		'forms.js'=>'vendor',
	// 		'tinymce/jquery.tinymce.js'=>'vendor',
	// 		'wysiwyg.js'=>'vendor',
	// 		'bootstrap-fileupload.min.js'=>'vendor'
	// 	);
		
	// 	$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
	// 	$lelang = array();
	// 	if (isset($filled_value)) {
	// 		$lelang = $filled_value;
	// 	}
		
	// 	$db_user_groups = $this->user_group->get_published_user_groups();
	// 	foreach($db_user_groups as $db_user_group) {
	// 		$user_groups[$db_user_group->id] = $db_user_group->name;
	// 	}
		
	// 	$data = array(
	// 		// 'menu' => $this->load->view('layouts/admin_menu', null, true),
	// 		// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
	// 		'content' => $this->load->view('admin/lelangusers/register_investjorr2', array('lelang'=>$lelang, 'ruas'=>$this->get_jorr2el(), 'user_groups'=>$user_groups), true),
	// 		'jscripts' => $jscripts,
	// 		'stylesheets' => $stylesheets,
	// 		// 'unread_comments' => $this->comment->get_total_unread_comments()
	// 	);
	// 	$this->load->view('layouts/lelang_content.php', $data);
	// }

	// public function create_investjorr2() {
	// 	if ($this->input->post()) {
	// 		$this->load->model(array('lelang', 'user_log'));
	// 		$this->load->library('form_validation');

		
	// 		$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
	// 		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
	// 		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
	// 		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
	// 		$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
	// 		$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
	// 		$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
	// 		$this->form_validation->set_message('check_email', 'Email required.');
	// 		$this->form_validation->set_message('check_username', 'Username required.');
	// 		$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
	// 		$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
	// 		$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
	// 		$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
	// 		// $this->form_validation->set_message('required', 'Name required.');
	// 		$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
	// 		if ($this->form_validation->run()) {
	// 			foreach($this->input->post() as $key => $value) {
	// 				$data[$key] = $value;
	// 			}
	// 			unset($data['reg']);
	// 			$data['password'] = md5($data['password']);
	// 			unset($data['password_confirmation']);
	// 			if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
	// 				$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
	// 			}
	// 			unset($data['bdate']);
	// 			unset($data['bmonth']);
	// 			unset($data['byear']);
	// 			if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
	// 				$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
	// 			}
	// 			unset($data['ddate']);
	// 			unset($data['dmonth']);
	// 			unset($data['dyear']);
	// 			$data['created_at'] = date('Y-m-d H:i:s');
	// 			$data['updated_at'] = date('Y-m-d H:i:s');
	// 			unset($data['image']);
	// 			$data['status'] = 'draft';
	// 			$data['user_group_id'] = '26';
	// 			$data['lelang_jt'] = $this->input->post('lelang_jt');
	// 			if ($this->lelang->insert($data)) {
	// 				$id = $this->db->insert_id();
					
	// 				if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
	// 					$mime = mime_content_type($_FILES['image']['tmp_name']);
	// 					if ($mime == 'application/pdf' ){
	// 						$filename = $_FILES['image']['name'];
	// 						$extensions = explode('.', $filename);
	// 						$extension = $extensions[count($extensions)-1];
	// 						$filetype = $_FILES['image']['type'];
	// 						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
	// 						if (!is_dir($upload_dir)) {
	// 							mkdir($upload_dir, 0755, true);
	// 						}
							
	// 						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
	// 						$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
	// 						move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
	// 						$photo = array(
	// 							'photo'=>$new_imagepath
	// 						);
	// 						$this->lelang->update($id, $photo);
	// 					}
	// 				}else{
	// 					$photo = array(
	// 						'photo'=>''
	// 					);
	// 					$this->lelang->update($id, $photo);
	// 				}
	// 			}

	// 			// integration user kc
    //             $this->load->library('curl');
    //             $username = $data['username'];
    //             $password = $this->input->post('password');
    //             $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
    //             $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
    //             $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

    //             $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

	// 			// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
	// 			$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
	// 			if ($id) {
	// 				$this->session->set_flashdata('sukses', 'Registration Success');		
	// 				redirect('register_invest');
	// 				# code...
	// 			}else{
	// 				$this->session->set_flashdata('failed', 'Registration Failed');		
	// 				// redirect('register');
	// 				$this->add_invest($this->input->post());
	// 			}
	// 			// $this->session->set_flashdata('employee_success', true);
	// 			// redirect('admin');
	// 			// echo "cob";
	// 		} else {
	// 			$this->session->set_flashdata('failed', 'Registration Failed');	
	// 			$this->add_invest($this->input->post());
	// 		}
	// 	}
	// }
	
	// private function get_jorr2el() {
	// $this->load->model('menu');

	// //$result = array('0' => '- Pilih Ruas -');
	// $ruas = $this->menu->get_menu_jorr2el();
	// 	foreach($ruas as $key => $value) {
	// 		$result[$value->id] = $value->name;
	// 	}
			
	// return $result;
	// }
	
	
	
	// ################################################################################################
	// public function add_investpatimban($filled_value=null) {
	// 	$this->load->model(array('lelang', 'comment', 'user_group'));
	// 	$this->load->helper('form');

	// 	$breadcrumbs = array(
	// 		'admin/lelangusers' => 'Pelelangan',
	// 		'' => 'Pendaftaran'
	// 	);
		
	// 	$jscripts = array(
	// 		'jquery.validate.min.js'=>'vendor',
	// 		'jquery.tagsinput.min.js'=>'vendor',
	// 		'jquery.autogrow-textarea.js'=>'vendor',
	// 		'charCount.js'=>'vendor',
	// 		'ui.spinner.min.js'=>'vendor',
	// 		'chosen.jquery.min.js'=>'vendor',
	// 		'forms.js'=>'vendor',
	// 		'tinymce/jquery.tinymce.js'=>'vendor',
	// 		'wysiwyg.js'=>'vendor',
	// 		'bootstrap-fileupload.min.js'=>'vendor'
	// 	);
		
	// 	$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
	// 	$lelang = array();
	// 	if (isset($filled_value)) {
	// 		$lelang = $filled_value;
	// 	}
		
	// 	$db_user_groups = $this->user_group->get_published_user_groups();
	// 	foreach($db_user_groups as $db_user_group) {
	// 		$user_groups[$db_user_group->id] = $db_user_group->name;
	// 	}
		
	// 	$data = array(
	// 		// 'menu' => $this->load->view('layouts/admin_menu', null, true),
	// 		// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
	// 		'content' => $this->load->view('admin/lelangusers/register_investpatimban', array('lelang'=>$lelang, 'ruas'=>$this->get_patimban(), 'user_groups'=>$user_groups), true),
	// 		'jscripts' => $jscripts,
	// 		'stylesheets' => $stylesheets,
	// 		// 'unread_comments' => $this->comment->get_total_unread_comments()
	// 	);
	// 	$this->load->view('layouts/lelang_content.php', $data);
	// }

	// public function create_investpatimban() {
	// 	if ($this->input->post()) {
	// 		$this->load->model(array('lelang', 'user_log'));
	// 		$this->load->library('form_validation');

		
	// 		$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
	// 		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
	// 		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
	// 		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
	// 		$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
	// 		$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
	// 		$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
	// 		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
	// 		$this->form_validation->set_message('check_email', 'Email required.');
	// 		$this->form_validation->set_message('check_username', 'Username required.');
	// 		$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
	// 		$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
	// 		$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
	// 		$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
	// 		// $this->form_validation->set_message('required', 'Name required.');
	// 		$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
	// 		if ($this->form_validation->run()) {
	// 			foreach($this->input->post() as $key => $value) {
	// 				$data[$key] = $value;
	// 			}
	// 			unset($data['reg']);
	// 			$data['password'] = md5($data['password']);
	// 			unset($data['password_confirmation']);
	// 			if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
	// 				$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
	// 			}
	// 			unset($data['bdate']);
	// 			unset($data['bmonth']);
	// 			unset($data['byear']);
	// 			if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
	// 				$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
	// 			}
	// 			unset($data['ddate']);
	// 			unset($data['dmonth']);
	// 			unset($data['dyear']);
	// 			$data['created_at'] = date('Y-m-d H:i:s');
	// 			$data['updated_at'] = date('Y-m-d H:i:s');
	// 			unset($data['image']);
	// 			$data['status'] = 'draft';
	// 			$data['user_group_id'] = '28';
	// 			$data['lelang_jt'] = $this->input->post('lelang_jt');
	// 			if ($this->lelang->insert($data)) {
	// 				$id = $this->db->insert_id();
					
	// 				if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
	// 					$mime = mime_content_type($_FILES['image']['tmp_name']);
	// 					if ($mime == 'application/pdf' ){
	// 						$filename = $_FILES['image']['name'];
	// 						$extensions = explode('.', $filename);
	// 						$extension = $extensions[count($extensions)-1];
	// 						$filetype = $_FILES['image']['type'];
	// 						$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
	// 						if (!is_dir($upload_dir)) {
	// 							mkdir($upload_dir, 0755, true);
	// 						}
							
	// 						$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
	// 						$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
	// 						move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
	// 						$photo = array(
	// 							'photo'=>$new_imagepath
	// 						);
	// 						$this->lelang->update($id, $photo);
	// 					}
	// 				}else{
	// 					$photo = array(
	// 						'photo'=>''
	// 					);
	// 					$this->lelang->update($id, $photo);
	// 				}
	// 			}

	// 			// integration user kc
    //             $this->load->library('curl');
    //             $username = $data['username'];
    //             $password = $this->input->post('password');
    //             $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
    //             $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
    //             $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

    //             $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

	// 			// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
	// 			$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
	// 			if ($id) {
	// 				$this->session->set_flashdata('sukses', 'Registration Success');		
	// 				redirect('register_invest');
	// 				# code...
	// 			}else{
	// 				$this->session->set_flashdata('failed', 'Registration Failed');		
	// 				// redirect('register');
	// 				$this->add_invest($this->input->post());
	// 			}
	// 			// $this->session->set_flashdata('employee_success', true);
	// 			// redirect('admin');
	// 			// echo "cob";
	// 		} else {
	// 			$this->session->set_flashdata('failed', 'Registration Failed');	
	// 			$this->add_invest($this->input->post());
	// 		}
	// 	}
	// }
	
	// private function get_patimban() {
	// $this->load->model('menu');

	// //$result = array('0' => '- Pilih Ruas -');
	// $ruas = $this->menu->get_menu_patimban();
	// 	foreach($ruas as $key => $value) {
	// 		$result[$value->id] = $value->name;
	// 	}
			
	// return $result;
	// }


	// # Kamal - Teluk Naga - Rajeg Lelang 

	public function add_investkater($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_investkater', array('lelang'=>$lelang, 'ruas'=>$this->get_kater(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_investkater() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				// $data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				unset($data['password']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '30';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $data['email'];
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$mime = mime_content_type($_FILES['image']['tmp_name']);
					// 	if ($mime == 'application/pdf' ){
					// 		$filename = $_FILES['image']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions)-1];
					// 		$filetype = $_FILES['image']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lelangs/' . $id;
							
					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}
							
					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
					// 		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 		$photo = array(
					// 			'photo'=>$new_imagepath
					// 		);
					// 		$this->lelang->update($id, $photo);
					// 	}
					// }else{
					// 	$photo = array(
					// 		'photo'=>''
					// 	);
					// 	$this->lelang->update($id, $photo);
					// }
					$this->sendEmail($id,$emaile,'invest_reg_kater');

				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page?loc=invest_reg_kater&sukses=true');
					$this->session->set_flashdata('sukses', 'Registration Success');		
					// redirect('add_investkater');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_investkater($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_investkater($this->input->post());
			}
		}
	}
	
	private function get_kater() {
	$this->load->model('menu');

	//$result = array('0' => '- Pilih Ruas -');
	$ruas = $this->menu->get_menu_kater();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
			
	return $result;
	}


	// # // Sentul Selatan - Karawang Barat Registration

	public function add_investsetakarat($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_investsetakarat', array('lelang'=>$lelang, 'ruas'=>$this->get_setakarat(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_investsetakarat() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				// $data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				unset($data['password']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '32';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $data['email'];
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					$doc_jabatan = $this->upload_image('doc_jabatan', $id);
					$doc_ktp_direktur = $this->upload_image('doc_ktp_direktur', $id);
					$doc_ktp_pendaftar = $this->upload_image('doc_ktp_pendaftar', $id);
					$doc_surat_kuasa = $this->upload_image('doc_surat_kuasa', $id);
					
					$this->lelang->update($id, [
						'doc_jabatan' => $doc_jabatan,
						'doc_ktp_direktur' => $doc_ktp_direktur,
						'doc_ktp_pendaftar' => $doc_ktp_pendaftar,
						'doc_surat_kuasa' => $doc_surat_kuasa
					]);
					
					$this->sendEmail($id,$emaile,'invest_reg_sentul');
				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('success_page?loc=invest_reg_sentul&sukses=true');

					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('invest_reg_sentul');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_investsetakarat($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_investsetakarat($this->input->post());
			}
		}
	}

	// # // Gedebage - Tasikmalaya - Ciamis Registration

	public function add_investgaetacim($filled_value=null) {
		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');

		$ruas = $this->get_gaetacim();
		$data = $this->add_invest_get_data('reg_invest_gaetacim', $ruas);
		
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_investgaetacim() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->validation_create_invest();
			
			if ($this->form_validation->run()) {
				
				$id = $this->insert_create_invest(42);

				if ($id) {
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('success_page?loc=invest_reg_gaetacim&sukses=true');

					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('invest_reg_gaetacim');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_investgaetacim($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_investgaetacim($this->input->post());
			}
		}
	}

	// # // Gilimanuk - Mengwi

	public function add_invest_gilmeng($filled_value=null) {
		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');

		$ruas = $this->get_gilmeng();
		$data = $this->add_invest_get_data('reg_invest_gilmeng', $ruas);
		
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_invest_gilmeng() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->validation_create_invest();
			
			if ($this->form_validation->run()) {
				
				$id = $this->insert_create_invest(44);

				if ($id) {
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('success_page?loc=invest_reg_gilmeng&sukses=true');

					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('invest_reg_gilmeng');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_invest_gilmeng($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_invest_gilmeng($this->input->post());
			}
		}
	}
	
	private function add_invest_get_data($form_url, $ruas) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_invest_regular', array('form_url'=>$form_url,'lelang'=>$lelang, 'ruas'=>$ruas, 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);

		return $data;
	}

	private function validation_create_invest() {
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
		$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
		// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
		$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
		// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
		$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
		$this->form_validation->set_rules('nik', 'ID Number', 'trim|required|numeric');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		if (empty($_FILES['doc_jabatan']['name']))
		{
			$this->form_validation->set_rules('doc_jabatan', 'Dokumen Pendukung Jabatan', 'required');
		}
		if (empty($_FILES['doc_ktp_direktur']['name']))
		{
			$this->form_validation->set_rules('doc_ktp_direktur', 'Dokumen KTP Direktur', 'required');
		}
		if (empty($_FILES['doc_ktp_pendaftar']['name']) && $_POST['is_direktur'] == 'tidak')
		{
			$this->form_validation->set_rules('doc_ktp_pendaftar', 'Dokumen KTP Pendaftar', 'required');
		}
		if (empty($_FILES['doc_surat_kuasa']['name']) && $_POST['is_direktur'] == 'tidak')
		{
			$this->form_validation->set_rules('doc_surat_kuasa', 'Dokumen Surat Kuasa', 'required');
		}
		$this->form_validation->set_message('check_email', 'Email required.');
		$this->form_validation->set_message('check_username', 'Username required.');
		$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
		$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
		$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
		$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
		// $this->form_validation->set_message('required', 'Name required.');
		$this->form_validation->set_message('numeric_wcomma', 'Only number.');
	}

	private function insert_create_invest($user_group_id){
		$id = null;

		foreach($this->input->post() as $key => $value) {
			$data[$key] = clean_str($value);
		}
		unset($data['is_direktur']);
		unset($data['reg']);
		$data['password'] = md5($data['password']);
		unset($data['password_confirmation']);
		// unset($data['password']);
		if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
			$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
		}
		unset($data['bdate']);
		unset($data['bmonth']);
		unset($data['byear']);
		if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
			$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
		}
		unset($data['ddate']);
		unset($data['dmonth']);
		unset($data['dyear']);
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		unset($data['image']);
		$data['status'] = 'draft';
		$data['user_group_id'] = $user_group_id;
		$data['lelang_jt'] = $this->input->post('lelang_jt');
		$emaile = $data['email'];
		if ($this->lelang->insert($data)) {
			$id = $this->db->insert_id();
			
			$doc_jabatan = $this->upload_image('doc_jabatan', $id);
			$doc_ktp_direktur = $this->upload_image('doc_ktp_direktur', $id);
			$doc_ktp_pendaftar = $this->upload_image('doc_ktp_pendaftar', $id);
			$doc_surat_kuasa = $this->upload_image('doc_surat_kuasa', $id);
			
			$this->lelang->update($id, [
				'doc_jabatan' => $doc_jabatan,
				'doc_ktp_direktur' => $doc_ktp_direktur,
				'doc_ktp_pendaftar' => $doc_ktp_pendaftar,
				'doc_surat_kuasa' => $doc_surat_kuasa
			]);
			
			$this->sendEmail($id,$emaile,'invest_reg_gaetacim');
		}

		// integration user kc
		$this->load->library('curl');
		$username = $data['username'];
		$password = $this->input->post('password');
		$fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
		$fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
		$email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

		$this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

		// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
		$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');

		return $id;
	}
	
	private function get_setakarat() {
		$this->load->model('menu');

		//$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_setakarat();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
				
		return $result;
	}

	private function get_gaetacim() {
		$this->load->model('menu');

		//$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_gaetacim();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
				
		return $result;
	}

	private function get_gilmeng() {
		$this->load->model('menu');

		//$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_gilmeng();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
				
		return $result;
	}


	// # // Bogor - Sentul via Parung Registration

	public function add_investboser($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_investboser', array('lelang'=>$lelang, 'ruas'=>$this->get_boser(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_investboser() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				// $data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				unset($data['password']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '34';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $data['email'];
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$mime = mime_content_type($_FILES['image']['tmp_name']);
					// 	if ($mime == 'application/pdf' ){
					// 		$filename = $_FILES['image']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions)-1];
					// 		$filetype = $_FILES['image']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/lelangs/' . $id;
							
					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}

					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							
					// 		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 		$photo = array(
					// 			'photo'=>$new_imagepath
					// 		);
					// 		$this->lelang->update($id, $photo);
					// 	}
					// }else{
					// 	$photo = array(
					// 		'photo'=>''
					// 	);
					// 	$this->lelang->update($id, $photo);
					// }
					$this->sendEmail($id,$emaile,'invest_reg_sentul');
				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page?loc=invest_reg_sentul&sukses=true');

					$this->session->set_flashdata('sukses', 'Registration Success');		
					// redirect('invest_reg_boser');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_investboser($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_investboser($this->input->post());
			}
		}
	}
	
	private function get_boser() {
	$this->load->model('menu');

	//$result = array('0' => '- Pilih Ruas -');
	$ruas = $this->menu->get_menu_boser();
		foreach($ruas as $key => $value) {
			$result[$value->id] = $value->name;
		}
			
	return $result;
	}


###### // Kediri - Tulung Agung Registration

	public function add_investkedigung($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}

		
	
		
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_investkedigung', array('lelang'=>$lelang, 'ruas'=>$this->get_kedigung(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_investkedigung() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			// $this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			// $this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			// $this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			// $this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			// $this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				// $data['password'] = md5($data['password']);
				// unset($data['password_confirmation']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '36';
				$data['lelang_jt'] = $this->input->post('lelang_jt');
				$emaile = $data['email'];
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					// if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
					// 	$mime = mime_content_type($_FILES['image']['tmp_name']);
					// 	if ($mime == 'application/pdf' ){
					// 		$filename = $_FILES['image']['name'];
					// 		$extensions = explode('.', $filename);
					// 		$extension = $extensions[count($extensions)-1];
					// 		$filetype = $_FILES['image']['type'];
					// 		$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/lelangs/' . $id;
							
					// 		if (!is_dir($upload_dir)) {
					// 			mkdir($upload_dir, 0755, true);
					// 		}
					// 		$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
					// 		$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
					// 		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
					// 		$photo = array(
					// 			'photo'=>$new_imagepath
					// 		);
					// 		$this->lelang->update($id, $photo);
					// 	}
					// }else{
					// 	$photo = array(
					// 		'photo'=>''
					// 	);
					// 	$this->lelang->update($id, $photo);
					// }
					$this->sendEmail($id,$emaile,'invest_reg_kedigung');

				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page?loc=invest_reg_kedigung&sukses=true');

					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('invest_reg_kedigung');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_investkedigung($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_investkedigung($this->input->post());
			}
		}
	}
	
	private function get_kedigung() {
		$this->load->model('menu');

		//$result = array('0' => '- Pilih Ruas -');
		$ruas = $this->menu->get_menu_kedigung();
			foreach($ruas as $key => $value) {
				$result[$value->id] = $value->name;
			}
				
		return $result;
	}




	################################################################################################
	public function add_conf($filled_value=null) {
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		
		$lelang = array();
		if (isset($filled_value)) {
			$lelang = $filled_value;
		}
		
		$db_user_groups = $this->user_group->get_published_user_groups();
		foreach($db_user_groups as $db_user_group) {
			$user_groups[$db_user_group->id] = $db_user_group->name;
		}
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_conf', array('lelang'=>$lelang, 'provinces' => $this->get_provinces(), 'districts' => $this->get_districts(), 'subdistricts' => $this->get_subdistricts(), 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function create_conf() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

		
			$this->form_validation->set_rules('ceo_name', 'CEO Name', 'trim|required');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|callback_check_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			// $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|callback_checkcompanyavailable');
			$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
			$this->form_validation->set_rules('nik', 'ID', 'trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_message('check_email', 'Email required.');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('checkcompanyavailable', 'Company Name Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				unset($data['reg']);
				$data['password'] = md5($data['password']);
				unset($data['password_confirmation']);
				if(!empty($this->input->post('bdate')) && !empty($this->input->post('bmonth')) && !empty($this->input->post('byear'))) {
					$data['birthdate'] = $this->input->post('byear').'-'.$this->input->post('bmonth').'-'.$this->input->post('bdate');
				}
				unset($data['bdate']);
				unset($data['bmonth']);
				unset($data['byear']);
				if(!empty($this->input->post('ddate')) && !empty($this->input->post('dmonth')) && !empty($this->input->post('dyear'))) {
					$data['date_of_death'] = $this->input->post('dyear').'-'.$this->input->post('dmonth').'-'.$this->input->post('ddate');
				}
				unset($data['ddate']);
				unset($data['dmonth']);
				unset($data['dyear']);
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['image']);
				$data['status'] = 'draft';
				$data['user_group_id'] = '22';
				if ($this->lelang->insert($data)) {
					$id = $this->db->insert_id();
					
					if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
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
						
						 _uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
						$photo = array(
							'photo'=>$new_imagepath
						);
						$this->lelang->update($id, $photo);
					}else{
						$photo = array(
							'photo'=>''
						);
						$this->lelang->update($id, $photo);
					}
				}

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					$this->session->set_flashdata('sukses', 'Registration Success');		
					redirect('register_conf');
					# code...
				}else{
					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_conf($this->input->post());
				}
				// $this->session->set_flashdata('employee_success', true);
				// redirect('admin');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$this->add_conf($this->input->post());
			}
		}
	}

	public function sendEmail($id = null,$emaile,$jenis)
	{
		$config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'bpjt.lelang@gmail.com',  // Email gmail
            // 'smtp_pass'   => 'adgpmvusafasveyh',  // Password gmail
            'smtp_pass'   => 'mmmbdqhmxnhulzcn',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            // 'smtp_port'   => 587,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        // $this->load->library('email', $config);
        $this->load->library('email');
        $this->email->initialize($config);


        // $this->load->library('email', $config);
        $this->load->library('email');
        $this->email->initialize($config);

        // Email dan nama pengirim
        // $this->email->from('racorp.pubg@gmail.com', 'Verifikasi Akun');
        $this->email->from('bpjt.lelang@gmail.com', 'Verifikasi Akun');

        // Email penerima
        $this->email->to($emaile); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

        // Subject email
        $this->email->subject('Verifikasi Akun Lelang');
		$id = $this->enc('enc',$id);
		$url=base_url().'index.php/add_reg_user/'.$id.'.'.$jenis;
		// $message = "<h3>Klik tautan dibawah ini untuk menuju halaman otentikasi upload file surat kuasa, pembuatan username & password</h3> <a href=\"$url\">Klik Disini</a>";
		$message = 'Terima kasih telah melakukan pendaftaran, data anda akan direview oleh panitia dan hasilnya akan segera disampaikan melalui alamat email terdaftar.';
        // Isi email
        // $this->email->message("Silahkan Klik Link berikut <a href=\"$url\">Klik Disini</a> ");
        $this->email->message($message);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
			// echo $emaile;
			// die('sukses');
        } else {
			// die('gagal');

            echo 'Error! email tidak dapat dikirim.';
            // show_error($this->email->print_debugger());
        }
	}

	
	public function add_user($id=null) {
		// echo $id;exit();
		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');
		$exp= explode('.',$id);
		$id = $exp[0];
		$jenis = $exp[1];
		

		
		$id = $this->enc('dec',$id);

		$check = $this->lelang->cekUser($id);
		if (!empty($check['username'])) {
		
			redirect('activated');
		}
		
		

		
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		

		
	
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/register_user', array('id' => $id,'jenis' => $jenis), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/lelang_content.php', $data);
	}
	public function create_user() {
		// $mime = mime_content_type($_FILES['image']['tmp_name']);
		// echo $mime;
		// echo "<pre>";
		// print_r ($_FILES);
		// echo "</pre>";exit();
		
	
		
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_checkusernameavailable');
			$this->form_validation->set_rules('password', 'Password', 'trim|callback_check_password');
			$this->form_validation->set_rules('password_confirmation', 'Confirmation Password', 'trim|callback_check_password_confirmation');
			$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_type');
			$this->form_validation->set_message('check_username', 'Username required.');
			$this->form_validation->set_message('check_type', 'Silakan ganti file karena file tidak dikenal.');
			$this->form_validation->set_message('checkusernameavailable', 'Username Already Exist.');
			$this->form_validation->set_message('check_password', 'Password / confirmation Password required.');
			$this->form_validation->set_message('check_password_confirmation', 'confirmation Password not Match.');
			// $this->form_validation->set_message('required', 'Name required.');
			$this->form_validation->set_message('numeric_wcomma', 'Only number.');
			$id = $this->input->post('id',true);
			$jenis = $this->input->post('jenis',true);
			if ($this->form_validation->run()) {
				foreach($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}
				
				$id= $data['id'];
				$data['password'] = md5($data['password']);
				$data['updated_at'] = date('Y-m-d H:i:s');
				unset($data['password_confirmation']);
				unset($data['id']);
				unset($data['jenis']);
				// echo "<pre>";
				// print_r ($data);
				// echo "</pre>";exit();
				// if ($this->lelang->insert($data)) {
					if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image']['tmp_name']);

						
						if ($mime == 'application/pdf' ){
							$filename = $_FILES['image']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/uploads/lelangs/' . $id;
							
							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}
							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'uploads/lelangs/' . $id . '/' . $new_filename;
							move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);
							$data['photo']=$new_imagepath;
							$this->lelang->update($id, $data);
						}
					}else{
						$data['photo']='';
						$this->lelang->update($id, $data);
					}

				// }

				// integration user kc
                $this->load->library('curl');
                $username = $data['username'];
                $password = $this->input->post('password');
                $fullname = $data['ceo_name'];//." ".$data['middle_name']." ".$data['last_name'];
                $fullname = ! empty($fullname) ? urlencode(trim($fullname)) : urlencode($data['username']);
                $email = ! empty($data['email']) ? $data['email'] : $data['username']."@bpjt.net";

                $this->curl->simple_get(site_url("kc/services/api/rest/xml?method=user.register&email={$email}&name={$fullname}&username={$username}&password={$password}"));

				// $this->user_log->add_log($this->session->userdata('user_id'), 'lelangs', $id, 'Pengguna menambah data pegawai');
				$this->user_log->add_log($id, 'lelangs', $id, 'Register Success');
				if ($id) {
					redirect('success_page_user?loc='.$jenis);

					// $this->session->set_flashdata('sukses', 'Registration Success');		
					// redirect('invest_reg_kedigung','');
					# code...
				}else{
					die('tengah');

					$this->session->set_flashdata('failed', 'Registration Failed');		
					// redirect('register');
					$this->add_user($this->input->post());
				}

				// $this->session->set_flashdata('employee_success', true);
				// redirect('success_page');
				// echo "cob";
			} else {
				$this->session->set_flashdata('failed', 'Registration Failed');	
				$idE = $this->enc('enc',$id);
				$this->add_user($idE);
				// redirect('add_reg_user/'.$idE);
			}
		}
	}

	public function enc($action,$string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";

		$secret_key = 'bpjt';
		$secret_iv = 'bpjtBaru';

		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_key), 0, 16);
		 
		if( $action == 'enc'){
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}else if( $action == 'dec'){
			$output = openssl_decrypt(base64_decode($string), $encrypt_method,$key,0,$iv);
		}

		return $output;

		
	}

	public function success_page()
	{
		$loc = clean_str($this->input->get('loc',true));
		

		$str['utama'] = 'https://bpjt.pu.go.id/';
		$str['return'] = $loc;

		$this->load->model(array('lelang', 'comment', 'user_group'));
		$this->load->helper('form');


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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		

		
	
		$str['isi'] = '<h4 class="lead" style="text-align: center;color: white;"><strong>Selamat Register Telah Berhasil.</strong></h4>
			<h2 class="lead" style="text-align: center;color: white;"><strong>Tautan otentikasi upload file verifikasi, username & password akan dikirim melalui email yang didaftarkan.</strong></h2>';
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/success_page', $str, true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
			
		$this->load->view('layouts/lelang_content.php', $data);
	}

	public function success_page_user($content = null)
	{
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		

		$return = $this->input->get('loc',true);
		$str['utama'] = './';
		$str['return'] = $return;
		$str['isi'] = '<h4 class="lead" style="text-align: center;color: white;"><strong>Selamat Register Telah Berhasil.</strong></h4>
			<h2 class="lead" style="text-align: center;color: white;"><strong>Silahkan Tunggu Username Aktif.</strong></h2>';
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/success_page', $str, true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
			$this->load->view('layouts/lelang_content.php', $data);
	}
	public function activated($content = null)
	{
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
		
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.lelanguser.form.css');
		

		
	
		$str['isi'] = '<h4 class="lead" style="text-align: center;color: white;"><strong>Akun Anda Telah Teregister.</strong></h4>';
		
		$data = array(
			// 'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Sistem Informasi', 'title' => 'Pendaftaran'), true),
			'content' => $this->load->view('admin/lelangusers/success_page', $str, true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			// 'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
			$this->load->view('layouts/lelang_content.php', $data);
	}

	public function check_type() {
		$this->session->unset_userdata('idUser');
	
		
		if (@$_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {

			$mime = mime_content_type($_FILES['image']['tmp_name']);
			if ($mime == 'application/pdf' ){
				return true;
			} else {
				$this->session->set_userdata('idUser', $this->input->post('id',true));

				return false;
			}
		} 
		return false;
	}

	public function upload_image($field, $id) {
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

					$new_filename = sha1($field . $id . $filename) . '.' . $extension;
					
					$destination =  $upload_dir . $new_filename;
					$source = $_FILES[$field]['tmp_name'];
					
					move_uploaded_file($source, $destination);
					
					return $new_filename;
				}
			}
		}

		return null;
	}

}
