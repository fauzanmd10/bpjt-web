<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitor extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_visitor($type, $parent_id) {
		$current_date = date('Y-m-d');
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$visitor = $this->get_visitor_by_cookie($_SERVER['HTTP_COOKIE'], $current_date, $type, $parent_id);
			$cookie = $_SERVER['HTTP_COOKIE'];
		} else {
			$visitor = null;
			$cookie = '';
		}

		if (empty($visitor)) {
			$uid = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $current_date . $cookie);
			$visitor = $this->get_visitor_by_uid($uid, $current_date, $type, $parent_id);

			if (empty($visitor)) {
				$new_data = array(
					'type'=>$type,
					'parent_id'=>$parent_id,
					'uid'=>$uid,
					'cookie'=>$cookie,
					'ip_address'=>$_SERVER['REMOTE_ADDR'],
					'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
					'created_at'=>date('Y-m-d H:i:s')
				);

				if ($this->insert($new_data)) {
					if ($type == "articles") {
						$this->load->model('article');
						$key = date('mY');
						$visitor = $this->article->get_article_meta($parent_id, 'visitor_' . $key);

						if (empty($visitor)) {
							$new_data = array(
								'article_id'=>$parent_id,
								'meta_key'=>'visitor_' . $key,
								'meta_value'=>'1'
							);

							$this->article->insert_meta($new_data);
						} else {
							$update_data = array(
								'meta_value'=>intval($visitor[0]->meta_value)+1
							);

							$this->article->update_meta($visitor[0]->id, $update_data);
						}
					}
				}
			}
		}
	}

	public function get_visitor_by_cookie($cookie, $date, $type, $parent_id) {
		$this->db->where('cookie', $cookie);
		$this->db->where('DATE(created_at)', $date);
		$this->db->where('type', $type);
		$this->db->where('parent_id', $parent_id);

		return $this->db->get('visitors')->result();
	}

	public function get_visitor_by_uid($uid, $date, $type, $parent_id) {
		$this->db->where('uid', $uid);
		$this->db->where('DATE(created_at)', $date);
		$this->db->where('type', $type);
		$this->db->where('parent_id', $parent_id);

		return $this->db->get('visitors')->result();
	}

	public function insert($data) {
		return $this->db->insert('visitors', $data);
	}

}