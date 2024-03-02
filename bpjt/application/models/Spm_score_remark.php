<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Score_Remark extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public $spm_classification_label;

	public function get_spm_score_remarks($page = "", $item_per_page = "") {
		$this->db->select('spm_score_remarks.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_score_remarks');
		$this->db->join('toll_roads', 'spm_score_remarks.toll_road_id = toll_roads.id');
		$this->db->where("spm_score_remarks.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_spm_score_remarks($page = "", $item_per_page = "") {
		$this->db->select('spm_score_remarks.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_score_remarks');
		$this->db->join('toll_roads', 'spm_score_remarks.toll_road_id = toll_roads.id');
		$this->db->where("spm_score_remarks.status = 'published'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_spm_score_remark($spm_score_remark_id) {
		$this->db->select('spm_score_remarks.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_score_remarks');
		$this->db->join('toll_roads', 'spm_score_remarks.toll_road_id = toll_roads.id');
		$this->db->where('spm_score_remarks.id', $spm_score_remark_id);
		return $this->db->get()->result();
	}

	public function get_spm_score_remark_by_attribute($toll_road_id, $year, $semester) {
		$this->db->select('spm_score_remarks.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_score_remarks');
		$this->db->join('toll_roads', 'spm_score_remarks.toll_road_id = toll_roads.id');
		$this->db->where('spm_score_remarks.toll_road_id', $toll_road_id);
		$this->db->where('spm_score_remarks.year', $year);
		$this->db->where('spm_score_remarks.semester', $semester);
		return $this->db->get()->result();
	}

	public function insert($data) {
		return $this->db->insert('spm_score_remarks', $data);
	}
	
	public function update($spm_score_remark_id, $data) {
		$this->db->where('id', $spm_score_remark_id);
		return $this->db->update('spm_score_remarks', $data);
	}
	
	public function destroy($spm_score_remark_id) {
		$data = array(
				'status'=>'deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $spm_score_remark_id);
		return $this->db->update('spm_score_remarks', $data);
	}
}
