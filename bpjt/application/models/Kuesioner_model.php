<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

    public function get_all_question() {
		$this->db->select('*');
		$this->db->from('kuesioners');
		$this->db->where("deleted_at IS NULL");
		$this->db->order_by('sequence', 'asc');
	
		return $this->db->get()->result();
	}

	public function get_all_answer($type) {
		$this->db->select('*');
		$this->db->from('kuesioner_answers');
		$this->db->where("type = '$type'");
		$this->db->order_by('created_at', 'asc');
	
		return $this->db->get()->result();
	}
	
	public function insert_answer($data) {
		return $this->db->insert('kuesioner_answers', $data);
	}

    public function update($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('kuesioners', $data);
	}

    public function destroy($id) {
		$this->db->where('id', $id);
        $data = array(
			'deleted_at'=>date('Y-m-d H:i:s')
		);
		return $this->db->update('kuesioners', $data);
	}
	  
}
