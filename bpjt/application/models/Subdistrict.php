<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subdistrict extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_subdistricts($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_subdistricts($page, $entry);
		} else {
			return $this->search_subdistricts($query, $page, $entry);
		}
	}
	
	public function get_subdistricts($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('subdistricts');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_subdistricts($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('subdistricts');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function get_subdistrict($id) {
		$this->db->where('id', $id);
	
		return $this->db->get('subdistricts')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('subdistricts', $data);
	}
	
	public function update($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('subdistricts', $data);
	}
	
	public function destroy($id) {
		$record = $this->get_subdistrict($id);
		$record = $record[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$record->name . '-' . $record->id . '-deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		return $this->db->update('subdistricts', $data);
	}
}
