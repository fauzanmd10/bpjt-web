<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner2 extends CI_Controller {

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
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('layouts/kuesioner-new2', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
	

	public function infopublik() {
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('kuesioner/infopublik', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function tarif() {
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('kuesioner/tarif', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function danatalangan() {
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('kuesioner/danatalangan', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
	
	public function hasil_individu() {
		$this->load->model(array('article', 'media'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$popular_articles = $this->article->get_popular_articles(3);
			

		$data = array(
			'content' => $this->load->view('kuesioner/hasil-individu', array('popular_articles'=>$popular_articles,) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
	
	public function hasil_kelompok_masyarakat() {
		$this->load->model(array('article', 'media'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$popular_articles = $this->article->get_popular_articles(3);
			

		$data = array(
			'content' => $this->load->view('kuesioner/hasil-kelompok-masyarakat', array('popular_articles'=>$popular_articles,) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
	
	public function hasil_badan_hukum() {
		$this->load->model(array('article', 'media'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$popular_articles = $this->article->get_popular_articles(3);
			

		$data = array(
			'content' => $this->load->view('kuesioner/hasil-badan-hukum', array('popular_articles'=>$popular_articles,) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
}