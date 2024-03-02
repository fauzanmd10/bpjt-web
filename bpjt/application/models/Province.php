<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Province extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_provinces($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_provinces($page, $entry);
		} else {
			return $this->search_provinces($query, $page, $entry);
		}
	}
	
	public function get_provinces($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('provinces');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_provinces($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('provinces');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function get_province($id) {
		$this->db->where('id', $id);
	
		return $this->db->get('provinces')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('provinces', $data);
	}
	
	public function update($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('provinces', $data);
	}
	
	public function destroy($id) {
		$record = $this->get_province($id);
		$record = $record[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$record->name . '-' . $record->id . '-deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		return $this->db->update('provinces', $data);
	}
}
