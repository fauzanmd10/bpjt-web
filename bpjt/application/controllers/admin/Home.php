<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->library('session');
	}
	public function index() {

		
		// $this->load->library('csrf');
		$data = array(
			'content' => $this->load->view('admin/home/index', array('flash'=>$this->session->flashdata('login_fail')), true)
		);
		$this->load->view('layouts/admin_login.php', $data);
		// $this->load->view('admin/home/login.php', $data);
	}

	public function processing() {
		// echo $this->input->cookie();exit();
		// echo $_COOKIE;exit();
		// echo $this->security->get_csrf_token_name().'/'.$this->security->get_csrf_hash() ;exit();
		// if ($this->csrf->csrf_validate()) {
		// 	// process form
		// 	echo 'masuk';
		// } else {
		// 	  echo 'gak masuk';
		// 	// error handling
		// }
		// if (hash_equals($this->security->get_csrf_hash(), $this->input->post($this->security->get_csrf_token_name(), TRUE))) {
			// Action if the token is valid
			if ($this->input->post()) {
				$this->load->model(array('user', 'user_log'));
				$this->load->library('form_validation');

				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_message('required', 'Username / Password harus terisi.');

				if ($this->form_validation->run()) {
					$user = $this->user->get_user_login($this->input->post('username',true), $this->input->post('password',true));
					if (!empty($user)) {
						// die('masuk atas');
						$user = $user[0];
						$this->user->login($user);
						$this->user_log->add_log($user->id, 'users', null, 'User login');
						redirect('admin/dashboard');
					} else {
						// die('masuk tengah');
						$this->session->set_flashdata('login_fail', true);
						redirect('halamanadminBPJT');
					}
				} else {
					// die('masuk bawah');
					$this->session->set_flashdata('login_fail', true);
					redirect('halamanadminBPJT');
				}
			}
		// } else {
		// 	redirect("/");
		// // Action if the token is invalid
		// }
	}

	public function logout() {
		$this->load->model('user_log');
		$this->user_log->add_log($this->session->userdata('user_id'), 'employees', null, 'User logout');
		
		$this->session->sess_destroy();
		redirect('/');
	}
	
	public function lelang() {
		$this->load->helper('form');
		$stylesheets = array('admin.lelanguser.form.css');
		$data = array(
			'content' => $this->load->view('admin/home/lelang', array('flash'=>$this->session->flashdata('login_fail')), true),
			'stylesheets' => $stylesheets
		);
		$this->load->view('layouts/admin_login.php', $data);
	}

	public function processing_lelang() {
		if ($this->input->post()) {
			$this->load->model(array('lelang', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_message('required', 'Username / Password harus terisi.');

			if ($this->form_validation->run()) {
				$user = $this->lelang->get_user_login($this->input->post('username',true), $this->input->post('password',true));
				// print_r($user);
				if (!empty($user)) {
					$user = $user[0];
					$this->lelang->login($user);
					$this->user_log->add_log($user->id, 'users', null, 'User login');
					redirect('auctions');
				} else {
					$this->session->set_flashdata('login_fail', true);
					redirect('auction');
				}
			} else {
				// print_r($user);
				$this->session->set_flashdata('login_fail', true);
				redirect('auction');
			}
		}
	}
	public function log_out() {
		$this->load->model('user_log');
		$this->user_log->add_log($this->session->userdata('user_id'), 'lelang', null, 'User logout');
		
		$this->session->sess_destroy();
		redirect('admin');
	}
	public function lelang_admin() {
		$this->load->helper('form');
		$stylesheets = array('admin.lelanguser.form.css');
		$data = array(
			'content' => $this->load->view('admin/home/lelang_admin', array('flash'=>$this->session->flashdata('login_fail')), true),
			'stylesheets' => $stylesheets
		);
		$this->load->view('layouts/admin_login.php', $data);
	}

	public function processing_lelang_admin() {
		if ($this->input->post()) {
			$this->load->model(array('user', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_message('required', 'Username / Password harus terisi.');

			if ($this->form_validation->run()) {
				$user = $this->user->get_user_login($this->input->post('username',true), $this->input->post('password',true));
				// print_r($user);

				if (!empty($user)) {
					$user = $user[0];
					$this->user->login($user);
					$this->user_log->add_log($user->id, 'users', null, 'User login');
					// redirect('admin/lelangdoc');
					$user_group_id = $this->session->userdata('user_group_id');
					if($user_group_id == 77){
						redirect('auctions?id_ruas=85');
					} else {
						redirect('auctions');
					}
				} else {
					$this->session->set_flashdata('login_fail', true);
					redirect('auction_admin');
				}
			} else {
				// print_r($user);
				$this->session->set_flashdata('login_fail', true);
				// redirect('auction');
			}
		}
	}
	public function log_outs() {
		$this->load->model('user_log');
		$this->user_log->add_log($this->session->userdata('user_id'), 'lelang', null, 'User logout');
		
		$this->session->sess_destroy();
		redirect('admin');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */