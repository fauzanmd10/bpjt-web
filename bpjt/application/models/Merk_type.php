<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merk_Type extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_merk_types($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('merk_types');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_merk_type($merk_type_id) {
		$this->db->where('id', $merk_type_id);
		return $this->db->get('merk_types')->result();
	}

	public function get_merk_type_by_slug($slug) {
		$this->db->where('slug', $slug);
		return $this->db->get('merk_types')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('merk_types', $data);
	}

	public function update($merk_type_id, $data) {
		$this->db->where('id', $merk_type_id);
		return $this->db->update('merk_types', $data);
	}

	public function destroy($merk_type_id) {
		$merk_type = $this->get_merk_type($merk_type_id);
		$merk_type = $merk_type[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$merk_type->name . '-' . $merk_type->id . '-deleted',
			'slug'=>$merk_type->slug . '-' . $merk_type->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $merk_type_id);
		return $this->db->update('merk_types', $data);
	}
	  
}
