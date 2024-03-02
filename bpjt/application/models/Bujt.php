<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bujt extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_bujts($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_bujts($page, $entry);
		} else {
			return $this->search_bujts($query, $page, $entry);
		}
	}
	
	public function get_bujts($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('bujts');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function search_bujts($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('bujts');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_published_bujts() {
		$this->db->select('*');
		$this->db->from('bujts');
		$this->db->where("status = 'published'");
		$this->db->order_by('created_at', 'desc');
	
		return $this->db->get()->result();
	}
	
	public function get_bujt($bujt_id) {
		$this->db->where('id', $bujt_id);
	
		return $this->db->get('bujts')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('bujts', $data);
	}
	
	public function update($bujt_id, $data) {
		$this->db->where('id', $bujt_id);
		return $this->db->update('bujts', $data);
	}
	
	public function destroy($bujt_id) {
		$bujt = $this->get_bujt($bujt_id);
		$bujt = $bujt[0];
		$data = array(
				'status'=>'deleted',
				'name'=>$bujt->name . '-' . $bujt->id . '-deleted',
				'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $bujt_id);
		return $this->db->update('bujts', $data);
	}
}