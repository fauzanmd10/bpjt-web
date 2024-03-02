<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Constructing_Toll_Road extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_constructing_toll_roads($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_constructing_toll_roads($page, $entry);
		} else {
			return $this->search_constructing_toll_roads($query, $page, $entry);
		}
	}
	
	public function get_constructing_toll_roads($page = "", $item_per_page = "") {
		$this->db->select('constructing_toll_roads.*, bujts.name AS bujt_name');
		$this->db->from('constructing_toll_roads');
		$this->db->join('bujts', 'constructing_toll_roads.bujt_id = bujts.id', 'left');
		$this->db->where("constructing_toll_roads.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_constructing_toll_roads($query, $page = "", $item_per_page = "") {
		$this->db->select('constructing_toll_roads.*, bujts.name AS bujt_name');
		$this->db->from('constructing_toll_roads');
		$this->db->join('bujts', 'constructing_toll_roads.bujt_id = bujts.id', 'left');
		$this->db->where("constructing_toll_roads.status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_constructing_toll_roads() {
		$this->db->select('constructing_toll_roads.*, bujts.name AS bujt_name');
		$this->db->from('constructing_toll_roads');
		$this->db->join('bujts', 'constructing_toll_roads.bujt_id = bujts.id', 'left');
		$this->db->where("constructing_toll_roads.status = 'published'");
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function get_constructing_toll_road($constructing_toll_road_id) {
		$this->db->select('constructing_toll_roads.*, bujts.name AS bujt_name');
		$this->db->from('constructing_toll_roads');
		$this->db->join('bujts', 'constructing_toll_roads.bujt_id = bujts.id', 'left');
		$this->db->where('constructing_toll_roads.id', $constructing_toll_road_id);
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('constructing_toll_roads', $data);
	}
	
	public function update($constructing_toll_road_id, $data) {
		$this->db->where('id', $constructing_toll_road_id);
		return $this->db->update('constructing_toll_roads', $data);
	}
	
	public function destroy($constructing_toll_road_id) {
		$constructing_toll_road = $this->get_constructing_toll_road($constructing_toll_road_id);
		$constructing_toll_road = $constructing_toll_road[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$constructing_toll_road->name . '-' . $constructing_toll_road->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $constructing_toll_road_id);
		return $this->db->update('constructing_toll_roads', $data);
	}
}