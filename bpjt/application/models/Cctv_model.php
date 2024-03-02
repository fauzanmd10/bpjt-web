<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cctv_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

    public function fetch_all_cctv($entry, $page, $query, $type = 'array') {
		if (empty($query)) {
			$query_result = $this->get_page_cctv($page, $entry);
            return $query_result;
		} else {
			return $this->search_cctv($query, $page, $entry);
		}
	}
	
	public function get_page_cctv($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('cctv_stream_new');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('nama_ruas', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

    public function search_cctv($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('cctv_stream_new');
		$this->db->where("status != 'deleted'");
		$this->db->like("nama_ruas", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

    public function get_first_cctv($cctv_id) {
		$this->db->where('id', $cctv_id);
	
		return $this->db->get('cctv_stream_new')->result();
	}

	function get_ruas_cctv() {
        $sql = '
            SELECT DISTINCT(b.nama_ruas), b.id_ruas, b.bujt_nama,
                (SELECT COUNT(a.id) FROM cctv_stream_new as a WHERE a.nama_ruas = b.nama_ruas AND a.status = "online") as jml_cctv_online,
                (SELECT COUNT(a.id) FROM cctv_stream_new as a WHERE a.nama_ruas = b.nama_ruas AND a.status = "offline") as jml_cctv_offline
            FROM cctv_stream_new as b 
			WHERE b.status != "deleted"
            ORDER BY b.nama_ruas ASC
        ';
        return $this->db->query($sql)->result();
    }

    public function get_cctv($idruas, $status) {
        $sql = '
            SELECT a.*
            FROM cctv_stream_new as a
            WHERE a.id_ruas = ? AND a.status = ?
            ORDER BY a.sequence, a.nama_cctv ASC
        ';
        return $this->db->query($sql, [$idruas, $status])->result();
    }

    public function insert($data) {
		return $this->db->insert('cctv_stream_new', $data);
	}

    public function update($cctv_id, $data) {
		$this->db->where('id', $cctv_id);
		return $this->db->update('cctv_stream_new', $data);
	}

    public function destroy($cctv_id) {
		$this->db->where('id', $cctv_id);
        $data = array(
			'status'=>'deleted'
		);
		return $this->db->update('cctv_stream_new', $data);
	}
	  
}
