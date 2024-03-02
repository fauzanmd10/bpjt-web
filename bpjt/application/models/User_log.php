<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Log extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_logs($page = "", $item_per_page = "") {
		$this->db->select('logs.*, employees.username, employees.first_name AS employee_first_name, employees.middle_name AS employee_middle_name, employees.last_name AS employee_last_name');
		$this->db->from('logs');
		$this->db->join('employees', 'logs.user_id = employees.id', 'left');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, $page-1);
		}

		return $this->db->get()->result();
	}

	public function insert($data) {
		return $this->db->insert('logs', $data);
	}

	public function add_log($user_id, $table_name, $object_id, $log_message) {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if(getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if(getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if(getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if(getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if(getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$data = array(
			'user_id'=>$user_id,
			'table_name'=>$table_name,
			'object_id'=>$object_id,
			'log_message'=>$log_message,
			'user_agent'=>$user_agent,
			'ip_address'=>$ipaddress,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
		);

		$this->insert($data);
	}

	public function destroy($log_id) {
		$data = array(
			'status'=>'deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $log_id);
		return $this->db->update('logs', $data);
	}

}