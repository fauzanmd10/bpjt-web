<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_events($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_events($page, $entry);
		} else {
			return $this->search_events($query, $page, $entry);
		}
	}
	
	public function get_events($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('calendars');
		$this->db->where("status != 'deleted' AND (created_by = " . $this->session->userdata('user_id') . " OR invited LIKE '%" . $this->session->userdata('email') . "%')");
		$this->db->order_by('start_date', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_events_by_month_and_year($month, $year) {
		$this->db->select('*');
		$this->db->from('calendars');
		$this->db->where("status != 'deleted' AND (created_by = " . $this->session->userdata('user_id') . " OR invited LIKE '%" . $this->session->userdata('email') . "%')");
		$this->db->where('MONTH(start_date)', $month);
		$this->db->where('YEAR(start_date)', $year);
		$this->db->order_by('start_date', 'asc');
	
		return $this->db->get()->result();
	}
	
	public function search_classifications($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('calendars');
		$this->db->where("status != 'deleted'");
		$this->db->like("title", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('calendars', $data);
	}
	
	public function get_event($id) {
		$this->db->where('id', $id);
	
		return $this->db->get('calendars')->result();
	}
	
	public function update($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('calendars', $data);
	}
		
	public function destroy($id) {
		$event = $this->get_event($id);
		$event = $event[0];
		$data = array(
			'status'=>'deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		return $this->db->update('calendars', $data);
	}
}
