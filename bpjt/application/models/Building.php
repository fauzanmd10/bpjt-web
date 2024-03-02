<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_buildings($page = "", $item_per_page = "") {
		$this->db->select('buildings.*, instances.name AS instance_name');
		$this->db->from('buildings');
		$this->db->join('instances', 'buildings.instance_id = instances.id', 'left');
		$this->db->where("buildings.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_building($building_id) {
		$this->db->select('buildings.*, instances.name AS instance_name');
		$this->db->from('buildings');
		$this->db->join('instances', 'buildings.instance_id = instances.id', 'left');
		$this->db->where('buildings.id', $building_id);
		return $this->db->get()->result();
	}

	public function get_building_by_slug($slug) {
		$this->db->where('slug', $slug);
		return $this->db->get('buildings')->result();
	}

	public function get_buildings_by_instance($instance_id) {
		$this->db->where('instance_id', $instance_id);
		$this->db->where('status != "deleted"');
		return $this->db->get('buildings')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('buildings', $data);
	}

	public function update($building_id, $data) {
		$this->db->where('id', $building_id);
		return $this->db->update('buildings', $data);
	}

	public function destroy($building_id) {
		$building = $this->get_building($building_id);
		$building = $building[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$building->name . '-' . $building->id . '-deleted',
			'slug'=>$building->slug . '-' . $building->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $building_id);
		return $this->db->update('buildings', $data);
	}
	  
}
