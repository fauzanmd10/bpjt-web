<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public $time_collection = array(
		'00:00:00' => '12:00 AM',
		'00:30:00' => '12:30 AM',
		'01:00:00' => '01:00 AM',
		'01:30:00' => '01:30 AM',
		'02:00:00' => '02:00 AM',
		'02:30:00' => '02:30 AM',
		'03:00:00' => '03:00 AM',
		'03:30:00' => '03:30 AM',
		'04:00:00' => '04:00 AM',
		'04:30:00' => '04:30 AM',
		'05:00:00' => '05:00 AM',
		'05:30:00' => '05:30 AM',
		'06:00:00' => '06:00 AM',
		'06:30:00' => '06:30 AM',
		'07:00:00' => '07:00 AM',
		'07:30:00' => '07:30 AM',
		'08:00:00' => '08:00 AM',
		'08:30:00' => '08:30 AM',
		'09:00:00' => '09:00 AM',
		'09:30:00' => '09:30 AM',
		'10:00:00' => '10:00 AM',
		'10:30:00' => '10:30 AM',
		'11:00:00' => '11:00 AM',
		'11:30:00' => '11:30 AM',
		'12:00:00' => '12:00 PM',
		'12:30:00' => '12:30 PM',
		'13:00:00' => '01:00 PM',
		'13:30:00' => '01:30 PM',
		'14:00:00' => '02:00 PM',
		'14:30:00' => '02:30 PM',
		'15:00:00' => '03:00 PM',
		'15:30:00' => '03:30 PM',
		'16:00:00' => '04:00 PM',
		'16:30:00' => '04:30 PM',
		'17:00:00' => '05:00 PM',
		'17:30:00' => '05:30 PM',
		'18:00:00' => '06:00 PM',
		'18:30:00' => '06:30 PM',
		'19:00:00' => '07:00 PM',
		'19:30:00' => '07:30 PM',
		'20:00:00' => '08:00 PM',
		'20:30:00' => '08:30 PM',
		'21:00:00' => '09:00 PM',
		'21:30:00' => '09:30 PM',
		'22:00:00' => '10:00 PM',
		'22:30:00' => '10:30 PM',
		'23:00:00' => '11:00 PM',
		'23:30:00' => '11:30 PM',
	);
	
	public $months = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

	public function __construct() {
		parent::__construct();
		$this->load->model('article');
		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
	}

	public function index() {
		$this->load->model(array('comment', 'calendar'));
		
		$this->load->model('media');
		$this->load->model('document');
		$breadcrumbs = array(
			'' => 'Dashboard'
		);
		$count_artikel_id=$this->article->count_articles('id');
		$count_artikel_en=$this->article->count_articles('en');
		$count_galeri=$this->media->count_medias();
		$count_regulations=$this->document->count_regulations();
		
		//echo $count_artikel."<br>".$count_galeri."<br>".$count_regulations;
		// print_r($pop);
		// die();
		$events = $this->calendar->get_events_by_month_and_year(date('n'), date('Y'));  
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle'=>'Feature Aplikasi', 'title'=>'Dashboard'), true),
			'content' => $this->load->view('admin/dashboard/index', array('events'=>$events, 'flash'=>$this->session->flashdata('access_denied'),'ca'=>$count_artikel_id,'ce'=>$count_artikel_en,'cg'=>$count_galeri,'cr'=>$count_regulations), true),
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}
	public function tampil_data($tahun='',$bulan='',$id=''){
		
		$filter_artikel=$this->article->get_filter_articles($tahun,$bulan,$id);
		echo json_encode($filter_artikel);
	}
	public function detail_artikel($id=''){
		
		$detail_artikel=$this->article->get_article($id);
		echo json_encode($detail_artikel);
	}
	public function tes(){
		echo "asdasd";
	}

	public function bidang_umum() {
		$this->load->model(array('comment', 'calendar'));

		$breadcrumbs = array(
			'/admin/dashboard' => 'Dashboard',
			'' => 'Bidang Umum'
		);
		
		$events = $this->calendar->get_events_by_month_and_year(date('n'), date('Y'));
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle'=>'Feature Aplikasi', 'title'=>'Bidang Umum'), true),
			'content' => $this->load->view('admin/dashboard/bidang_umum', array('events'=>$events, 'flash'=>$this->session->flashdata('access_denied')), true),
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function progress_konstruksi() {
		$this->load->model(array('comment', 'construction', 'calendar'));

		$breadcrumbs = array(
			'/admin/dashboard' => 'Dashboard',
			'' => 'Progres Konstruksi'
		);

		$events = $this->calendar->get_events_by_month_and_year(date('n'), date('Y'));
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.dashboard-construction.index.js'=>'application'
		);
		
		$months = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$latest_data = $this->construction->get_latest_data();
		$year = "-";
		$month = "-";
		$week = "-";
		if (!empty($latest_data)) {
			$latest_data = $latest_data[0];
			$year = $latest_data->year;
			$month = $months[$latest_data->month];
			$week = $latest_data->week;
			// $year = date('Y');
			// $month = $months[date('n')];
			// $week = intval(date('j')) / 7;
			// $week = ($week > 4) ? 4 : $week;
		}
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle'=>'Feature Aplikasi', 'title'=>'Progres Konstruksi'), true),
			'content' => $this->load->view('admin/dashboard/progress_konstruksi', array('events'=>$events, 'year'=>$year, 'month'=>$month, 'week'=>$week, 'flash'=>$this->session->flashdata('access_denied')), true),
			'unread_comments' => $this->comment->get_total_unread_comments(),
			'jscripts' => $jscripts,
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function api_get_current_constructions() {
		$this->load->model(array('construction', 'toll_road_section', 'constructing_toll_road'));
		
		/* get latest year, month, and week */
		$latest_data = $this->construction->get_latest_data();
		$ret_constructions = array();
		if (!empty($latest_data)) {
			$latest_data = $latest_data[0];
			$year = $latest_data->year;
			$month = $latest_data->month;
			$week = $latest_data->week;
			// $year = date('Y');
			// $month = date('n');
			// $week = intval(date('j')) / 7;
			// $week = ($week > 4) ? 4 : $week;

			/* get toll roads */
			$constructing_toll_roads = $this->constructing_toll_road->get_published_constructing_toll_roads();
			if (!empty($constructing_toll_roads)) {
				$no = 1;
				foreach($constructing_toll_roads as $constructing_toll_road) {
					/* get segments */
					$segments = $this->toll_road_section->get_toll_road_section_by_constructing_toll_road_id($constructing_toll_road->id);
					if (!empty($segments)) {
						$total_plan = 0;
						$total_realisation = 0;
						$total_deviation = 0;
						$temp_array = array();

						foreach($segments as $segment) {
							$construction = $this->construction->get_latest_construction_by_section($segment->id);
							if (!empty($construction)) {
								$construction = $construction[0];

								$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $construction->id . "\" id=\"checker-" . $construction->id . "\" /></span></div></span>";
								$created_at = strtotime($construction->created_at);
					    		$updated_at = strtotime($construction->updated_at);

					    		if ($construction->year != $year || $construction->month != $month || $construction->week != $week) {
					    			$temp_construction = array($checkbox, "", "<div style='padding-left:10px'>" . $construction->toll_road_section_name . "</div>", $construction->toll_road_section_road_length, $construction->plan, $construction->realisation, $construction->deviation, "Minggu ke " . $construction->week . " bulan " . $this->months[$construction->month]);
					    		} else {
						    		$temp_construction = array($checkbox, "", "<div style='padding-left:10px'>" . $construction->toll_road_section_name . "</div>", $construction->toll_road_section_road_length, $construction->plan, $construction->realisation, $construction->deviation, "Minggu ke " . $construction->week . " bulan " . $this->months[$construction->month]);
						    	}
								array_push($temp_array, $temp_construction);

								$total_plan += floatval($construction->plan) / 100 * $construction->toll_road_section_road_length;
								$total_realisation += floatval($construction->realisation) / 100 * $construction->toll_road_section_road_length;
								$total_deviation += floatval($construction->deviation) / 100 * $construction->toll_road_section_road_length;
							}
						}

						$toll_road_plan = ($constructing_toll_road->road_length == 0) ? 0 : ($total_plan / $constructing_toll_road->road_length) * 100;
						$toll_road_realisation = ($constructing_toll_road->road_length == 0) ? 0 : ($total_realisation / $constructing_toll_road->road_length) * 100;
						$toll_road_deviation = ($constructing_toll_road->road_length == 0) ? 0 : ($total_deviation / $constructing_toll_road->road_length) * 100;

						$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $constructing_toll_road->id . "\" id=\"checker-" . $constructing_toll_road->id . "\" /></span></div></span>";
						$created_at = strtotime($constructing_toll_road->created_at);
			    		$updated_at = strtotime($constructing_toll_road->updated_at);
						$temp_toll_road_array = array($checkbox, $no, "<strong>" . $constructing_toll_road->name . "</strong>", $constructing_toll_road->road_length, number_format($toll_road_plan, 2, '.', ','), number_format($toll_road_realisation, 2, '.', ','), number_format($toll_road_deviation, 2, '.', ','), "");
						array_push($ret_constructions, $temp_toll_road_array);
						foreach($temp_array as $value) {
							array_push($ret_constructions, $value);
						}

						$no++;
					}
				}
			}
		}

		$json = array('aaData'=>$ret_constructions);

		echo json_encode($json);
	}

	public function get_calendars() {
		$this->load->model('calendar');
		$events = $this->calendar->get_events_by_month_and_year($this->input->post('month',true), $this->input->post('year',true));
		$ret_events = array();

		foreach($events as $key => $value) {
			$start_date = explode(' ', $value->start_date);
			$start_date = explode('-', $start_date[0]);
			array_push($ret_events, $start_date[1] . '/' . $start_date[2] . '/' . $start_date[0]);
		}

		echo json_encode(array('status'=>'success', 'dates'=>$ret_events));
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */