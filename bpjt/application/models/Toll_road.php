<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Road extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_toll_roads($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_toll_roads($page, $entry);
		} else {
			return $this->search_toll_roads($query, $page, $entry);
		}
	}
	
	public function get_toll_roads($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('toll_roads');
		$this->db->where("status != 'deleted'");
		$this->db->where("status != 'draft'");
		$this->db->order_by('name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_toll_roads($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('toll_roads');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_toll_roads() {
		$this->db->select('*');
		$this->db->from('toll_roads');
		$this->db->where("status = 'published'");
		$this->db->order_by('name', 'asc');
	
		return $this->db->get()->result();
	}
	
	public function get_toll_road($road_id) {
		$this->db->where('id', $road_id);
	
		return $this->db->get('toll_roads')->result();
	}

	public function get_toll_road_metas($toll_road_id) {
		$this->db->where('toll_road_id', $toll_road_id);

		return $this->db->get('toll_road_metas')->result();
	}

	public function get_toll_road_meta($toll_road_id, $meta_key) {
		if(is_array($toll_road_id)){
			$this->db->where_in('toll_road_id', $toll_road_id);
		} else {
			$this->db->where('toll_road_id', $toll_road_id);
		}
		$this->db->where('meta_key', $meta_key);
		return $this->db->get('toll_road_metas')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('toll_roads', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('toll_road_metas', $data);
	}
	
	public function update($road_id, $data) {
		$this->db->where('id', $road_id);
		return $this->db->update('toll_roads', $data);
	}
	
	public function destroy($road_id) {
		$road = $this->get_toll_road($road_id);
		$road = $road[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$road->name . '-' . $road->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $road_id);
		return $this->db->update('toll_roads', $data);
	}

	public function remove_meta($toll_road_id, $meta_key) {
		$this->db->where('toll_road_id', $toll_road_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('toll_road_metas');
	}
}