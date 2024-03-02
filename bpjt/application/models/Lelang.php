<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lelang extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_lelang($entry, $page, $query, $id_ruas = "") {
		if (empty($query)) {
			return $this->get_lelangs($page, $entry, $id_ruas);
		} else {
			return $this->search_lelang($query, $page, $entry);
		}
	}
	
	public function get_lelangs($page = "", $item_per_page = "", $id_ruas = "") {
		$this->db->select('lelang_users.*,menus.name as ruas');
		$this->db->from('lelang_users');
		$this->db->join('menus', 'lelang_users.lelang_jt = menus.id', 'left');
		$this->db->where("lelang_users.status != 'deleted'");

		$user_group_id = $this->session->userdata('user_group_id');
		$user_id = $this->session->userdata('user_id');
		

		if ($user_group_id != "19" && $user_group_id != "21" && $user_group_id != "25" && $user_group_id != "27" && $user_group_id != "29" && $user_group_id != "31" && $user_group_id != "33" && $user_group_id != "35" && $user_group_id != "37" && $user_group_id != "43" && $user_group_id != "45" && $user_group_id != "77") {
            $this->db->where("lelang_users.id = '".$user_id."'");
		} elseif ($this->session->userdata('user_group_id')=='19') {
			# code...
			$this->db->where("user_group_id= '18'");
			$this->db->or_where("user_group_id= '22'");
		}else if ($this->session->userdata('user_group_id')=='25') {
			$this->db->where("user_group_id= '24'");
		}else if ($this->session->userdata('user_group_id')=='27') {
			$this->db->where("user_group_id= '26'");
		}else if ($this->session->userdata('user_group_id')=='29') {
			$this->db->where("user_group_id= '28'");
		}else if ($this->session->userdata('user_group_id')=='31') {
			$this->db->where("user_group_id= '30'");
		}else if ($this->session->userdata('user_group_id')=='33') {
			$this->db->where("user_group_id= '32'");
		}else if ($this->session->userdata('user_group_id')=='35') {
			$this->db->where("user_group_id= '34'");
		}else if ($this->session->userdata('user_group_id')=='37') {
			$this->db->where("user_group_id= '36'");
		}else if ($this->session->userdata('user_group_id')=='43') {
			$this->db->where("user_group_id= '42'");
		}else if ($this->session->userdata('user_group_id')=='45') {
			$this->db->where("user_group_id= '44'");
		}else if ($this->session->userdata('user_group_id')=='77') {
			// ID Ruas
			if($id_ruas == 85){
				$this->db->where("user_group_id = '42'");
			} elseif($id_ruas == 63){
				$this->db->where("user_group_id = '44'");
			}
		} else{
			$this->db->where("user_group_id= '20'");
		}
		
		
		$this->db->order_by('created_at', 'desc');
		$this->db->order_by('ceo_name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function query_lelang_by_email($query) {
		$this->db->select('*');
		$this->db->from('lelang_users');
		$this->db->where("status = 'published'");
		$this->db->like("email", $query);
		$this->db->or_like("ceo_name", $query);
		$this->db->or_like("last_name", $query);
		$this->db->order_by('ceo_name', 'asc');

		return $this->db->get()->result();
	}
	
	public function search_classifications($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('lelang_users');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_photo_by_style($image_url, $style) {
		$parsed = explode('/', $image_url);
		$filename = $parsed[count($parsed)-1];
		unset($parsed[count($parsed)-1]);
		$new_url = implode('/', $parsed);
		$new_url = $new_url . '/' . $style . '/' . $filename;

		return $new_url;
	}
	
	public function insert($data) {
		return $this->db->insert('lelang_users', $data);
	}
	
	public function get_lelang($lelang_id) {
		$this->db->select('lelang_users.*,menus.name as ruas');
		$this->db->from('lelang_users');
		$this->db->join('menus', 'lelang_users.lelang_jt = menus.id', 'left');
		$this->db->where("lelang_users.status != 'deleted'");
		$this->db->where('lelang_users.id', $lelang_id);

		$user_id = $this->session->userdata('user_id');
		$user_group_id= $this->session->userdata('user_group_id');
		if ($user_group_id == '18'|| $user_group_id == '20' || $user_group_id == '22'||$user_group_id == '23'||$user_group_id == '24'||$user_group_id == '26'||$user_group_id == '28'||$user_group_id == '30'||$user_group_id == '32'||$user_group_id == '34'||$user_group_id == '36'||$user_group_id == '42'||$user_group_id == '44') {
			$this->db->where('lelang_users.id', $user_id);
		}
		
		return $this->db->get()->result();
	}
	
	public function update($lelang_id, $data) {
		$this->db->where('id', $lelang_id);
		
		$user_id = $this->session->userdata('user_id');
		$user_group_id= $this->session->userdata('user_group_id');
		if ($user_group_id == '18'|| $user_group_id == '20' || $user_group_id == '22'||$user_group_id == '23'||$user_group_id == '24'||$user_group_id == '26'||$user_group_id == '28'||$user_group_id == '30'||$user_group_id == '32'||$user_group_id == '34'||$user_group_id == '36'||$user_group_id == '42'||$user_group_id == '44') {
			$this->db->where('id', $user_id);
		}
		
		return $this->db->update('lelang_users', $data);
	}
		
	public function destroy($lelang_id) {
		$employee = $this->get_lelang($lelang_id);
		$employee = $employee[0];
		$data = array(
			'status'=>'deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $lelang_id);
		return $this->db->update('lelang_users', $data);
	}
	
	public function destroy_image($lelang_id) {
		$employee = $this->get_lelang($lelang_id);
		$employee = $employee[0];
		$data = array(
			'photo' => '',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $lelang_id);
		return $this->db->update('lelang_users', $data);
    }

    public function get_users($page = "", $item_per_page = "") {
		$this->db->select('lelang_users.*,CONCAT(ceo_name, " ", last_name) as fullname, user_groups.name AS group_name');
		$this->db->from('lelang_users');
		$this->db->join('user_groups', 'lelang_users.user_group_id = user_groups.id', 'left');
		$this->db->where("lelang_users.status != 'deleted'");
		$this->db->order_by('lelang_users.created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_user_by_id($user_id) {
		$this->db->select('lelang_users.*,CONCAT(ceo_name, " ", last_name) as fullname, user_groups.name AS group_name');
		$this->db->from('lelang_users');
		$this->db->join('user_groups', 'lelang_users.user_group_id = user_groups.id', 'left');
		$this->db->where('lelang_users.id', $user_id);
		return $this->db->get()->result();
	}

	public function get_user_login($username, $password = "") {
		$this->db->where('username', $username);
		if ($password != "") {
			$this->db->where('status', 'published');
			$this->db->where('password', md5($password));
		}
		return $this->db->get('lelang_users')->result();
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
		$fullname .= $user->ceo_name;
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


	public function checkuser($username,$type) {
		$this->db->select('lelang_users.*,CONCAT(ceo_name, " ", last_name) as fullname, user_groups.name AS group_name');
		$this->db->from('lelang_users');
		$this->db->join('user_groups', 'lelang_users.user_group_id = user_groups.id', 'left');
		if ($type == 'mlff') {
			# code...
			$this->db->where('lelang_users.user_group_id', '18');
		}
		if ($type == 'invest') {
			# code...
			$this->db->where('lelang_users.user_group_id', '20');
		}
		if ($type == 'conf') {
			# code...
			$this->db->where('lelang_users.user_group_id', '22');
		}
		$status = array('published', 'draft');
		$this->db->where_in('lelang_users.status', $status);
		$this->db->where('username', $username);
		return $this->db->get()->result();
		// return $this->db->last_query();

	}
	public function checkcompany($company,$type) {
		$this->db->select('lelang_users.*,CONCAT(ceo_name, " ", last_name) as fullname, user_groups.name AS group_name');
		$this->db->from('lelang_users');
		$this->db->join('user_groups', 'lelang_users.user_group_id = user_groups.id', 'left');
		if ($type == 'mlff') {
			# code...
			$this->db->where('lelang_users.user_group_id', '18');
		}
		if ($type == 'invest') {
			# code...
			$this->db->where('lelang_users.user_group_id', '20');
		}
		if ($type == 'conf') {
			# code...
			$this->db->where('lelang_users.user_group_id', '22');
		}
		$status = array('published', 'draft');
		$this->db->where_in('lelang_users.status', $status);
		$this->db->where('lelang_users.company_name', $company);
		// return $this->db->last_query();
		
		return $this->db->get()->result();
	}

}