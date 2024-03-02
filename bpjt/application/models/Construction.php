<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Construction extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_constructions($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_constructions($page, $entry);
		} else {
			return $this->search_constructions($query, $page, $entry);
		}
	}
	
	public function get_constructions($page = "", $item_per_page = "") {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_constructions($query, $page = "", $item_per_page = "") {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.status != 'deleted'");
		$this->db->like("constructions.name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_constructions() {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.status = 'published'");
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function get_construction($construction_id) {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.id", $construction_id);
	
		return $this->db->get()->result();
	}

	public function get_constructions_by_time($year, $month, $week) {
		if ($week > 4) $week = 4;
		
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.year", $year);
		$this->db->where("constructions.month", $month);
		$this->db->where("constructions.week", $week);
		$this->db->where("constructions.status = 'published'");

		return $this->db->get()->result();
	}

	public function get_construction_by_year($year, $toll_road_id="") {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.year", $year);
		if (!empty($toll_road_id)) {
			$this->db->where("constructions.constructing_toll_road_id", $toll_road_id);
		}
		$this->db->where("constructions.status = 'published'");

		return $this->db->get()->result();
	}

	public function get_construction_by_toll_and_time($constructing_toll_road_id, $year, $month, $week) {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name, toll_road_sections.road_length AS toll_road_section_road_length');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.constructing_toll_road_id", $constructing_toll_road_id);
		$this->db->where("constructions.year", $year);
		$this->db->where("constructions.month", $month);
		$this->db->where("constructions.week", $week);
		$this->db->where("constructions.status = 'published'");

		return $this->db->get()->result();
	}

	public function get_construction_by_section_and_time($toll_road_section_id, $year, $month, $week) {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.toll_road_section_id", $toll_road_section_id);
		$this->db->where("constructions.year", $year);
		$this->db->where("constructions.month", $month);
		$this->db->where("constructions.week", $week);
		$this->db->where("constructions.status = 'published'");

		return $this->db->get()->result();
	}

	public function get_latest_construction_by_section($toll_road_section_id) {
		$this->db->select('constructions.*, constructing_toll_roads.name AS toll_road_name, toll_road_sections.name AS toll_road_section_name, toll_road_sections.road_length AS toll_road_section_road_length');
		$this->db->from('constructions');
		$this->db->join('constructing_toll_roads', 'constructions.constructing_toll_road_id = constructing_toll_roads.id', 'left');
		$this->db->join('toll_road_sections', 'constructions.toll_road_section_id = toll_road_sections.id', 'left');
		$this->db->where("constructions.toll_road_section_id", $toll_road_section_id);
		$this->db->where("constructions.status = 'published'");
		$this->db->order_by('constructions.year DESC, constructions.month DESC, constructions.week DESC');
		$this->db->limit(1);

		return $this->db->get()->result();
	}

	public function get_latest_data() {
		$this->db->where('status = "published"');
		$this->db->limit(1);
		$this->db->order_by('year DESC, month DESC, week DESC');

		return $this->db->get('constructions')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('constructions', $data);
	}
	
	public function update($construction_id, $data) {
		$this->db->where('id', $construction_id);
		return $this->db->update('constructions', $data);
	}
	
	public function destroy($construction_id) {
		$construction = $this->get_construction($construction_id);
		$construction = $construction[0];
		$data = array(
				'status'=>'deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $construction_id);
		return $this->db->update('constructions', $data);
	}
}