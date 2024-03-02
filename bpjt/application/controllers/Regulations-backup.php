<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regulations extends CI_Controller {
	public $types = array(
		''=>'',
		'undang-undang'=>'Undang-Undang',
		'peraturan-pemerintah'=>'Peraturan Pemerintah',
		'peraturan-presiden'=>'Peraturan Presiden',
		'peraturan-menteri'=>'Peraturan Menteri',
		'keputusan-menteri'=>'Keputusan Menteri',
		'keputusan-kepala-bpjt'=>'Keputusan Kepala BPJT',
		'keputusan-gubernur'=>'Keputusan Gubernur',
		'lainnya'=>'Lainnya'
	);

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

	public function index($type=null) {
		$this->load->model(array('article', 'document', 'media'));
		$this->load->helper('form');

		$jscripts = array();
		$stylesheets = array();
		$query_vars = array();
		$filename = $semester = $year = "";
		$doctype = $type;
		if ($this->input->get('filename', TRUE)) {
			$query_vars['filename'] = $filename = $this->input->get('filename', TRUE);
		}
		// if (isset($_GET['semester'])) {
		// 	$query_vars['semester'] = $semester = $_GET['semester'];
		// }
		// if (isset($_GET['year'])) {
		// 	$query_vars['year'] = $year = $_GET['year'];
		// }
		if ($this->input->get('doctype', TRUE)) {
			$query_vars['doctype'] = $doctype = $this->input->get('doctype', TRUE);
		}
		$entry = 10;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$regulations = $this->document->get_published_regulations($page, $entry, $filename, $semester, $year, $doctype);
		$count_regulations = $this->document->count_published_regulations($filename, $semester, $year, $doctype);
		$total_page = floor($count_regulations/$entry);
		if ($count_regulations % $entry > 0 || $count_regulations == 0) {
			$total_page++;
		}
		$galleries = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
		
		$query_vars = http_build_query($query_vars);
		$query_vars = ($query_vars == "") ? "" : "&" . $query_vars;
		$data = array(
			'content' => $this->load->view('regulations/index-new', array('regulations'=>$regulations,  'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'content_type'=>$type, 'query_vars'=>$query_vars, 'popular_articles'=>$this->article->get_popular_articles(3), 'count_regulations'=>$count_regulations, 'page'=>$page, 'total_page'=>$total_page), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$galleries
		);
		
		$this->load->view('layouts/content-new.php', $data);
		
		//if (hash_equals($this->security->get_csrf_hash(), $this->input->get($this->security->get_csrf_token_name(), TRUE))) {
		//	// Action if the token is valid
		//	$this->load->view('layouts/content-new.php', $data);
		//} else {
		//	redirect("/");
		// Action if the token is invalid
		//}
	}

	public function show($slug) {
		$this->load->model('document');

		$regulation = $this->document->get_regulation_by_slug($slug);
		if (!empty($regulation)) {
			$regulation = $regulation[0];
			$reg_meta = $this->document->get_document_meta($regulation->id, 'view');
			if (empty($reg_meta)) {
				$data = array(
					'document_id'=>$regulation->id,
					'meta_key'=>'view',
					'meta_value'=>1
				);
				$this->document->insert_meta($data);
			} else {
				$data = array(
					'meta_value'=>intval($reg_meta[0]->meta_value)+1
				);
				$this->document->update_meta($regulation->id, $data);
			}

			redirect($regulation->url);
		} else {
			redirect('peraturan');
		}
	}
}