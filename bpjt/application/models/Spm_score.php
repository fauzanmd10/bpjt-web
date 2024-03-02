<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Score extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public $spm_classification_label;

	public function get_spm_scores($page = "", $item_per_page = "") {
		$this->db->select('spm_scores.*, spm_classifications.name AS spm_classification_name, toll_roads.name AS toll_road_name');
		$this->db->from('spm_scores');
		$this->db->join('spm_classifications', 'spm_scores.spm_classification_id = spm_classifications.id', 'left');
		$this->db->join('toll_roads', 'spm_scores.toll_road_id = toll_roads.id');
		$this->db->where("spm_scores.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_spm_scores($page = "", $item_per_page = "") {
		$this->db->select('spm_scores.*, spm_classifications.name AS spm_classification_name, toll_roads.name AS toll_road_name');
		$this->db->from('spm_scores');
		$this->db->join('spm_classifications', 'spm_scores.spm_classification_id = spm_classifications.id', 'left');
		$this->db->join('toll_roads', 'spm_scores.toll_road_id = toll_roads.id');
		$this->db->where("spm_scores.status = 'published'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_spm_score($spm_score_id) {
		$this->db->select('spm_scores.*, spm_classifications.name AS spm_classification_name, toll_roads.name AS toll_road_name');
		$this->db->from('spm_scores');
		$this->db->join('spm_classifications', 'spm_scores.spm_classification_id = spm_classifications.id', 'left');
		$this->db->join('toll_roads', 'spm_scores.toll_road_id = toll_roads.id');
		$this->db->where('spm_scores.id', $spm_score_id);
		return $this->db->get()->result();
	}

	public function get_spm_scores_by_filter($classifications, $toll_road_id, $semester, $year) {
		$str_class = "(spm_classification_id,";
		foreach($classifications as $value) {
			$str_class .= $value . ",";
		}
		$str_class = rtrim($str_class, ',');
		$this->db->select('spm_scores.*, toll_roads.name AS toll_road_name');
		$this->db->from('spm_scores');
		$this->db->join('toll_roads', 'spm_scores.toll_road_id = toll_roads.id', 'left');
		$this->db->where_in('spm_classification_id', $classifications);
		$this->db->where('toll_road_id', $toll_road_id);
		$this->db->where('semester', $semester);
		$this->db->where('year', $year);
		$this->db->where('spm_scores.status = "published"');

		return $this->db->get()->result();
	}

	public function insert($data) {
		return $this->db->insert('spm_scores', $data);
	}
	
	public function update($spm_score_id, $data) {
		$this->db->where('id', $spm_score_id);
		return $this->db->update('spm_scores', $data);
	}
	
	public function destroy($spm_score_id) {
		$data = array(
				'status'=>'deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $spm_score_id);
		return $this->db->update('spm_scores', $data);
	}
}
