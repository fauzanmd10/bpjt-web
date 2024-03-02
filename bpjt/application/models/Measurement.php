<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Measurement extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_measurements($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('measurements');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_measurement($measurement_id) {
		$this->db->where('id', $measurement_id);
		return $this->db->get('measurements')->result();
	}

	public function get_measurement_by_slug($slug) {
		$this->db->where('slug', $slug);
		return $this->db->get('measurements')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('measurements', $data);
	}

	public function update($measurement_id, $data) {
		$this->db->where('id', $measurement_id);
		return $this->db->update('measurements', $data);
	}

	public function destroy($measurement_id) {
		$measurement = $this->get_measurement($measurement_id);
		$measurement = $measurement[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$measurement->name . '-' . $measurement->id . '-deleted',
			'slug'=>$measurement->slug . '-' . $measurement->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $measurement_id);
		return $this->db->update('measurements', $data);
	}
	  
}
