<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_Type extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_inventory_types($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('inventory_types');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_inventory_type($inventory_type_id) {
		$this->db->where('id', $inventory_type_id);
		return $this->db->get('inventory_types')->result();
	}

	public function get_inventory_type_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get('inventory_types')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('inventory_types', $data);
	}

	public function update($inventory_type_id, $data) {
		$this->db->where('id', $inventory_type_id);
		return $this->db->update('inventory_types', $data);
	}

	public function destroy($inventory_type_id) {
		$inventory_type = $this->get_inventory_type($inventory_type_id);
		$inventory_type = $inventory_type[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$inventory_type->name . '-' . $inventory_type->id . '-deleted',
			'code'=>$inventory_type->code . '-' . $inventory_type->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $inventory_type_id);
		return $this->db->update('inventory_types', $data);
	}
	  
}
