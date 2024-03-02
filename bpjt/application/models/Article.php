<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
		public function get_artikel_pop(){
		$this->db->select('title,viewed');
		$this->db->from('articles');
		$this->db->order_by('viewed', 'desc');
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function get_filter_articles($tahun='',$bulan='',$lang=''){
		if($tahun !=='-' and $bulan !=='-'){
			$this->db->where('SUBSTRING(created_at,1,7)=',$tahun."-".$bulan);
		}else if($tahun !=='-' and $bulan =='-'){
			$this->db->where('SUBSTRING(created_at,1,4)=',$tahun);
		}else if($tahun =='-' and $bulan !=='-'){
			$this->db->where('SUBSTRING(created_at,6,2)=',$bulan);
		}
		$this->db->where("articles.lang", $lang);
		$this->db->select('title,viewed,created_at,id'); 
		$this->db->from('articles');
		// $this->db->like("articles.title", $query);
		// $this->db->or_like("articles.content", $query);
		$this->db->order_by('viewed', 'desc');
		$this->db->limit(5);
		// print $this->db->last_query();
		return $this->db->get()->result_array();


	}
	
	public function get_articles($page = "", $item_per_page = "") {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status != 'deleted'");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_headlines4($lang = 'id') {
		$this->db->select('articles.*, article_metas.meta_value AS image, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(3,3);

		return $this->db->get()->result();
	}
	
	public function get_headlines3($lang = 'id') {
		$this->db->select('articles.*, article_metas.meta_value AS image, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(3);

		return $this->db->get()->result();
	}
	
	public function get_headlines2($lang = 'id') {
		$this->db->select('articles.*, article_metas.meta_value AS image, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);

		return $this->db->get()->result();
	}
	
	public function get_headlines($lang = 'id') {
		$this->db->select('articles.*, article_metas.meta_value AS image, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(4);

		return $this->db->get()->result();
	}

	public function get_articles_with_image($lang = "id", $page = "", $item_per_page = "") {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, article_metas.meta_value AS image_name');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
	public function get_articles_with_image2($lang = "id", $page = "", $item_per_page = "") {
		$this->db->select('articles.id, articles.title, articles.slug, articles.created_at, articles.viewed, articles.excerpt, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, article_metas.meta_value AS image_name');
		$this->db->from('articles');
		//$this->db->select('articles.id, articles.title, articles.slug, articles.created_at, articles.viewed, article_metas.meta_key');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		$this->db->where("articles.status = 'published'");
		$this->db->where("articles.lang", $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_popular_articles($entry) {
		$key = date('mY');
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, images.meta_value AS image_name, CAST(article_metas.meta_value AS UNSIGNED INTEGER) AS num_visitors');
		$this->db->from('article_metas');
		$this->db->join('articles', 'article_metas.article_id = articles.id AND lang = "' . $this->session->userdata('lang') . '"');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id');
		$this->db->join('article_metas images', 'images.article_id = articles.id AND images.meta_key = "image"', 'left');
		$this->db->where('article_metas.meta_key', 'visitor_' . $key);
		$this->db->where('articles.status', 'published');
		$this->db->order_by('num_visitors DESC');
		$this->db->limit($entry);

		return $this->db->get()->result();
	}

	public function get_related_articles($article_id, $category_id, $sub_category_id, $entry) {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, images.meta_value AS image_name');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where('articles.id !=', $article_id);
		$this->db->where('articles.article_category_id', $category_id);
		$this->db->where('articles.article_sub_category_id', $sub_category_id);
		$this->db->join('article_metas images', 'images.article_id = articles.id AND images.meta_key = "image"', 'left');
		$this->db->where('articles.status = "published"');
		$this->db->order_by('RAND()');
		$this->db->limit($entry);

		return $this->db->get()->result();
	}
	
	public function get_related_articles2($lang = "id", $category_id, $page = "", $item_per_page = "") {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, article_metas.meta_value AS image_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->join('article_metas', 'articles.id = article_metas.article_id AND meta_key = "image"', 'left');
		//$this->db->where('articles.id !=', $article_id);
		$this->db->where('articles.article_category_id', $category_id);
		//$this->db->where('articles.article_sub_category_id', $sub_category_id);
		$this->db->where("articles.lang", $lang);
		$this->db->where('articles.status = "published"');
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function search_articles($query, $lang = "", $page = "", $item_per_page = "", $publish = "published") {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id AND article_categories.status = "published"', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id AND article_sub_categories.status = "published"', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->where("articles.status", $publish);
		$this->db->where("articles.lang", $lang);
		$this->db->like("articles.title", $query);
		$this->db->or_like("articles.content", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function fetch_articles($entry, $page, $query) {
		if (empty($query)) {
			return $this->get_articles($page, $entry);
		} else {
			return $this->search_articles($query, $page, $entry);
		}
	}
	
	public function viewed_articles($id) {
		$this->db->select('*');
		//$this->db->from('articles');
		$this->db->where('articles.id', $id);
		
		$this->db->query("UPDATE articles SET viewed=viewed+1 where id='".$this->db->escape_str($id)."' OR slug='".$this->db->escape_str($id)."'");
	}

	public function count_articles() {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where("articles.status != 'deleted'");

		return $this->db->count_all_results();
	}
	

	public function count_published_articles($lang = "id") {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where("articles.status = 'published'");
		$this->db->where('articles.lang', $lang);

		return $this->db->count_all_results();
	}
	
	public function count_published_tag_articles($lang = "id", $category_id) {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where("articles.status = 'published'");
		$this->db->where('articles.lang', $lang);
		$this->db->where('articles.article_category_id', $category_id);
		
		return $this->db->count_all_results();
	}
	
	public function get_article($article_id) {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, images.meta_value AS image_name');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->join('article_metas images', 'images.article_id = articles.id AND images.meta_key = "image"', 'left');
		$this->db->where('articles.id', $article_id);

		return $this->db->get('articles')->result();
	}

	public function get_article_by_slug($slug) {
		$this->db->select('articles.*, article_categories.name AS category_name, article_sub_categories.name AS sub_category_name, users.username, images.meta_value AS image_name');
		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id', 'left');
		$this->db->join('article_sub_categories', 'articles.article_sub_category_id = article_sub_categories.id', 'left');
		$this->db->join('users', 'articles.author_id = users.id', 'left');
		$this->db->join('article_metas images', 'images.article_id = articles.id AND images.meta_key = "image"', 'left');
		$this->db->where('articles.slug', $slug);

		return $this->db->get('articles')->result();
	}

	public function get_article_metas($article_id) {
		$this->db->where('article_id', $article_id);

		return $this->db->get('article_metas')->result();
	}

	public function get_article_meta($article_id, $meta_key) {
		$this->db->where('article_id', $article_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->get('article_metas')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('articles', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('article_metas', $data);
	}

	public function update($article_id, $data) {
		$this->db->where('id', $article_id);
		return $this->db->update('articles', $data);
	}

	public function update_meta($article_meta_id, $data) {
		$this->db->where('id', $article_meta_id);
		return $this->db->update('article_metas', $data);
	}

	public function destroy($article_id) {
		$article = $this->get_article($article_id);
		$article = $article[0];
		$data = array(
			'status'=>'deleted', 
			'title'=> $article->title . '-' . $article->id . '-deleted',
			'slug'=> $article->slug . '-' . $article->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $article_id);
		return $this->db->update('articles', $data);
	}

	public function remove_meta($article_id, $meta_key) {
		$this->db->where('article_id', $article_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('article_metas');
	}
	  
}
