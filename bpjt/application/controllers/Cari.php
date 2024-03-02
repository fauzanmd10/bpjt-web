<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cari extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->lang->load('id', 'indonesia');
		$this->load->library('session');
		$this->load->helper(array('form', 'url', 'file'));

		$lang = $this->session->userdata('lang');
		if (!empty($lang) && $lang == 'en') {
			$this->lang->load('en', 'english');
		} else {
			$this->session->set_userdata(array('lang'=>'id'));
		}
	}

	public function index($type=null) {

		// echo $this->security->get_csrf_hash();
		// die();
		$this->load->model(array('article', 'document', 'media'));
		// $this->load->helper('form');
		
		
		$jscripts = array();
		$stylesheets = array();
		$query_vars = array();
		$filename = $semester = $year = $key = "";
		$doctype = $type;
		if ($this->input->get('keyword', TRUE)) {
			$query_vars['keyword'] = $filename = clean_str($this->input->get('keyword', TRUE));
		}
		if ($this->input->get('keyword', TRUE)) {
			$query_vars['keyword'] = $key = clean_str($this->input->get('keyword', TRUE));
		}
		if ($this->input->get('doctype', TRUE)) {
			$query_vars['doctype'] = $doctype = clean_str($this->input->get('doctype', TRUE));
		}
		$entry = 10;

		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$doc = ($this->input->get('doc', TRUE)) ? intval($this->input->get('doc', TRUE)) : 1;
		$found_articles = count($this->article->search_articles(clean_str($this->input->get('keyword', TRUE)), $this->session->userdata('lang')));
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$articles = $this->article->search_articles(clean_str($this->input->get('keyword', TRUE)), $this->session->userdata('lang'), $page, 15);
		$regulations = $this->document->get_published_documents($doc, $entry, $filename, $key, $semester, $year, $doctype);
		$count_regulations = $this->document->count_published_documents($filename, $key, $semester, $year, $doctype);
		$total_page = ceil($found_articles / 20);
		$total_doc = floor($count_regulations/$entry);
		if ($count_regulations % $entry > 0 || $count_regulations == 0) {
			$total_doc++;
		}
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$query_vars = http_build_query($query_vars);
		$query_vars = ($query_vars == "") ? "" : "&" . $query_vars;
		$data = array(
			'content' => $this->load->view('search/home-new', array('articles'=>$articles, 'regulations'=>$regulations,  'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3,  'content_type'=>$type, 'found_articles'=>$found_articles, 'query_vars'=>$query_vars, 'count_regulations'=>$count_regulations, 'page'=>$page, 'total_page'=>$total_page, 'doc'=>$doc, 'total_doc'=>$total_doc), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);

		if (true || hash_equals($this->security->get_csrf_hash(), $this->input->get($this->security->get_csrf_token_name(), TRUE))) {
			// Action if the token is valid
			$this->load->view('layouts/content-new.php', $data);
		} else {
			redirect("/");
		// Action if the token is invalid
		}
		
	}
}