<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model(array('content', 'article', 'media', 'document', 'banner_model'));

		$data = $this->cache->file->get('home_data_' . $this->session->userdata('lang'));
		if(!$data){
			$jscripts = array();
			$stylesheets = array();
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$headlines = $this->article->get_headlines($this->session->userdata('lang'));
			$headlines2 = $this->article->get_headlines2($this->session->userdata('lang'));
			$headlines3 = $this->article->get_headlines3($this->session->userdata('lang'));
			$headlines4 = $this->article->get_headlines4($this->session->userdata('lang'));
			$db_medias = $this->media->get_published_slide($this->session->userdata('lang'));
			$db_medias2 = $this->media->get_published_slide2($this->session->userdata('lang'));
			$db_medias3 = $this->media->get_published_slide3($this->session->userdata('lang'));
			$db_infografis1 = $this->media->get_published_infografis1($this->session->userdata('lang'));
			$db_infografis2 = $this->media->get_published_infografis2($this->session->userdata('lang'));
			$db_infografis = $this->media->get_published_infografis($this->session->userdata('lang'));
			$db_video = $this->media->get_published_videos($this->session->userdata('lang'));
			$db_video2 = $this->media->get_published_videos($this->session->userdata('lang'));
			$sites = $this->content->get_published_contents_by_content_type('site');
			$documents = $this->document->get_investment_opportunity();
			$galleries = $this->media->get_published_medias_home(1, 6);
			$banners = $this->banner_model->get_home_banner();

			$data = array(
				'content' => $this->load->view('home/view-index', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'documents'=>$documents, 'sites'=>$sites, 'headlines'=>$headlines, 'headlines2'=>$headlines2, 'headlines3'=>$headlines3, 'headlines4'=>$headlines4, 'db_medias'=>$db_medias, 'galleries2'=>$db_medias2, 'galleries3'=>$db_medias3, 'videos'=>$db_video, 'videos2'=>$db_video2,  'infografis2'=>$db_infografis2,  'infografis'=>$db_infografis,  'galleries'=>$galleries, 'banners'=>$banners), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts
			);
		
			$this->cache->file->save('home_data_' . $this->session->userdata('lang'), $data, 60);
		}

		$this->load->view('layouts/content-new.php', $data);
	}

	public function set_lang($lang) {
		$this->session->set_userdata(array('lang'=>$lang));

		redirect('/');
	}

	public function info() {
		phpinfo();
	}
	
	public function notfound() {
		$this->load->view('layouts/404.php');
	}
	
	public function lama() {
		$this->load->model(array('content', 'article', 'media', 'document'));

		$jscripts = array();
		$stylesheets = array();
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$headlines = $this->article->get_headlines($this->session->userdata('lang'));
		$headlines2 = $this->article->get_headlines2($this->session->userdata('lang'));
		$headlines3 = $this->article->get_headlines3($this->session->userdata('lang'));
		$headlines4 = $this->article->get_headlines4($this->session->userdata('lang'));
		$db_medias = $this->media->get_published_slide($this->session->userdata('lang'));
		$db_medias2 = $this->media->get_published_slide2($this->session->userdata('lang'));
		$db_medias3 = $this->media->get_published_slide3($this->session->userdata('lang'));
		$db_infografis1 = $this->media->get_published_infografis1($this->session->userdata('lang'));
		$db_infografis2 = $this->media->get_published_infografis2($this->session->userdata('lang'));
		$db_video = $this->media->get_published_videos($this->session->userdata('lang'));
		$db_video2 = $this->media->get_published_videos($this->session->userdata('lang'));
		$sites = $this->content->get_published_contents_by_content_type('site');
		$documents = $this->document->get_investment_opportunity();
		$galleries = $this->media->get_published_medias_home(1, 6);

		$data = array(
			'content' => $this->load->view('home/index', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'documents'=>$documents, 'sites'=>$sites, 'headlines'=>$headlines, 'headlines2'=>$headlines2, 'headlines3'=>$headlines3, 'headlines4'=>$headlines4, 'db_medias'=>$db_medias, 'galleries2'=>$db_medias2, 'galleries3'=>$db_medias3, 'videos'=>$db_video, 'videos2'=>$db_video2, 'infografis1'=>$db_infografis1, 'infografis2'=>$db_infografis2, 'galleries'=>$galleries), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content.php', $data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */