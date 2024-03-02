<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_Category extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_categories($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('article_categories');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function search_categories($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('article_categories');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_categories_by_lang($lang) {
		$this->db->select('*');
		$this->db->from('article_categories');
		$this->db->where("status = 'published'");
		$this->db->where("lang", $lang);
		$this->db->order_by('created_at', 'desc');

		return $this->db->get()->result();
	}
	
	public function get_category($category_id) {
		$this->db->where('id', $category_id);

		return $this->db->get('article_categories')->result();
	}

	public function get_category_by_slug($slug) {
		$this->db->where('slug', $slug);

		return $this->db->get('article_categories')->result();
	}

	public function fetch_categories($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_categories($page, $entry);
		} else {
			return $this->search_categories($query, $page, $entry);
		}
	}
	
	public function insert($data) {
		return $this->db->insert('article_categories', $data);
	}

	public function update($category_id, $data) {
		$this->db->where('id', $category_id);
		return $this->db->update('article_categories', $data);
	}

	public function destroy($category_id) {
		$category = $this->get_category($category_id);
		$category = $category[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$category->name . '-' . $category->id . '-deleted',
			'slug'=>$category->slug . '-' . $category->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $category_id);
		return $this->db->update('article_categories', $data);
	}
	  
}
