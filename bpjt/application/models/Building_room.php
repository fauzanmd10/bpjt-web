<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building_Room extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_building_rooms($page = "", $item_per_page = "") {
		$this->db->select('building_rooms.*, buildings.name AS building_name, instances.name AS instance_name');
		$this->db->from('building_rooms');
		$this->db->join('buildings', 'building_rooms.building_id = buildings.id', 'left');
		$this->db->join('instances', 'buildings.instance_id = instances.id', 'left');
		$this->db->where("building_rooms.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_building_room($building_room_id) {
		$this->db->select('building_rooms.*, buildings.name AS building_name, instances.name AS instance_name');
		$this->db->from('building_rooms');
		$this->db->join('buildings', 'building_rooms.building_id = buildings.id', 'left');
		$this->db->join('instances', 'buildings.instance_id = instances.id', 'left');
		$this->db->where('building_rooms.id', $building_room_id);
		return $this->db->get()->result();
	}

	public function get_building_room_by_slug($slug) {
		$this->db->where('slug', $slug);
		return $this->db->get('building_rooms')->result();
	}

	public function get_building_rooms_by_building($building_id) {
		$this->db->where('building_id', $building_id);
		$this->db->where('status != "deleted"');
		return $this->db->get('building_rooms')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('building_rooms', $data);
	}

	public function update($building_room_id, $data) {
		$this->db->where('id', $building_room_id);
		return $this->db->update('building_rooms', $data);
	}

	public function destroy($building_room_id) {
		$building_room = $this->get_building_room($building_room_id);
		$building_room = $building_room[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$building_room->name . '-' . $building_room->id . '-deleted',
			'slug'=>$building_room->slug . '-' . $building_room->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $building_room_id);
		return $this->db->update('building_rooms', $data);
	}
	  
}
