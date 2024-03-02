<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku_tahunan extends CI_Controller {

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
			'content' => $this->load->view('layouts/booklet', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}
	
	public function buku_BPJT_2020() {

		$this->load->view('booklet/bpjt2020');
	}

	public function buku_BPJT_2022() {

		$this->load->view('booklet/bpjt2022');
	}
	
	public function buku_annual_report_bpjt_2021() {

		$this->load->view('booklet/bpjtannual2021');
	}
	
	
}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */
