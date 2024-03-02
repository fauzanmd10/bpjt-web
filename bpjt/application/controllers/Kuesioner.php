<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

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
			'content' => $this->load->view('layouts/kuesioner-new', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	function clean($string) {
		return preg_replace('/[^A-Za-z0-9\-\_]/', '', $string); // Removes special chars.
	 }

	public function save() {
		$this->load->model(array('kuesioner_model'));

		$data = [
			'type' => $this->clean($this->input->post('type')),
			'ans1' => (int)$this->input->post('ans1'),
			'ans2' => (int)$this->input->post('ans2'),
			'ans3' => (int)$this->input->post('ans3'),
			'ans4' => (int)$this->input->post('ans4'),
			'ans5' => (int)$this->input->post('ans5'),
			'ans6' => (int)$this->input->post('ans6'),
			'ans7' => (int)$this->input->post('ans7'),
			'ans8' => (int)$this->input->post('ans8'),
			'ans9' => (int)$this->input->post('ans9'),
			'ans10' => $this->clean($this->input->post('ans10')),
			'created_at' => date('Y-m-d H:i:s')
		];

		$this->kuesioner_model->insert_answer($data);

		return redirect(base_url() . 'kuesioner/'. $data['type'] .'?success=true');

	}
	
	public function kepuasan() {
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('layouts/kuesioner-kepuasan', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content.php', $data);
	}

	public function webdansosmed() {
		$this->load->model('article');
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		
		$data = array(
			'content' => $this->load->view('layouts/kuesioner-webdansosmed', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content.php', $data);
	}

	public function individu() {
		$this->load->model(array('article', 'kuesioner_model'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));

		$kuesioners = $this->kuesioner_model->get_all_question();
		$kuesioner_type = 'individu';
		
		$data = array(
			'content' => $this->load->view('kuesioner/kuesioner-new', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'kuesioners' => $kuesioners, 'kuesioner_type' => $kuesioner_type) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function kelompok_masyarakat() {
		$this->load->model(array('article', 'kuesioner_model'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));

		$kuesioners = $this->kuesioner_model->get_all_question();
		$kuesioner_type = 'kelompok_masyarakat';
		
		$data = array(
			'content' => $this->load->view('kuesioner/kuesioner-new', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'kuesioners' => $kuesioners, 'kuesioner_type' => $kuesioner_type) , true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function badan_hukum() {
		$this->load->model(array('article', 'kuesioner_model'));
		
		$jscripts = array();
		$stylesheets = array();
		
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));

		$kuesioners = $this->kuesioner_model->get_all_question();
		$kuesioner_type = 'badan_hukum';
		
		$data = array(
			'content' => $this->load->view('kuesioner/kuesioner-new', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'kuesioners' => $kuesioners, 'kuesioner_type' => $kuesioner_type) , true),
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

	public function import() {
		$this->load->model(array('kuesioner_model'));
		
		$fh = fopen('rekap_kuesioner.csv', 'r');
		$data = fread($fh, filesize('rekap_kuesioner.csv'));
		fclose($fh);

		// print_r($data);
		echo '<pre>';

		if($data){
			$datalist = explode(PHP_EOL, $data);
			if($datalist){
				foreach($datalist as $row){
					$row = explode(',', $row);
					// print_r($row);

					$data = [
						'type' => $row[0],
						'ans1' => (int)$row[1],
						'ans2' => (int)$row[2],
						'ans3' => (int)$row[3],
						'ans4' => (int)$row[4],
						'ans5' => (int)$row[5],
						'ans6' => (int)$row[6],
						'ans7' => (int)$row[7],
						'ans8' => (int)$row[8],
						'ans9' => (int)$row[9],
						'ans10' => trim(trim($row[10], '"')),
						'created_at' => '2023-' . str_pad(rand(1, 3) . '', 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28) . '', 2, '0', STR_PAD_LEFT) . ' ' . str_pad(rand(1, 23) . '', 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(1, 59) . '', 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(1, 59) . '', 2, '0', STR_PAD_LEFT)
					];

					
					print_r($data);
					$this->kuesioner_model->insert_answer($data);
				}
			}
		}
	}
}