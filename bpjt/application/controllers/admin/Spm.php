<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm extends CI_Controller {
	public $user_access;
	
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		// $this->load->model('access');
		// $this->user_access = $this->access->get_user_access_by_key('spm_klasifikasi', $this->session->userdata('user_group_id'));
		// $this->user_access = $this->user_access[0];
		// if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
		// 	$this->session->set_flashdata('access_denied', true);
		// 	redirect('/admin/dashboard');
		// } elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
		// 	$this->session->set_flashdata('access_denied', true);
		// 	redirect('/admin/dashboard');
		// } elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
		// 	$this->session->set_flashdata('access_denied', true);
		// 	redirect('/admin/dashboard');
		// } elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
		// 	echo json_encode(array('status'=>'fail', 'code'=>1));
		// 	exit;
		// }
	}

	public function index() {
		$this->load->model(array('toll_road', 'spm_classification', 'media', 'comment'));
		$this->load->helper('form');

		// echo "<pre>";
		// print_r($headers);
		// echo "</pre>";
		// exit;

		$breadcrumbs = array(
			'#' => 'SPM - Standar Pelayanan Minimal',
			'' => 'SPM'
		);
		
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'spm.js'=>'application'
		);

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array(0=>'Pilih Ruas');
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}
		$classifications = $this->spm_classification->get_parsed_classifications();
		$db_medias = $this->media->get_published_medias(1, 8);

		$counter = 0;
		$depth = 0;
		$parent_pos = 0;
		$this->spm_classification->assign_row_number($classifications, $parent_pos);
		$this->spm_classification->count_columns($classifications, $counter);
		$this->spm_classification->count_depth($classifications, $depth);

		$headers = $this->spm_classification->get_headers($classifications);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'SPM'), true),
			'content' => $this->load->view('admin/spm/index', array('toll_roads'=>$toll_roads, 'headers'=>$headers, 'classifications'=>$classifications, 'depth'=>$depth), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function get_score() {
		$this->load->model(array('spm_score', 'spm_score_remark', 'toll_road'));

		$classifications = json_decode($this->input->get('classifications',true));
		$toll_road_id = clean_str($this->input->get('toll_road_id',true));
		$semester_id = clean_str($this->input->get('semester_id',true));
		$year_id = clean_str($this->input->get('year_id',true));
		$filtered_classifications = array();
		foreach($classifications as $classification) {
			array_push($filtered_classifications, $classification->id);
		}

		$spm_scores = $this->spm_score->get_spm_scores_by_filter($filtered_classifications, $toll_road_id, $semester_id, $year_id);
		$toll_road = $this->toll_road->get_toll_road($toll_road_id);
		$toll_road = $toll_road[0];
		$spm_score_remark = $this->spm_score_remark->get_spm_score_remark_by_attribute($toll_road_id, $year_id, $semester_id);
		$remarks_evaluation = $remarks_report = "";
		if (!empty($spm_score_remark)) {
			$spm_score_remark = $spm_score_remark[0];
			$remarks_evaluation = $spm_score_remark->remarks_evaluation;
			$remarks_report = $spm_score_remark->remarks_report;
		}

		$scores = array();
		foreach($filtered_classifications as $classification) {
			$temp_array = array();
			$temp_array['id'] = $classification;

			$found = false;
			$idx = 0;
			$score = "0";
			$score_status = 0;
			while(!$found && $idx < count($spm_scores)) {
				if ($spm_scores[$idx]->spm_classification_id == $classification) {
					$score = $spm_scores[$idx]->score;
					$score_status = $spm_scores[$idx]->score_status;
					$found = true;
				} else {
					$idx++;	
				}
				
			}

			$temp_array['score'] = $score;
			$temp_array['score_status'] = $score_status;
			array_push($scores, $temp_array);
		}
		
		$retval = array('status'=>'success', 'developer'=>(empty($toll_road->developer)) ? "-" : $toll_road->developer, 'road_length'=>(empty($toll_road->road_length)) ? "-" : $toll_road->road_length, 'remarks_evaluation'=>$remarks_evaluation, 'remarks_report'=>$remarks_report, 'scores'=>$scores);

		echo json_encode($retval);
	}

	public function spmtosession() {
		if ($this->input->post()) {
			session_start();
			$_SESSION['table_structure'] = $this->input->post('table_structure',true);

			echo json_encode(array('status'=>'success'));
		}
	}

	public function spmtopdf() {
		session_start();
		if (isset($_SESSION['table_structure'])) {
			require_once(dirname(__FILE__).'/../../libraries/WkHtmlToPdf.php');
			//$table = $_POST['table_structure'];
			$table = $_SESSION['table_structure'];

			$pdf = new WkHtmlToPdf(array('bin'=>$this->config->item('wkhtmltopdf')));
			// Add a HTML file, a HTML string or a page from a URL
			$pdf->setOptions(array(
				'orientation'=>'landscape',
				'page-size'=>'A3'
			));
			$pdf->addPage("<html>" . $table . "</html>");
			unset($_SESSION['table_structure']);

			// ... or send to client as file download
			if (!$pdf->send())
				throw new Exception('Could not create PDF: '.$pdf->getError());
		} else {
			redirect('/');
		}
	}
		
}