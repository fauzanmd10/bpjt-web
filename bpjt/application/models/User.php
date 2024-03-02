<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_users($page = "", $item_per_page = "") {
		$this->db->select('employees.*, user_groups.name AS group_name');
		$this->db->from('employees');
		$this->db->join('user_groups', 'employees.user_group_id = user_groups.id', 'left');
		$this->db->where("employees.status != 'deleted'");
		$this->db->order_by('employees.created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_user_by_id($user_id) {
		$this->db->select('employees.*, user_groups.name AS group_name');
		$this->db->from('employees');
		$this->db->join('user_groups', 'employees.user_group_id = user_groups.id', 'left');
		$this->db->where('employees.id', $user_id);
		return $this->db->get()->result();
	}

	public function get_user_login($username, $password = "") {
		$this->db->where('username', $username);
		if ($password != "") {
			$this->db->where('password', md5($password));
		}
		return $this->db->get('employees')->result();
	}

	public function login($user) {
		$this->load->model('access');

		$accesses = $this->access->get_user_accesses_by_group($user->user_group_id);
		$user_access = array('access'=>array());
		foreach($accesses as $access) {
			$user_access['access'][$access->access_key] = array();
			if ($access->single) {
				$user_access['access'][$access->access_key]['single'] = '1';
			}

			if ($access->add) {
				$user_access['access'][$access->access_key]['add'] = '1';
			}

			if ($access->edit) {
				$user_access['access'][$access->access_key]['edit'] = '1';
			}

			if ($access->destroy) {
				$user_access['access'][$access->access_key]['destroy'] = '1';
			}
		}

		$fullname = null;
		if(!empty($user->front_title)) $fullname .= trim($user->front_title, '.').'. '; 
		$fullname .= $user->first_name;
		if(!empty($user->middle_name)) $fullname .= ' '.$user->middle_name;
		if(!empty($user->last_name)) $fullname .= ' '.$user->last_name;
		if(!empty($user->back_title)) $fullname .= ' '.trim($user->back_title).'.';
		
  		$user_session = array(
  			'user_id'=>$user->id,
  			'username'=>$user->username,
  			'fullname'=>$fullname,
  			'email'=>$user->email,
  			'user_group_id'=>$user->user_group_id,
  			'photo'=>$user->photo,
  			'logged_in'=>true
  		);

  		$this->session->set_userdata($user_session);
	}

	public function insert($data) {
		return $this->db->insert('employees', $data);
	}

	public function update($user_id, $data) {
		$this->db->where('id', $user_id);
		return $this->db->update('employees', $data);
	}

	public function destroy($user_id) {
		$user = $this->get_user_by_id($user_id);
		$user = $user[0];
		$data = array(
			'email'=>$user->email . "-" . $user->id . "-deleted",
			'username'=>$user->username . "-" . $user->id . "-deleted",
			'status'=>'deleted'
		);
		return $this->update($user_id, $data);
	}
}