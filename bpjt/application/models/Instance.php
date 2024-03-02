<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instance extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_instances($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('instances');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_instance($instance_id) {
		$this->db->where('id', $instance_id);
		return $this->db->get('instances')->result();
	}

	public function get_instance_by_slug($slug) {
		$this->db->where('slug', $slug);
		return $this->db->get('instances')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('instances', $data);
	}

	public function update($instance_id, $data) {
		$this->db->where('id', $instance_id);
		return $this->db->update('instances', $data);
	}

	public function destroy($instance_id) {
		$instance = $this->get_instance($instance_id);
		$instance = $instance[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$instance->name . '-' . $instance->id . '-deleted',
			'slug'=>$instance->slug . '-' . $instance->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $instance_id);
		return $this->db->update('instances', $data);
	}
	  
}
