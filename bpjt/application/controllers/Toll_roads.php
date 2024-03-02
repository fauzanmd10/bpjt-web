<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Roads extends CI_Controller {

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
		$this->load->model(array('toll_road', 'vehicle_group', 'article', 'media'));

		$data = $this->cache->file->get('toll_roads_data');
		if(!$data){
			$toll_roads = $this->toll_road->get_toll_roads();
			$vehicle_groups = $this->vehicle_group->get_published_vehicle_groups();
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$popular_articles = $this->article->get_popular_articles(3);
			$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
			$jscripts = array(
				'info.tarif.tol-2.js'=>'application'
			);
			$stylesheets = array();
			$data = array(
				'content' => $this->load->view('toll_roads/index-new', array('toll_roads'=>$toll_roads, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'vehicle_groups'=>$vehicle_groups, 'popular_articles'=>$popular_articles), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$db_medias
			);

			$this->cache->file->save('toll_roads_data', $data, 30);
		}

		$this->load->view('layouts/content-new.php', $data);
	}

	public function show() {
		$this->load->model(array('toll_road', 'toll_tariff', 'toll_gate', 'vehicle_group'));

		$tariffs = array();
		$toll_tariffs = $this->toll_tariff->get_published_toll_tariffs_by_toll_road_id($this->input->get('toll_road_id', TRUE));
		if (empty($toll_tariffs)) {
			$retjson = array('status'=>'fail', 'code'=>0);
		} else {
			$vehicle_groups = $this->vehicle_group->get_published_vehicle_groups();
			$groups = array();
			foreach($vehicle_groups as $group) {
				$groups[$group->id] = $group->name;
			}

			$toll_gates = $this->toll_gate->get_published_toll_gates();
			$gates = array();
			foreach($toll_gates as $gate) {
				$gates[$gate->id] = $gate->name;
			}

			foreach($toll_tariffs as $toll_tariff) {
				$tariffs[$toll_tariff->enter_toll_gate_id][$toll_tariff->exit_toll_gate_id][$toll_tariff->vehicle_group_id] = $toll_tariff->tariff;
			}

			$kepmen = "";
			$meta = $this->toll_road->get_toll_road_meta($this->input->get('toll_road_id', TRUE), 'kepmen_tarif');
			if (!empty($meta)) {
				$kepmen = $meta[0]->meta_value;
			}

			$retjson = array('status'=>'success', 'kepmen'=>$kepmen, 'toll_tariffs'=>$tariffs, 'toll_gates'=>$gates, 'vehicle_groups'=>$groups);
		}

		echo json_encode($retjson);
	}
        
        public function tarif($filled_value=null) {
		$this->load->model(array('toll_road', 'toll_tariff', 'toll_gate', 'vehicle_group', 'comment', 'media'));
		$this->load->helper('form');
                

		$breadcrumbs = array(
			'#' => 'Info Tarif Tol',
			'toll_tarif' => 'Tarif Tol',
			'' => 'Tambah Tarif Tol'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js'=>'vendor',
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			'tinymce/jquery.tinymce.js'=>'vendor',
			'wysiwyg.js'=>'vendor',
			'toll-tariff.form.js'=>'application'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'admin.album.form.css');
		//$toll_tariff = null;
		$kepmen = "";
		if (isset($filled_value)) {
			$toll_tariff = $filled_value;
			$kepmen = $filled_value['kepmen'];
		}

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array();
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}
                
                $db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$toll_gates = array();
		if (!empty($toll_roads)) {
			$db_toll_gates = $this->toll_gate->get_published_toll_gates_by_toll_road($db_toll_roads[0]->id);		
			foreach($db_toll_gates as $toll_gate) {
				$toll_gates[$toll_gate->id] = $toll_gate->name;
			}

			$toll_road_meta = $this->toll_road->get_toll_road_meta($db_toll_roads[0]->id, 'kepmen_tarif');
			if (!empty($toll_road_meta)) {
				$kepmen = $toll_road_meta[0]->meta_value;
			}
		}

		$db_vehicle_groups = $this->vehicle_group->get_published_vehicle_groups();
		$vehicle_groups = array();
		foreach($db_vehicle_groups as $vehicle_group) {
			$vehicle_groups[$vehicle_group->id] = $vehicle_group->name;
		}
                
		
                

		$data = array(
			'content' => $this->load->view('toll_roads/tarif_cek', array('toll_tariff'=>$toll_tariff, 'kepmen'=>$kepmen, 'toll_roads'=>$toll_roads, 'toll_gates'=>$toll_gates, 'vehicle_groups'=>$vehicle_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments(),
                        'galleries'=>$db_medias
		);
		$this->load->view('layouts/content_tarif.php', $data);
	}
        
}