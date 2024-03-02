<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Report extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_spm_reports($page = "", $item_per_page = "") {
		$this->db->select('spm_reports.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_reports');
		$this->db->join('toll_roads', 'spm_reports.toll_road_id = toll_roads.id', 'left');
		$this->db->order_by('spm_reports.created_at', 'desc');
		$this->db->group_by('toll_road_id, year, semester');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_spm_report_by_parameter($toll_road_id, $year, $semester) {
		$this->db->select('spm_reports.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_reports');
		$this->db->join('toll_roads', 'spm_reports.toll_road_id = toll_roads.id', 'left');
		$this->db->where('spm_reports.toll_road_id', $toll_road_id);
		$this->db->where('spm_reports.year', $year);
		$this->db->where('spm_reports.semester', $semester);
		$this->db->order_by('spm_reports.created_at', 'desc');

		return $this->db->get()->result();
	}

	public function insert($data) {
		return $this->db->insert('spm_reports', $data);
	}

	public function update($key, $year, $semester, $toll_road_id, $data) {
		$this->db->where('key', $key);
		$this->db->where('semester', $semester);
		$this->db->where('year', $year);
		$this->db->where('toll_road_id', $toll_road_id);
		return $this->db->update('spm_reports', $data);
	}

	public function destroy($toll_road_id, $year, $semester) {
		$this->db->where('semester', $semester);
		$this->db->where('year', $year);
		$this->db->where('toll_road_id', $toll_road_id);
		return $this->db->delete('spm_reports');
	}

}