<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_medias($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('title', $filename);
		}

		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_videos($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('title', $filename);
		}

		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_medias($page = "", $item_per_page = "", $lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
	public function get_published_medias_home($page = "", $item_per_page = "", $lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug != 'slider'");
		$this->db->where("albums.slug != 'infografis'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
		public function get_published_medias_mobile($page = "", $item_per_page = "", $lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug != 'bpjt-activities'");
		$this->db->where("albums.slug != 'kegiatan-bpjt'");
		$this->db->where("albums.slug != 'infografis'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_pengumuman_mobile($page = "", $item_per_page = "", $lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug = 'pengumuman'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
	public function get_published_medias_videos($page = "", $item_per_page = "", $lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
	public function get_published_slide($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("medias.album_id > 73");
		$this->db->where("medias.album_id < 76");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('id', 'desc');
		$this->db->limit(4);

		return $this->db->get()->result();
	}
	
	public function get_published_slide2($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("medias.album_id > 73");
		$this->db->where("medias.album_id < 76");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);

		return $this->db->get()->result();
	}
	
	public function get_published_slide3($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("medias.album_id > 73");
		$this->db->where("medias.album_id < 76");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(3,1);

		return $this->db->get()->result();
	}
	
	public function get_published_infografis($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug = 'infografis'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(5);

		return $this->db->get()->result();
	}

	public function get_published_infografis1($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug = 'infografis'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);

		return $this->db->get()->result();
	}
	
	public function get_published_infografis2($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where("albums.slug = 'infografis'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(3,1);

		return $this->db->get()->result();
	}
	
	public function get_published_videos($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(1);

		return $this->db->get()->result();
	}
	
	public function get_published_videos2($lang = "id") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.lang', $lang);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(3,1);

		return $this->db->get()->result();
	}

	public function get_carousel_medias($media_id, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('id !=', $media_id);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_carousel_medias_by_album_id($media_id, $album_id, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('id !=', $media_id);
		$this->db->where('album_id', $album_id);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_medias_by_album_id($album_id, $page = "", $item_per_page = "") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('album_id', $album_id);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_videos_by_album_id($album_id, $page = "", $item_per_page = "") {
		$this->db->select('medias.*, albums.name AS album_name, albums.slug AS album_slug');
		$this->db->from('medias');
		$this->db->join('albums', 'medias.album_id = albums.id', 'left');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('album_id', $album_id);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function count_medias($filename = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_videos($filename = "") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_published_medias() {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");

		return $this->db->count_all_results();
	}

	public function count_published_medias_videos() {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");

		return $this->db->count_all_results();
	}
	
	public function count_published_medias_by_album_id($album_id) {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "image"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.album_id', $album_id);

		return $this->db->count_all_results();
	}

	public function count_published_videos_by_album_id($album_id) {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where('medias.media_type = "video"');
		$this->db->where("medias.status = 'published'");
		$this->db->where('medias.album_id', $album_id);

		return $this->db->count_all_results();
	}

	public function total_page($counts, $entry) {
		$page = floor($counts / $entry);

		if ($counts % $entry > 0) {
			$page += 1;
		}

		return $page;
	}
	
	public function get_media($media_id) {
		$this->db->select('*');
		$this->db->where('id', $media_id);

		return $this->db->get('medias')->result();
	}

	public function get_media_metas($media_id) {
		$this->db->where('media_id', $media_id);

		return $this->db->get('media_metas')->result();
	}

	public function get_media_meta($media_id, $meta_key) {
		$this->db->select('meta_value');
		$this->db->where('media_id', $media_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->get('media_metas')->result();
	}

	public function get_all_media_categories() {
		$this->db->select('meta_value');
		$this->db->distinct();
		$this->db->where('meta_key = "keyword"');
		return $this->db->get('media_metas')->result();
	}

	public function gallery_image_processing($upload_dir, $filename) {
		$this->load->library('image_lib');

		list($img_width, $img_height) = getimagesize($upload_dir . '/' . $filename);
		$config['image_library'] = 'gd2';
		$config['library_path'] = $this->config->item('gd2');

		/* fx185 */
		$fx185_dir = $upload_dir . '/fx185';
		if (!is_dir($fx185_dir)) {
			mkdir($fx185_dir, 0755, true);
		}
		$config['source_image']	= $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 185;
		$config['new_image'] = $fx185_dir . '/' . $filename;
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		$config['source_image'] = $fx185_dir . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 185;
		$config['height'] = 137;
		$config['x_axis'] = 0;
		$config['y_axis'] = 0;
		unset($config['new_image']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		/* pn820 */
		$pn820_dir = $upload_dir . '/pn820';
		if (!is_dir($pn820_dir)) {
			mkdir($pn820_dir, 0755, true);
		}
		$config['source_image']	= $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 820;
		//$config['height'] = 820;
		$config['new_image'] = $pn820_dir . '/' . $filename;
		unset($config['height']);
		unset($config['x_axis']);
		unset($config['y_axis']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		/* sq57 */
		$x = $y = $size = 0;
		if($img_width>$img_height) {
			$size = $img_height;
			$x = intval(($img_width - $size)/2);
		} else {
			$size = $img_width;
			$y = intval(($img_height- $size)/2);
		}
		$sq57_dir = $upload_dir . '/sq57';
		if (!is_dir($sq57_dir)) {
			mkdir($sq57_dir, 0755, true);
		}
		$config['source_image'] = $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $size;
		$config['height'] = $size;
		$config['new_image'] = $sq57_dir . '/' . $filename;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y;
		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		$config['source_image']	= $sq57_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 57;
		$config['height'] = 57;
		unset($config['new_image']);
		unset($config['x_axis']);
		unset($config['y_axis']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();
	}

	public function content_image_processing($upload_dir, $filename) {
		$this->load->library('image_lib');

		list($img_width, $img_height) = getimagesize($upload_dir . '/' . $filename);
		$config['image_library'] = 'gd2';
		$config['library_path'] = $this->config->item('gd2');

		/* fx960 */
		$fx960_dir = $upload_dir . '/fx960';
		if (!is_dir($fx960_dir)) {
			mkdir($fx960_dir, 0755, true);
		}
		$config['source_image']	= $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 960;
		$config['new_image'] = $fx960_dir . '/' . $filename;
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		$config['source_image'] = $fx960_dir . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 960;
		$config['height'] = 299;
		$config['x_axis'] = 0;
		$config['y_axis'] = 0;
		unset($config['new_image']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		/* pn640 */
		$pn640_dir = $upload_dir . '/pn640';
		if (!is_dir($pn640_dir)) {
			mkdir($pn640_dir, 0755, true);
		}
		$config['source_image']	= $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 640;
		//$config['height'] = 820;
		$config['new_image'] = $pn640_dir . '/' . $filename;
		unset($config['height']);
		unset($config['x_axis']);
		unset($config['y_axis']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		/* sq60 */
		$x = $y = $size = 0;
		if($img_width>$img_height) {
			$size = $img_height;
			$x = intval(($img_width - $size)/2);
		} else {
			$size = $img_width;
			$y = intval(($img_height- $size)/2);
		}
		$sq60_dir = $upload_dir . '/sq60';
		if (!is_dir($sq60_dir)) {
			mkdir($sq60_dir, 0755, true);
		}
		$config['source_image'] = $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $size;
		$config['height'] = $size;
		$config['new_image'] = $sq60_dir . '/' . $filename;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y;
		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		$config['source_image']	= $sq60_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 60;
		$config['height'] = 60;
		unset($config['new_image']);
		unset($config['x_axis']);
		unset($config['y_axis']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		/* sq54 */
		$x = $y = $size = 0;
		if($img_width>$img_height) {
			$size = $img_height;
			$x = intval(($img_width - $size)/2);
		} else {
			$size = $img_width;
			$y = intval(($img_height- $size)/2);
		}
		$sq54_dir = $upload_dir . '/sq54';
		if (!is_dir($sq54_dir)) {
			mkdir($sq54_dir, 0755, true);
		}
		$config['source_image'] = $upload_dir . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $size;
		$config['height'] = $size;
		$config['new_image'] = $sq54_dir . '/' . $filename;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y;
		$this->image_lib->initialize($config);

		if (!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();

		$config['source_image']	= $sq54_dir . '/' . $filename;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 54;
		$config['height'] = 54;
		unset($config['new_image']);
		unset($config['x_axis']);
		unset($config['y_axis']);
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			exit;
		}
		$this->image_lib->clear();
	}

	public function get_image_by_style($image_url, $style) {
		$parsed = explode('/', $image_url);
		$filename = $parsed[count($parsed)-1];
		unset($parsed[count($parsed)-1]);
		$new_url = implode('/', $parsed);
		$new_url = $new_url . '/' . $style . '/' . $filename;

		return $new_url;
	}
	
	public function insert($data) {
		return $this->db->insert('medias', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('media_metas', $data);
	}

	public function update($media_id, $data) {
		$this->db->where('id', $media_id);
		return $this->db->update('medias', $data);
	}

	public function destroy($media_id) {
		$data = array('status'=>'deleted');
		$this->db->where('id', $media_id);
		return $this->db->update('medias', $data);
	}

	public function remove_meta($media_id, $meta_key) {
		$this->db->where('media_id', $media_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('media_metas');
	}
	
	public function get_galeri_kegiatan($type="6") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(9);
		return $this->db->get()->result();
	}
	
	public function get_galeri_kegiatan_1($type="6") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(3,2);
		return $this->db->get()->result();
	}
	public function get_galeri_kegiatan_2($type="6") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
		public function get_galeri_operasi($type="7") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(9);
		return $this->db->get()->result();
	}
	
	public function get_galeri_operasi_1($type="7") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(3,2);
		return $this->db->get()->result();
	}
	public function get_galeri_operasi_2($type="7") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	public function get_galeri_konstruksi($type="8") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(9);
		return $this->db->get()->result();
	}
	
	public function get_galeri_kontruksi_1($type="8") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(3,2);
		return $this->db->get()->result();
	}
	public function get_galeri_kontruksi_2($type="8") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	public function get_galeri_infografis($type="76") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(9);
		return $this->db->get()->result();
	}
	
	public function get_galeri_infografis_1($type="76") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(3,2);
		return $this->db->get()->result();
	}
	public function get_galeri_infografis_2($type="76") {
		$this->db->select('*');
		$this->db->from('medias');
		$this->db->where("status = 'published'");
		$this->db->where("album_id", $type);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	  
}
