<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Reports extends CI_Controller {
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		// $this->load->model('access');
		// $this->user_access = $this->access->get_user_access_by_key('artikel_pengumuman', $this->session->userdata('user_group_id'));
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
		$this->load->model('comment');

		$breadcrumbs = array(
			'#' => 'SPM',
			'' => 'Laporan SPM'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.spm-report.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Laporan SPM'), true),
			'content' => $this->load->view('admin/spm_reports/index', null, true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($toll_road_id, $year, $semester) {
		$this->load->model(array('spm_report', 'toll_road', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_reports' => 'Laporan SPM',
			'' => 'Lihat Laporan SPM'
		);

		$toll_road = $this->toll_road->get_toll_road($toll_road_id);
		$db_spm_reports = $this->spm_report->get_spm_report_by_parameter($toll_road_id, $year, $semester);
		$spm_reports = array();
		foreach($db_spm_reports as $spm_report) {
			$spm_reports[$spm_report->key]['condition'] = $spm_report->condition;
			$spm_reports[$spm_report->key]['remarks'] = $spm_report->remarks;
		}
		
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Lihat Kategori'), true),
			'content' => $this->load->view('admin/spm_reports/show', array('spm_reports'=>$spm_reports, 'toll_road'=>$toll_road, 'year'=>$year, 'semester'=>$semester, 'flash'=>$this->session->flashdata('spm_report_success')), true),
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function add($filled_value=null) {
		$this->load->model(array('spm_report', 'toll_road', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_reports' => 'Laporan SPM',
			'' => 'Tambah Laporan SPM'
		);
		$jscripts = array(
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			'tinymce/jquery.tinymce.js'=>'vendor',
			'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('admin.spm-report.form.css');
		$spm_report = null;
		if (isset($filled_value)) {
			$spm_report = $filled_value;
		}

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array();
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Tambah Laporan SPM'), true),
			'content' => $this->load->view('admin/spm_reports/add', array('spm_report'=>$spm_report, 'toll_roads'=>$toll_roads), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('spm_report', 'user_log'));
			$this->load->library('form_validation');
			
			$toll_road_id = $year = $semester = "";
			$created_at = date('Y-m-d H:i:s');
			foreach($this->input->post() as $key => $value) {
				if ($key == 'toll_road_id') {
					$toll_road_id = $value;
				} elseif ($key == 'semester') {
					$semester = $value;
				} elseif ($key == 'year') {
					$year = $value;
				} else {
					$data = array(
						'key' => $key,
						'toll_road_id' => $toll_road_id,
						'year' => $year,
						'semester' => $semester,
						'condition' => $value['kondisi'],
						'remarks' => $value['keterangan'],
						'created_at' => $created_at,
						'updated_at' => $created_at
					);

					$this->spm_report->insert($data);
					$spm_report_id = $this->db->insert_id();
				}
			}

			$this->session->set_flashdata('spm_report_success', true);
			$this->user_log->add_log($this->session->userdata('user_id'), 'spm_reports', $spm_report_id, 'Pengguna menambahkan data laporan SPM');

			redirect('admin/spm_reports/show/' . $toll_road_id . '/' . $year . '/' . $semester);
		}
	}

	public function edit($toll_road_id, $year, $semester, $filled_value=null) {
		$this->load->model(array('spm_report', 'toll_road', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_reports' => 'Laporan SPM',
			'' => 'Tambah Laporan SPM'
		);
		$jscripts = array(
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			'tinymce/jquery.tinymce.js'=>'vendor',
			'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('admin.spm-report.form.css');
		$db_spm_reports = $this->spm_report->get_spm_report_by_parameter($toll_road_id, $year, $semester);

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array();
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}

		if (!empty($db_spm_reports)) {
			$spm_reports = array();
			foreach($db_spm_reports as $spm_report) {
				$spm_reports[$spm_report->key]['condition'] = $spm_report->condition;
				$spm_reports[$spm_report->key]['remarks'] = $spm_report->remarks;
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Ubah Kategori'), true),
				'content' => $this->load->view('admin/spm_reports/edit', array('spm_reports'=>$spm_reports, 'toll_road_id'=>$toll_road_id, 'year'=>$year, 'semester'=>$semester, 'toll_roads'=>$toll_roads), true),
				'jscripts' => $jscripts,
				'stylesheets' => $stylesheets,
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function update($toll_road_id, $year, $semester) {
		if ($this->input->post()) {
			$this->load->model(array('spm_report', 'user_log'));
			$this->load->library('form_validation');

			$updated_at = date('Y-m-d H:i:s');
			$db_spm_reports = $this->spm_report->get_spm_report_by_parameter($toll_road_id, $year, $semester);

			if (!empty($db_spm_reports)) {
				foreach($this->input->post() as $key => $value) {
					$data = array(
						'condition' => $value['kondisi'],
						'remarks' => $value['keterangan'],
						'updated_at' => $updated_at
					);

					$this->spm_report->update($key, $year, $semester, $toll_road_id, $data);
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_reports', $toll_road_id, 'Pengguna mengubah data laporan SPM');

				$this->session->set_flashdata('spm_report_success', true);
				redirect('admin/spm_reports/show/' . $toll_road_id . '/' . $year . '/' . $semester);
			} else {
				redirect('admin');
			}
		}
	}

	public function destroy() {
		if ($this->input->post('spm_report_ids',true)) {
			$this->load->model(array('spm_report', 'user_log'));
			$spm_report_ids = $this->input->post('spm_report_ids',true);
			foreach($spm_report_ids as $spm_report_id) {
				$ids = explode('/', $spm_report_id);
				$this->spm_report->destroy($ids[0], $ids[1], $ids[2]);
				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_reports', $ids[0], 'Pengguna menghapus data laporan SPM');
			}
			
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_spm_reports() {
		$this->load->model('spm_report');
		$spm_reports = $this->spm_report->get_spm_reports();

		$ret_spm_reports = array();
		$no = 1;
		foreach($spm_reports as $spm_report) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $spm_report->toll_road_id . "/" . $spm_report->year . "/" . $spm_report->semester . "\" id=\"checker-" . $spm_report->id . "\" /></span></div></span>";
			$created_at = strtotime($spm_report->created_at);
			$temp_spm_report = array($checkbox, $no, $spm_report->toll_road_name, $spm_report->year, $spm_report->semester, date('d M Y H:i:s', $created_at));
			array_push($ret_spm_reports, $temp_spm_report);
			$no++;
		}
		$json = array('aaData'=>$ret_spm_reports);

		echo json_encode($json);
	}

}
