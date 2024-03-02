<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
		$this->load->model(array('article', 'media'));

		$jscripts = array();
		$stylesheets = array();

		$page = (isset($this->input->get('page', TRUE))) ? intval($this->input->get('page', TRUE)) : 1;
		$found_articles = count($this->article->search_articles(clean_str($this->input->get('page', TRUE)), $this->session->userdata('lang')));
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$articles = $this->article->search_articles(clean_str($this->input->get('page', TRUE)), $this->session->userdata('lang'), $page, 15);
		$total_page = ceil($found_articles / 15);
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$data = array(
			'content' => $this->load->view('search/index', array('articles'=>$articles,  'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'popular_articles'=>$this->article->get_popular_articles(3), 'found_articles'=>$found_articles, 'page'=>$page, 'total_page'=>$total_page), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content.php', $data);
	}
}