<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_contents($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('contents');
		$this->db->where("contents.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_contents_by_content_type($content_type) {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where("contents.status != 'deleted'");

		return $this->db->get('contents')->result();
	}

	public function get_published_contents_by_content_type($content_type, $lang="id") {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where('lang', $lang);
		$this->db->where("contents.status = 'published'");

		return $this->db->get('contents')->result();
	}
	
	public function get_published_contents_by_content_type_news1($content_type, $lang="id") {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where('lang', $lang);
		$this->db->where("contents.status = 'published'");
		$this->db->order_by('updated_at', 'desc');
		$this->db->limit(1);

		return $this->db->get('contents')->result();
	}
	
	public function get_published_contents_by_content_type_news2($content_type, $lang="id") {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where('lang', $lang);
		$this->db->order_by('updated_at', 'desc');
		$this->db->where("contents.status = 'published'");
		$this->db->limit(3,1);

		return $this->db->get('contents')->result();
	}
	
	public function get_content($content_id) {
		$this->db->select('*');
		$this->db->where('id', $content_id);

		return $this->db->get('contents')->result();
	}

	public function get_content_by_slug($slug) {
		$this->db->select('contents.*, content_metas.meta_value AS image_name');
		$this->db->from('contents');
		$this->db->join('content_metas', 'content_metas.content_id = contents.id AND content_metas.meta_key = "image"', 'left');
		$this->db->where('slug', $slug);

		return $this->db->get()->result();
	}

	public function get_content_by_paths($content_type, $sub_content_type) {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where('sub_content_type', $sub_content_type);
		$this->db->where("status IN ('published', 'draft')");

		return $this->db->get('contents')->result();	
	}

	public function get_content_by_paths_and_lang($content_type, $sub_content_type, $lang) {
		$this->db->select('*');
		$this->db->where('content_type', $content_type);
		$this->db->where('sub_content_type', $sub_content_type);
		$this->db->where('lang', $lang);

		return $this->db->get('contents')->result();	
	}

	public function get_content_metas($content_id) {
		$this->db->where('content_id', $content_id);

		return $this->db->get('content_metas')->result();
	}

	public function get_content_meta($content_id, $meta_key) {
		$this->db->select('meta_value');
		$this->db->where('content_id', $content_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->get('content_metas')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('contents', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('content_metas', $data);
	}

	public function update($content_id, $data) {
		$this->db->where('id', $content_id);
		return $this->db->update('contents', $data);
	}

	public function update_by_slug($slug, $type, $data) {
		$this->db->where('slug', $slug);
		return $this->db->update('contents', $data);	
	}

	public function destroy($content_id) {
		$content = $this->get_content($content_id);
		$content = $content[0];
		$data = array(
			'status'=>'deleted',
			'title'=>$content->title . '-' . $content->id . '-deleted',
			'slug'=>$content->slug . '-' . $content->id
		);
		$this->db->where('id', $content_id);
		return $this->db->update('contents', $data);
	}

	public function remove_meta($content_id, $meta_key) {
		$this->db->where('content_id', $content_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('content_metas');
	}
	  
}
