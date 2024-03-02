<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Tariff extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_toll_tariffs($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_toll_tariffs($page, $entry);
		} else {
			return $this->search_toll_tariffs($query, $page, $entry);
		}
	}
	
	public function get_toll_tariffs($page = "", $item_per_page = "") {
		$this->db->select('toll_tariffs.*, toll_roads.name AS toll_road_name, enter_toll_gates.name AS enter_toll_gate_name, exit_toll_gates.name AS exit_toll_gate_name, vehicle_groups.name AS vehicle_group_name');
		$this->db->from('toll_tariffs');
		$this->db->join('toll_roads', 'toll_tariffs.toll_road_id = toll_roads.id', 'left');
		$this->db->join('toll_gates enter_toll_gates', 'toll_tariffs.enter_toll_gate_id = enter_toll_gates.id', 'left');
		$this->db->join('toll_gates exit_toll_gates', 'toll_tariffs.exit_toll_gate_id = exit_toll_gates.id', 'left');
		$this->db->join('vehicle_groups', 'toll_tariffs.vehicle_group_id = vehicle_groups.id', 'left');
		$this->db->where("toll_tariffs.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_tariffs($page = "", $item_per_page = "") {
		$this->db->select('toll_tariffs.*, toll_roads.name AS toll_road_name, enter_toll_gates.name AS enter_toll_gate_name, exit_toll_gates.name AS exit_toll_gate_name, vehicle_groups.name AS vehicle_group_name');
		$this->db->from('toll_tariffs');
		$this->db->join('toll_roads', 'toll_tariffs.toll_road_id = toll_roads.id', 'left');
		$this->db->join('toll_gates enter_toll_gates', 'toll_tariffs.enter_toll_gate_id = enter_toll_gates.id', 'left');
		$this->db->join('toll_gates exit_toll_gates', 'toll_tariffs.exit_toll_gate_id = exit_toll_gates.id', 'left');
		$this->db->join('vehicle_groups', 'toll_tariffs.vehicle_group_id = vehicle_groups.id', 'left');
		$this->db->where("toll_tariffs.status = 'published'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_tariffs_by_toll_road_id($toll_road_id) {
		$this->db->select('toll_tariffs.*, toll_roads.name AS toll_road_name, enter_toll_gates.name AS enter_toll_gate_name, exit_toll_gates.name AS exit_toll_gate_name, vehicle_groups.name AS vehicle_group_name');
		$this->db->from('toll_tariffs');
		$this->db->join('toll_roads', 'toll_tariffs.toll_road_id = toll_roads.id', 'left');
		$this->db->join('toll_gates enter_toll_gates', 'toll_tariffs.enter_toll_gate_id = enter_toll_gates.id', 'left');
		$this->db->join('toll_gates exit_toll_gates', 'toll_tariffs.exit_toll_gate_id = exit_toll_gates.id', 'left');
		$this->db->join('vehicle_groups', 'toll_tariffs.vehicle_group_id = vehicle_groups.id', 'left');
		if(is_array($toll_road_id)){
			$this->db->where_in("toll_tariffs.toll_road_id", $toll_road_id);
		} else {
			$this->db->where("toll_tariffs.toll_road_id", $toll_road_id);
		}
		$this->db->where("toll_tariffs.status = 'published'");
		$this->db->order_by('toll_tariffs.enter_toll_gate_id', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function search_toll_tariffs($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('toll_tariffs');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function get_toll_tariff($toll_tariff_id) {
		$this->db->select('toll_tariffs.*, toll_roads.name AS toll_road_name, enter_toll_gates.name AS enter_toll_gate_name, exit_toll_gates.name AS exit_toll_gate_name, vehicle_groups.name AS vehicle_group_name');
		$this->db->from('toll_tariffs');
		$this->db->join('toll_roads', 'toll_tariffs.toll_road_id = toll_roads.id', 'left');
		$this->db->join('toll_gates enter_toll_gates', 'toll_tariffs.enter_toll_gate_id = enter_toll_gates.id', 'left');
		$this->db->join('toll_gates exit_toll_gates', 'toll_tariffs.exit_toll_gate_id = exit_toll_gates.id', 'left');
		$this->db->join('vehicle_groups', 'toll_tariffs.vehicle_group_id = vehicle_groups.id', 'left');
		$this->db->where('toll_tariffs.id', $toll_tariff_id);
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('toll_tariffs', $data);
	}
	
	public function update($toll_tariff_id, $data) {
		$this->db->where('id', $toll_tariff_id);
		return $this->db->update('toll_tariffs', $data);
	}
	
	public function destroy($toll_tariff_id) {
		$toll_tariff = $this->get_toll_tariff($toll_tariff_id);
		$toll_tariff = $toll_tariff[0];
		$data = array(
				'status'=>'deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $toll_tariff_id);
		return $this->db->update('toll_tariffs', $data);
	}
}