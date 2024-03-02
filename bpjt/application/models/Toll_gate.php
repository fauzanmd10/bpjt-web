<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Gate extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_toll_gates($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_toll_gates($page, $entry);
		} else {
			return $this->search_toll_gates($query, $page, $entry);
		}
	}
	
	public function get_toll_gates($page = "", $item_per_page = "") {
		$this->db->select('toll_gates.*, toll_roads.name AS toll_road_name');
		$this->db->from('toll_gates');
		$this->db->join('toll_roads', 'toll_gates.toll_road_id = toll_roads.id AND toll_roads.status != "deleted"', 'inner');
		$this->db->where("toll_gates.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_gates($page = "", $item_per_page = "") {
		$this->db->select('toll_gates.*, toll_roads.name AS toll_road_name');
		$this->db->from('toll_gates');
		$this->db->join('toll_roads', 'toll_gates.toll_road_id = toll_roads.id', 'left');
		$this->db->where("toll_gates.status = 'published'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_gates_by_toll_road($toll_road_id, $page = "", $item_per_page = "") {
		$this->db->select('toll_gates.*, toll_roads.name AS toll_road_name');
		$this->db->from('toll_gates');
		$this->db->join('toll_roads', 'toll_gates.toll_road_id = toll_roads.id', 'left');
		$this->db->where("toll_gates.status = 'published'");
		$this->db->where("toll_gates.toll_road_id", $toll_road_id);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_toll_gates($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('toll_gates');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function get_toll_gate($toll_gate_id) {
		$this->db->select('toll_gates.*, toll_roads.name AS toll_road_name');
		$this->db->from('toll_gates');
		$this->db->join('toll_roads', 'toll_gates.toll_road_id = toll_roads.id', 'left');
		$this->db->where('toll_gates.id', $toll_gate_id);
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('toll_gates', $data);
	}
	
	public function update($toll_gate_id, $data) {
		$this->db->where('id', $toll_gate_id);
		return $this->db->update('toll_gates', $data);
	}
	
	public function destroy($toll_gate_id) {
		$toll_gate = $this->get_toll_gate($toll_gate_id);
		$toll_gate = $toll_gate[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$toll_gate->name . '-' . $toll_gate->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $toll_gate_id);
		return $this->db->update('toll_gates', $data);
	}
}