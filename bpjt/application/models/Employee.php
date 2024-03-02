<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_employees($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_employees($page, $entry);
		} else {
			return $this->search_employees($query, $page, $entry);
		}
	}
	
	public function get_employees($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('first_name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function query_employees_by_email($query) {
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where("status = 'published'");
		$this->db->like("email", $query);
		$this->db->or_like("first_name", $query);
		$this->db->or_like("last_name", $query);
		$this->db->order_by('first_name', 'asc');

		return $this->db->get()->result();
	}
	
	public function search_classifications($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('employees');
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
		return $this->db->insert('employees', $data);
	}
	
	public function get_employee($employee_id) {
		$this->db->where('id', $employee_id);
	
		return $this->db->get('employees')->result();
	}
	
	public function update($employee_id, $data) {
		$this->db->where('id', $employee_id);
		return $this->db->update('employees', $data);
	}
		
	public function destroy($employee_id) {
		$employee = $this->get_employee($employee_id);
		$employee = $employee[0];
		$data = array(
			'status'=>'deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $employee_id);
		return $this->db->update('employees', $data);
	}
	
	public function destroy_image($employee_id) {
		$employee = $this->get_employee($employee_id);
		$employee = $employee[0];
		$data = array(
			'photo' => '',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $employee_id);
		return $this->db->update('employees', $data);
	}
}