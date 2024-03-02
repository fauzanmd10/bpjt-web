<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Group extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_user_groups($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('user_groups');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_user_groups() {
		$this->db->where('status = "published"');
		return $this->db->get('user_groups')->result();
	}

	public function get_user_group_by_id($user_group_id) {
		$this->db->where('id', $user_group_id);
		return $this->db->get('user_groups')->result();
	}

	public function insert($data) {
		return $this->db->insert('user_groups', $data);
	}

	public function update($user_group_id, $data) {
		$this->db->where('id', $user_group_id);
		return $this->db->update('user_groups', $data);
	}

	public function destroy($user_group_id) {
		$data = array(
			'status'=>'deleted'
		);
		return $this->update($user_group_id, $data);
	}
}