<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_Galleries extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->lang->load('id', 'indonesia');
		$lang = $this->session->userdata('lang');
		if (!empty($lang) && $lang == 'en') {
			$this->lang->load('en', 'english');
		} else {
			$this->session->set_userdata(array('lang'=>'id'));
		}
	}
	
	public function index() {
		$this->load->model(array('media', 'album', 'article'));

		$album = $this->album->get_published_albums();
		$entry = 8;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$db_medias = $this->media->get_published_medias($page, $entry, $this->session->userdata('lang'));
		$count_medias = $this->media->count_published_medias();
		$total_page = $this->media->total_page($count_medias, $entry);
		$offset = (($page-1)*$entry) + 1;
		$galleries = $this->media->get_published_medias(1, 8);

		// echo "<pre>";
		// print_r($galleries);
		// echo "</pre>";
		// exit;

		$jscripts = array();
		$stylesheets = array();
		$data = array(
			'content' => $this->load->view('photo_galleries/index-new', array('medias'=>$db_medias[0], 'count_medias'=>$count_medias, 'popular_articles'=>$this->article->get_popular_articles(3),'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page, 'album'=>$album), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$galleries
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function albums($slug) {
		$this->load->model(array('media', 'album', 'article'));

		$entry = 20;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$album = $this->album->get_album_by_slug($slug);

		if (!empty($album)) {
			$album = $album[0];
			$medias = $this->media->get_published_medias_by_album_id($album->id, $page, $entry);
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$count_medias = $this->media->count_published_medias_by_album_id($album->id);
			$total_page = $this->media->total_page($count_medias, $entry);
			$offset = (($page-1)*$entry) + 1;
			$galleries = $this->media->get_published_medias(20);

			$jscripts = array();
			$stylesheets = array();
			$data = array(
				'content' => $this->load->view('photo_galleries/index_album-new', array('medias'=>$medias, 'count_medias'=>$count_medias, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'offset'=>$offset, 'page'=>$page, 'popular_articles'=>$this->article->get_popular_articles(3), 'total_page'=>$total_page), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$galleries
			);
			$this->load->view('layouts/content-new.php', $data);
		} else {
			$this->load->view('layouts/404.php');
		}
	}

	public function show($slug, $id) {
		$this->load->model('media');
		$media = $this->media->get_media($id);

		if (!empty($media)) {
			error_reporting(E_ERROR);
			$entry = 12;
			$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
			$carousels = $this->media->get_carousel_medias($id, $page, $entry);
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$medias = $this->media->get_published_medias($page, $entry);
			$count_medias = $this->media->count_published_medias();
			$total_page = $this->media->total_page($count_medias, $entry);
			$offset = (($page-1)*$entry) + 1;
			$galleries = $this->media->get_published_medias(1, 8);

			$jscripts = array();
			$stylesheets = array();
			$data = array(
				'content' => $this->load->view('photo_galleries/show', array('media'=>$media[0], 'carousels'=>$carousels, 'medias'=>$medias, 'newstickers'=>$newstickers,  'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$galleries
			);
			$this->load->view('layouts/content.php', $data);
		} else {
			redirect('galeri');
		}
	}

	public function show_by_album($album_slug, $slug, $media_id) {
		$this->load->model(array('media', 'album', 'article'));
		$media = $this->media->get_media($media_id);

		if (!empty($media)) {
			$album = $this->album->get_album_by_slug($album_slug);
			$album = $album[0];
			$entry = 12;
			$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$carousels = $this->media->get_carousel_medias_by_album_id($media_id, $album->id, $page, $entry);
			$medias = $this->media->get_published_medias_by_album_id($album->id, $page, $entry);
			$count_medias = $this->media->count_published_medias_by_album_id($album->id);
			$total_page = $this->media->total_page($count_medias, $entry);
			$offset = (($page-1)*$entry) + 1;
			$galleries = $this->media->get_published_medias(1, 8);

			$jscripts = array();
			$stylesheets = array();
			$data = array(
				'content' => $this->load->view('photo_galleries/show_album', array('media'=>$media[0], 'album_slug'=>$album_slug, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'popular_articles'=>$this->article->get_popular_articles(3), 'carousels'=>$carousels, 'medias'=>$medias, 'offset'=>$offset, 'page'=>$page, 'total_page'=>$total_page), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$galleries
			);
			$this->load->view('layouts/content.php', $data);
		} else {
			redirect('galeri/album/' . $album_slug);
		}
	}
}