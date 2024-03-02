<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Score_Remarks extends CI_Controller {
	public $user_access;
	
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('spm_keterangan_penilaian', $this->session->userdata('user_group_id'));
		$this->user_access = $this->user_access[0];
		if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		} elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
			echo json_encode(array('status'=>'fail', 'code'=>1));
			exit;
		}
	}
	
	public function index() {
		$this->load->model('comment');

		$breadcrumbs = array(
			'#' => 'SPM',
			'' => 'Keterangan Penilaian'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.spm-score-remark.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Keterangan Penilaian'), true),
			'content' => $this->load->view('admin/spm_score_remarks/index', array('flash'=>$this->session->flashdata('spm_score_remarks_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('spm_score_remark', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_score_remarks' => 'Keterangan Penilaian',
			'' => 'Lihat Keterangan Penilaian'
		);

		$spm_score_remark = $this->spm_score_remark->get_spm_score_remark($id);
		if (!empty($spm_score_remark)) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Lihat Keterangan Penilaian'), true),
				'content' => $this->load->view('admin/spm_score_remarks/show', array('spm_score_remark'=>$spm_score_remark[0], 'flash'=>$this->session->flashdata('spm_score_remarks_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('toll_road', 'spm_score_remark', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_score_remarks' => 'Keterangan Penilaian',
			'' => 'Tambah Keterangan Penilaian'
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
			'wysiwyg.js'=>'vendor',
		);
		$stylesheets = array('admin.spm-score.form.css');
		$spm_score_remark = null;
		if (isset($filled_value)) {
			$spm_score_remark = $filled_value;
		}

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array();
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Tambah Keterangan Penilaian'), true),
			'content' => $this->load->view('admin/spm_score_remarks/add', array('spm_score_remark'=>$spm_score_remark, 'toll_roads'=>$toll_roads), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('spm_score_remark', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('classification', 'Klasifikasi', 'trim|callback_check_classification');
			$this->form_validation->set_message('check_classification', 'Klasifikasi harus terisi.');

			if ($this->form_validation->run()) {
				$data = array(
					'toll_road_id'=>$this->input->post('toll_road_id',true),
					'semester'=>$this->input->post('semester',true),
					'year'=>$this->input->post('year',true),
					'remarks_evaluation'=>$this->input->post('remarks_evaluation',true),
					'remarks_report'=>$this->input->post('remarks_report',true),
					'status'=>'published',
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->spm_score_remark->insert($data);
				$spm_score_remark_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_score_remarks', $spm_score_remark_id, 'Pengguna menambah data Keterangan Penilaian SPM');

				$this->session->set_flashdata('spm_score_remarks_success', true);
				redirect('admin/spm_score_remarks/show/' . $spm_score_remark_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('spm_classification', 'toll_road', 'spm_score_remark', 'comment'));
		$this->load->helper('form');

		$spm_score_remark = $this->spm_score_remark->get_spm_score_remark($id);

		if (!empty($spm_score_remark)) {
			$breadcrumbs = array(
				'#' => 'SPM',
				'admin/spm_score_remarks' => 'Keterangan Penilaian',
				'' => 'Ubah Keterangan Penilaian'
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
				'wysiwyg.js'=>'vendor',
			);
			$stylesheets = array('admin.sub-category.form.css');

			$spm_classification_label = "";
			if (isset($filled_value)) {
				$spm_score_remark[0]->toll_road_id = $filled_value['toll_road_id'];
				$spm_score_remark[0]->semester = $filled_value['semester'];
				$spm_score_remark[0]->year = $filled_value['year'];
				$spm_score_remark[0]->remarks_evaluation = $filled_value['remarks_evaluation'];
				$spm_score_remark[0]->remarks_report = $filled_value['remarks_report'];
			}

			$db_toll_roads = $this->toll_road->get_published_toll_roads();
			$toll_roads = array();
			foreach($db_toll_roads as $toll_road) {
				$toll_roads[$toll_road->id] = $toll_road->name;
			}			

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Ubah Keterangan Penilaian'), true),
				'content' => $this->load->view('admin/spm_score_remarks/edit', array('spm_score_remark'=>$spm_score_remark[0], 'toll_roads'=>$toll_roads, 'spm_classification_label'=>$spm_classification_label, 'id'=>$id), true),
				'jscripts' => $jscripts,
				'stylesheets' => $stylesheets,
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function update($id) {
		if ($this->input->post()) {
			$this->load->model(array('spm_score_remark', 'user_log'));
			$this->load->library('form_validation');

			$spm_score_remark = $this->spm_score_remark->get_spm_score_remark($id);

			if (!empty($spm_score_remark)) {
				$this->form_validation->set_rules('classification', 'Klasifikasi', 'trim|callback_check_classification');
				$this->form_validation->set_message('check_classification', 'Klasifikasi harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'toll_road_id'=>$this->input->post('toll_road_id',true),
						'semester'=>$this->input->post('semester',true),
						'year'=>$this->input->post('year',true),
						'remarks_evaluation'=>$this->input->post('remarks_evaluation',true),
						'remarks_report'=>$this->input->post('remarks_report',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->spm_score_remark->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'spm_score_remarks', $id, 'Pengguna mengubah data Keterangan Penilaian SPM');

					$this->session->set_flashdata('spm_score_remarks_success', true);
					redirect('admin/spm_score_remarks/show/' . $id);
				} else {
					$this->add($this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('spm_score_remark', 'user_log'));
		$spm_score_remark = $this->spm_score_remark->get_spm_score_remark($id);
		$spm_score_remark = $spm_score_remark[0];
		if ($spm_score_remark->status != "deleted") {
			if ($spm_score_remark->status == "published") {
				$data = array(
					'status'=>'draft',
					'updated_at'=>date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'status'=>'published',
					'updated_at'=>date('Y-m-d H:i:s')
				);
			}

			$this->spm_score_remark->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'spm_score_remarks', $id, 'Pengguna mengubah status data skor SPM');

			$this->session->set_flashdata('spm_score_remarks_success', true);
			redirect('admin/spm_score_remarks');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('spm_score_remark_ids',true)) {
			$this->load->model(array('spm_score_remark', 'user_log'));
			$spm_score_remark_ids = $this->input->post('spm_score_remark_ids',true);
			foreach($spm_score_remark_ids as $spm_score_remark_id) {
				$this->spm_score_remark->destroy($spm_score_remark_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_score_remarks', $spm_score_remark_id, 'Pengguna menghapus data Keterangan Penilaian SPM');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_spm_score_remarks() {
		$this->load->model('spm_score_remark');
		$spm_score_remarks = $this->spm_score_remark->get_spm_score_remarks();

		$ret_spm_score_remarks = array();
		$no = 1;
		foreach($spm_score_remarks as $spm_score_remark) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $spm_score_remark->id . "\" id=\"checker-" . $spm_score_remark->id . "\" /></span></div></span>";
			$created_at = strtotime($spm_score_remark->created_at);
    		$updated_at = strtotime($spm_score_remark->updated_at);

    		if ($this->user_access->edit) {
	    		if ($spm_score_remark->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/spm_score_remarks/update_status/' . $spm_score_remark->id) . "\" class=\"spm-score-status\" data-id=\"" . $spm_score_remark->id . "\" id=\"spm-score-status-" . $spm_score_remark->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/spm_score_remarks/update_status/' . $spm_score_remark->id) . "\" class=\"spm-score-status\" data-id=\"" . $spm_score_remark->id . "\" id=\"spm-score-status-" . $spm_score_remark->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_spm_score_remark = array($checkbox, $no, $spm_score_remark->toll_road_name, $spm_score_remark->semester, $spm_score_remark->year, $spm_score_remark->remarks_evaluation, $spm_score_remark->remarks_report, date('d M Y H:i:s', $created_at));
			array_push($ret_spm_score_remarks, $temp_spm_score_remark);
			$no++;
		}
		$json = array('aaData'=>$ret_spm_score_remarks);

		echo json_encode($json);
	}

}