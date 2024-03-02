<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public $replies;
	
	public function get_comments($page = "", $item_per_page = "") {
		$this->db->select('comments.*, articles.title AS article_title');
		$this->db->from('comments');
		$this->db->join('articles', 'comments.article_id = articles.id', 'left');
		$this->db->where("comments.status != 'deleted'");
		$this->db->order_by('comments.created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_comments_by_article_id($article_id, $page = "", $item_per_page = "") {
		$this->db->where("article_id", $article_id);
		$this->db->where("status = 'published'");
		$this->db->where("comment_id IS NULL");
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get('comments')->result();
	}

	public function get_total_unread_comments() {
		$this->db->from('comments');
		$this->db->where('read = 0');

		return $this->db->count_all_results();
	}

	public function get_replies($comment_id) {
		$this->db->where('comment_id', $comment_id);
		$this->db->where('status = "published"');
		$this->db->order_by('created_at', 'desc');

		return $this->db->get('comments')->result();
	}

	public function prepare_comments($article_id, $page = "", $item_per_page = "") {
		$comments = $this->get_comments_by_article_id($article_id, $page, $item_per_page);
		foreach($comments as &$comment) {
			$comment->replies = $this->get_replies($comment->id);
		}

		return $comments;
	}

	public function get_comment($comment_id) {
		$this->db->select('comments.*, articles.title AS article_title');
		$this->db->join('articles', 'comments.article_id = articles.id', 'left');
		$this->db->where('comments.id', $comment_id);

		return $this->db->get('comments')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('comments', $data);
	}

	public function update($comment_id, $data) {
		$this->db->where('id', $comment_id);
		return $this->db->update('comments', $data);
	}

	public function update_read_status() {
		$this->db->where('read', '0');
		return $this->db->update('comments', array('read'=>'1'));
	}

	public function destroy($comment_id) {
		$data = array(
			'status'=>'deleted'
		);
		$this->db->where('id', $comment_id);
		return $this->db->update('comments', $data);
	}
	  
}
