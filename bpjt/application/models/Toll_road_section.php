<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Road_Section extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_toll_road_sections($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_toll_road_sections($page, $entry);
		} else {
			return $this->search_toll_road_sections($query, $page, $entry);
		}
	}
	
	public function get_toll_road_sections($page = "", $item_per_page = "") {
		$this->db->select('toll_road_sections.*, constructing_toll_roads.name AS constructing_toll_road_name');
		$this->db->from('toll_road_sections');
		$this->db->join('constructing_toll_roads', 'toll_road_sections.constructing_toll_road_id = constructing_toll_roads.id AND constructing_toll_roads.status != "deleted"', 'inner');
		$this->db->where("toll_road_sections.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_toll_road_sections($query, $page = "", $item_per_page = "") {
		$this->db->select('toll_road_sections.*, constructing_toll_roads.name AS constructing_toll_road_name');
		$this->db->from('toll_road_sections');
		$this->db->join('constructing_toll_roads', 'toll_road_sections.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->where("toll_road_sections.status != 'deleted'");
		$this->db->like("toll_road_sections.name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_road_sections() {
		$this->db->select('toll_road_sections.*, constructing_toll_roads.name AS constructing_toll_road_name');
		$this->db->from('toll_road_sections');
		$this->db->join('constructing_toll_roads', 'toll_road_sections.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->where("toll_road_sections.status = 'published'");
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function get_toll_road_section($toll_road_section_id) {
		$this->db->select('toll_road_sections.*, constructing_toll_roads.name AS constructing_toll_road_name');
		$this->db->from('toll_road_sections');
		$this->db->join('constructing_toll_roads', 'toll_road_sections.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->where('toll_road_sections.id', $toll_road_section_id);
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}

	public function get_toll_road_section_by_constructing_toll_road_id($constructing_toll_road_id) {
		$this->db->select('toll_road_sections.*, constructing_toll_roads.name AS constructing_toll_road_name');
		$this->db->from('toll_road_sections');
		$this->db->join('constructing_toll_roads', 'toll_road_sections.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->where('toll_road_sections.constructing_toll_road_id', $constructing_toll_road_id);
		$this->db->where("toll_road_sections.status = 'published'");
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('toll_road_sections', $data);
	}
	
	public function update($toll_road_section_id, $data) {
		$this->db->where('id', $toll_road_section_id);
		return $this->db->update('toll_road_sections', $data);
	}
	
	public function destroy($toll_road_section_id) {
		$toll_road_section = $this->get_toll_road_section($toll_road_section_id);
		$toll_road_section = $toll_road_section[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$toll_road_section->name . '-' . $toll_road_section->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $toll_road_section_id);
		return $this->db->update('toll_road_sections', $data);
	}
}