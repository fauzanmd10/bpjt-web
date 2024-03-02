<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_user_accesses($page = "", $item_per_page = "") {
		$this->db->select('accesses.created_at, accesses.updated_at, user_groups.id, user_groups.name');
		$this->db->from('accesses');
		$this->db->join('user_groups', 'accesses.user_group_id = user_groups.id', 'left');
		$this->db->order_by('created_at', 'desc');
		$this->db->group_by('user_group_id');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_user_accesses_by_group($user_group_id) {
		$this->db->where('user_group_id', $user_group_id);
		return $this->db->get('accesses')->result();
	}

	public function get_user_access_by_id($user_access_id) {
		$this->db->where('id', $user_access_id);
		return $this->db->get('accessses')->result();
	}

	public function get_user_access_by_key($user_access_key, $user_group_id) {
		$this->db->where('access_key', $user_access_key);
		$this->db->where('user_group_id', $user_group_id);
		return $this->db->get('accesses')->result();
	}

	public function reorganize_accesses($accesses) {
		$new_array = array();
		foreach($accesses as $access) {
			$temp_array = array(
				'single' => $access->single,
				'add'=>$access->add,
				'edit'=>$access->edit,
				'destroy'=>$access->destroy
			);
			$new_array[$access->access_key] = $temp_array;
		}

		return $new_array;
	}

	public function insert($data) {
		return $this->db->insert('accesses', $data);
	}

	public function update($user_group_id, $data) {
		$this->db->where('id', $user_group_id);
		return $this->db->update('accesses', $data);
	}

	public function destroy($user_group_id) {
		$this->db->where('user_group_id',$user_group_id);
		return $this->db->delete('accesses');
	}
}