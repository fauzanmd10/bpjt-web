<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_Group extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_vehicle_groups($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_vehicle_groups($page, $entry);
		} else {
			return $this->search_vehicle_groups($query, $page, $entry);
		}
	}
	
	public function get_vehicle_groups($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('vehicle_groups');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, $page-1);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_vehicle_groups($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('vehicle_groups');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, $page-1);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_vehicle_groups() {
		$this->db->select('*');
		$this->db->from('vehicle_groups');
		$this->db->where("status = 'published'");
		//$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function get_vehicle_group($vehicle_group_id) {
		$this->db->where('id', $vehicle_group_id);
	
		return $this->db->get('vehicle_groups')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('vehicle_groups', $data);
	}
	
	public function update($vehicle_group_id, $data) {
		$this->db->where('id', $vehicle_group_id);
		return $this->db->update('vehicle_groups', $data);
	}
	
	public function destroy($vehicle_group_id) {
		$vehicle_group = $this->get_vehicle_group($vehicle_group_id);
		$vehicle_group = $vehicle_group[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$vehicle_group->name . '-' . $vehicle_group->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $vehicle_group_id);
		return $this->db->update('vehicle_groups', $data);
	}
}