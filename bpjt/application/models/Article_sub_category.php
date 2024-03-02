<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_Sub_Category extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_sub_categories($page = "", $item_per_page = "") {
		$this->db->select('article_sub_categories.*, article_categories.name AS category_name');
		$this->db->from('article_sub_categories');
		$this->db->join('article_categories', 'article_sub_categories.article_category_id = article_categories.id', 'left');
		$this->db->where("article_sub_categories.status != 'deleted'");
		$this->db->order_by('article_sub_categories.created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function search_sub_categories($query, $page = "", $item_per_page = "") {
		$this->db->select('article_sub_categories.*, article_categories.name AS category_name');
		$this->db->from('article_sub_categories');
		$this->db->join('article_categories', 'article_sub_categories.article_category_id = article_categories.id AND article_categories.status != "deleted"', 'left');
		$this->db->where("article_sub_categories.status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('article_sub_categories.created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_sub_categories_by_category_id($category_id) {
		$this->db->select('article_sub_categories.*, article_categories.name AS category_name');
		$this->db->from('article_sub_categories');
		$this->db->join('article_categories', 'article_sub_categories.article_category_id = article_categories.id', 'left');
		$this->db->where("article_sub_categories.article_category_id", $category_id);
		$this->db->where("article_sub_categories.status", "published");
		$this->db->order_by('article_sub_categories.created_at', 'desc');

		return $this->db->get()->result();
	}

	public function fetch_sub_categories($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_sub_categories($page, $entry);
		} else {
			return $this->search_sub_categories($query, $page, $entry);
		}
	}
	
	public function get_sub_category($sub_category_id) {
		$this->db->select('article_sub_categories.*, article_categories.name AS category_name');
		$this->db->join('article_categories', 'article_sub_categories.article_category_id = article_categories.id AND article_categories.status != "deleted"', 'left');
		$this->db->where('article_sub_categories.id', $sub_category_id);

		return $this->db->get('article_sub_categories')->result();
	}

	public function get_sub_category_by_slug($slug) {
		$this->db->select('article_sub_categories.*, article_categories.name AS category_name');
		$this->db->join('article_categories', 'article_sub_categories.article_category_id = article_categories.id AND article_categories.status != "deleted"', 'left');
		$this->db->where('slug', $slug);

		return $this->db->get('article_sub_categories')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('article_sub_categories', $data);
	}

	public function update($sub_category_id, $data) {
		$this->db->where('id', $sub_category_id);
		return $this->db->update('article_sub_categories', $data);
	}

	public function destroy($sub_category_id) {
		$sub_category = $this->get_sub_category($sub_category_id);
		$sub_category = $sub_category[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$sub_category->name . '-' . $sub_category->id . '-deleted',
			'slug'=>$sub_category->slug . '-' . $sub_category->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $sub_category_id);
		return $this->db->update('article_sub_categories', $data);
	}
	  
}
