<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_albums($page = "", $item_per_page = "", $type = "photo") {
		$this->db->select('*');
		$this->db->from('albums');
		$this->db->where("status != 'deleted'");
		$this->db->where("type", $type);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_albums($lang="id", $type="photo", $with_order=true) {
		$this->db->select('*');
		$this->db->from('albums');
		$this->db->where("status = 'published'");
		$this->db->where("type", $type);
		if ($lang == "id" || $lang == "en") {
			$this->db->where("lang", $lang);
		}

		if ($with_order) {
			$this->db->order_by('created_at', 'desc');
		}

		return $this->db->get()->result();
	}
	
	public function get_published_albums_noslider($lang="id", $type="photo", $with_order=true) {
		$this->db->select('*');
		$this->db->from('albums');
		$this->db->where("status = 'published'");
		$this->db->where("name != 'slider'");
		$this->db->where("type", $type);
		if ($lang == "id" || $lang == "en") {
			$this->db->where("lang", $lang);
		}

		if ($with_order) {
			$this->db->order_by('created_at', 'desc');
		}

		return $this->db->get()->result();
	}

	public function search_albums($query, $page = "", $item_per_page = "", $type = "photo") {
		$this->db->select('*');
		$this->db->from('albums');
		$this->db->where("status != 'deleted'");
		$this->db->where("type", $type);
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_albums_by_lang($lang, $type="photo") {
		$this->db->select('*');
		$this->db->from('albums');
		$this->db->where("status = 'published'");
		$this->db->where("lang", $lang);
		$this->db->where("type", $type);
		$this->db->order_by('created_at', 'desc');

		return $this->db->get()->result();
	}
	
	public function get_album($album_id) {
		$this->db->where('id', $album_id);
		return $this->db->get('albums')->result();
	}

	public function get_album_by_slug($slug, $type="photo") {
		$this->db->where('slug', $slug);
		$this->db->where('type', $type);

		return $this->db->get('albums')->result();
	}

	public function fetch_albums($entry, $page, $query, $type="photo") {
		if (empty($query)) {
			return $this->get_albums($page, $entry, $type);
		} else {
			return $this->search_albums($query, $page, $entry, $type);
		}
	}
	
	public function insert($data) {
		return $this->db->insert('albums', $data);
	}

	public function update($album_id, $data) {
		$this->db->where('id', $album_id);
		return $this->db->update('albums', $data);
	}

	public function destroy($album_id) {
		$album = $this->get_album($album_id);
		$album = $album[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$album->name . '-' . $album->id . '-deleted',
			'slug'=>$album->slug . '-' . $album->id,
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $album_id);
		return $this->db->update('albums', $data);
	}
}