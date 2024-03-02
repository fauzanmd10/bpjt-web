<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

    public function fetch_all_banner($entry, $page, $query, $type = 'array') {
		if (empty($query)) {
			$query_result = $this->get_page_banner($page, $entry);
            return $query_result;
		} else {
			return $this->search_banner($query, $page, $entry);
		}
	}
	
	public function get_page_banner($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('banners');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('judul', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

    public function search_banner($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('banners');
		$this->db->where("status != 'deleted'");
		$this->db->like("judul", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

    public function get_first_banner($banner_id) {
		$this->db->where('id', $banner_id);
	
		return $this->db->get('banners')->result();
	}

	public function get_banner($id) {
        $sql = '
            SELECT *
            FROM banners
            WHERE id = ?
            ORDER BY judul ASC
        ';
        return $this->db->query($sql, [$id])->result();
    }

	public function get_home_banner() {
		$this->db->where('status', 'aktif');
		$this->db->order_by('sequence', 'asc');
	
		return $this->db->get('banners')->result();
	}

    public function insert($data) {
		return $this->db->insert('banners', $data);
	}

    public function update($banner_id, $data) {
		$this->db->where('id', $banner_id);
		return $this->db->update('banners', $data);
	}

    public function destroy($banner_id) {
		$this->db->where('id', $banner_id);
        $data = array(
			'status'=>'deleted'
		);
		return $this->db->update('banners', $data);
	}
	  
}
