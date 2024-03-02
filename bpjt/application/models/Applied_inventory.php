<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applied_Inventory extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_applied_inventories($page = "", $item_per_page = "") {
		$this->db->select('applied_inventories.*, inventories.name AS inventory_name, inventory_types.name AS inventory_type_name, merk_types.name AS merk_type_name, measurements.name AS measurement_name, building_rooms.name AS building_room_name, buildings.name AS building_name, instances.name AS instance_name');
		$this->db->from('applied_inventories');
		$this->db->join('inventories', 'applied_inventories.inventory_id = inventories.id', 'left');
		$this->db->join('inventory_types', 'inventories.inventory_type_id = inventory_types.id', 'left');
		$this->db->join('merk_types', 'inventories.merk_type_id = merk_types.id', 'left');
		$this->db->join('measurements', 'inventories.measurement_id = measurements.id', 'left');
		$this->db->join('building_rooms', 'applied_inventories.building_room_id = inventories.id', 'left');
		$this->db->join('buildings', 'applied_inventories.building_id = buildings.id', 'left');
		$this->db->join('instances', 'applied_inventories.instance_id = instances.id', 'left');
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_applied_inventory($applied_inventory_id) {
		$this->db->select('applied_inventories.*, inventories.name AS inventory_name, inventory_types.name AS inventory_type_name, merk_types.name AS merk_type_name, measurements.name AS measurement_name, building_rooms.name AS building_room_name, buildings.name AS building_name, instances.name AS instance_name');
		$this->db->from('applied_inventories');
		$this->db->join('inventories', 'applied_inventories.inventory_id = inventories.id', 'left');
		$this->db->join('inventory_types', 'inventories.inventory_type_id = inventory_types.id', 'left');
		$this->db->join('merk_types', 'inventories.merk_type_id = merk_types.id', 'left');
		$this->db->join('measurements', 'inventories.measurement_id = measurements.id', 'left');
		$this->db->join('building_rooms', 'applied_inventories.building_room_id = inventories.id', 'left');
		$this->db->join('buildings', 'applied_inventories.building_id = buildings.id', 'left');
		$this->db->join('instances', 'applied_inventories.instance_id = instances.id', 'left');
		$this->db->where('applied_inventories.id', $applied_inventory_id);
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('applied_inventories', $data);
	}

	public function update($applied_inventory_id, $data) {
		$this->db->where('id', $applied_inventory_id);
		return $this->db->update('applied_inventories', $data);
	}

	public function destroy($applied_inventory_id) {
		$this->db->where('id',$applied_inventory_id);
		return $this->db->delete('applied_inventories');
	}
	  
}
