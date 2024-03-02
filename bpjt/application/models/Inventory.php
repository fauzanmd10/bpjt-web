<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_inventories($page = "", $item_per_page = "") {
		$this->db->select('inventories.*, inventory_types.name AS inventory_type_name, merk_types.name AS merk_type_name, measurements.name AS measurement_name');
		$this->db->from('inventories');
		$this->db->join('inventory_types', 'inventories.inventory_type_id = inventory_types.id', 'left');
		$this->db->join('merk_types', 'inventories.merk_type_id = merk_types.id', 'left');
		$this->db->join('measurements', 'inventories.measurement_id = measurements.id', 'left');
		$this->db->where("inventories.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_inventory($inventory_id) {
		$this->db->select('inventories.*, inventory_types.name AS inventory_type_name, merk_types.name AS merk_type_name, measurements.name AS measurement_name');
		$this->db->from('inventories');
		$this->db->join('inventory_types', 'inventories.inventory_type_id = inventory_types.id', 'left');
		$this->db->join('merk_types', 'inventories.merk_type_id = merk_types.id', 'left');
		$this->db->join('measurements', 'inventories.measurement_id = measurements.id', 'left');
		$this->db->where('inventories.id', $inventory_id);
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('inventories', $data);
	}

	public function update($inventory_id, $data) {
		$this->db->where('id', $inventory_id);
		return $this->db->update('inventories', $data);
	}

	public function destroy($inventory_id) {
		$inventory = $this->get_inventory($inventory_id);
		$inventory = $inventory[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$inventory->name . '-' . $inventory->id . '-deleted',
			'code'=>$inventory->code . '-' . $inventory->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $inventory_id);
		return $this->db->update('inventories', $data);
	}
	  
}
