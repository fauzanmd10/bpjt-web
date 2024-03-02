<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Scores extends CI_Controller {
	public $user_access;
	
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('spm_penilaian', $this->session->userdata('user_group_id'));
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
			'' => 'Penilaian'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.spm-score.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Penilaian'), true),
			'content' => $this->load->view('admin/spm_scores/index', array('flash'=>$this->session->flashdata('spm_scores_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('spm_score', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_scores' => 'Penilaian',
			'' => 'Lihat Penilaian'
		);

		$spm_score = $this->spm_score->get_spm_score($id);
		if (!empty($spm_score)) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Lihat Penilaian'), true),
				'content' => $this->load->view('admin/spm_scores/show', array('spm_score'=>$spm_score[0], 'flash'=>$this->session->flashdata('spm_scores_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('toll_road', 'spm_score', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'SPM',
			'admin/spm_scores' => 'Penilaian',
			'' => 'Tambah Penilaian'
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
			'tree.jquery.js'=>'vendor',
			'admin.spm-score.form.js'=>'application'
		);
		$stylesheets = array('jqtree.css', 'admin.spm-score.form.css');
		$spm_score = null;
		if (isset($filled_value)) {
			$spm_score = $filled_value;
		}

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$toll_roads = array();
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Tambah Penilaian'), true),
			'content' => $this->load->view('admin/spm_scores/add', array('spm_score'=>$spm_score, 'toll_roads'=>$toll_roads), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('spm_score', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('classification', 'Klasifikasi', 'trim|callback_check_classification');
			$this->form_validation->set_message('check_classification', 'Klasifikasi harus terisi.');

			if ($this->form_validation->run()) {
				$data = array(
					'spm_classification_id'=>$this->input->post('spm_classification_id',true),
					'toll_road_id'=>$this->input->post('toll_road_id',true),
					'semester'=>$this->input->post('semester',true),
					'year'=>$this->input->post('year',true),
					'score'=>$this->input->post('score',true),
					'score_status'=>$this->input->post('score_status',true),
					'status'=>$this->input->post('status',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->spm_score->insert($data);
				$spm_score_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_scores', $spm_score_id, 'Pengguna menambah data penilaian SPM');

				$this->session->set_flashdata('spm_scores_success', true);
				redirect('admin/spm_scores/show/' . $spm_score_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('spm_classification', 'toll_road', 'spm_score', 'comment'));
		$this->load->helper('form');

		$spm_score = $this->spm_score->get_spm_score($id);

		if (!empty($spm_score)) {
			$breadcrumbs = array(
				'#' => 'SPM',
				'admin/spm_scores' => 'Penilaian',
				'' => 'Ubah Penilaian'
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
				'tree.jquery.js'=>'vendor',
				'admin.spm-score.form.js'=>'application'
			);
			$stylesheets = array('jqtree.css', 'admin.sub-category.form.css');

			$spm_classification_label = "";
			if (isset($filled_value)) {
				$spm_score[0]->spm_classification_id = $filled_value['spm_classification_id'];
				$spm_score[0]->spm_classification_name = $filled_value['spm_classification_label'];
				$spm_score[0]->toll_road_id = $filled_value['toll_road_id'];
				$spm_score[0]->semester = $filled_value['semester'];
				$spm_score[0]->year = $filled_value['year'];
				$spm_score[0]->score = $filled_value['score'];
				$spm_score[0]->score_status = $filled_value['score_status'];
				$spm_score[0]->status = $filled_value['status'];
			}

			$db_toll_roads = $this->toll_road->get_published_toll_roads();
			$toll_roads = array();
			foreach($db_toll_roads as $toll_road) {
				$toll_roads[$toll_road->id] = $toll_road->name;
			}			

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'SPM', 'title' => 'Ubah Penilaian'), true),
				'content' => $this->load->view('admin/spm_scores/edit', array('spm_score'=>$spm_score[0], 'toll_roads'=>$toll_roads, 'spm_classification_label'=>$spm_classification_label, 'id'=>$id), true),
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
			$this->load->model(array('spm_score', 'user_log'));
			$this->load->library('form_validation');

			$spm_score = $this->spm_score->get_spm_score($id);

			if (!empty($spm_score)) {
				$this->form_validation->set_rules('classification', 'Klasifikasi', 'trim|callback_check_classification');
				$this->form_validation->set_message('check_classification', 'Klasifikasi harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'spm_classification_id'=>$this->input->post('spm_classification_id',true),
						'toll_road_id'=>$this->input->post('toll_road_id',true),
						'semester'=>$this->input->post('semester',true),
						'year'=>$this->input->post('year',true),
						'score'=>$this->input->post('score',true),
						'score_status'=>$this->input->post('score_status',true),
						'status'=>$this->input->post('status',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->spm_score->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'spm_scores', $id, 'Pengguna mengubah data penilaian SPM');

					$this->session->set_flashdata('spm_scores_success', true);
					redirect('admin/spm_scores/show/' . $id);
				} else {
					$this->add($this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('spm_score', 'user_log'));
		$spm_score = $this->spm_score->get_spm_score($id);
		$spm_score = $spm_score[0];
		if ($spm_score->status != "deleted") {
			if ($spm_score->status == "published") {
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

			$this->spm_score->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'spm_scores', $id, 'Pengguna mengubah status data skor SPM');

			$this->session->set_flashdata('spm_scores_success', true);
			redirect('admin/spm_scores');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post(['spm_score_ids'])) {
			$this->load->model(array('spm_score', 'user_log'));
			$spm_score_ids = $this->input->post('spm_score_ids',true);
			foreach($spm_score_ids as $spm_score_id) {
				$this->spm_score->destroy($spm_score_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_scores', $spm_score_id, 'Pengguna menghapus data penilaian SPM');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_spm_scores() {
		$this->load->model('spm_score');
		$spm_scores = $this->spm_score->get_spm_scores();

		$ret_spm_scores = array();
		$no = 1;
		foreach($spm_scores as $spm_score) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $spm_score->id . "\" id=\"checker-" . $spm_score->id . "\" /></span></div></span>";
			$created_at = strtotime($spm_score->created_at);
    		$updated_at = strtotime($spm_score->updated_at);

    		if ($this->user_access->edit) {
	    		if ($spm_score->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/spm_scores/update_status/' . $spm_score->id) . "\" class=\"spm-score-status\" data-id=\"" . $spm_score->id . "\" id=\"spm-score-status-" . $spm_score->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/spm_scores/update_status/' . $spm_score->id) . "\" class=\"spm-score-status\" data-id=\"" . $spm_score->id . "\" id=\"spm-score-status-" . $spm_score->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_spm_score = array($checkbox, $no, $spm_score->spm_classification_name, $spm_score->toll_road_name, $spm_score->semester, $spm_score->year, $spm_score->score, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_spm_scores, $temp_spm_score);
			$no++;
		}
		$json = array('aaData'=>$ret_spm_scores);

		echo json_encode($json);
	}

	public function check_classification() {
		if ($this->input->post('spm_classification_id',true) == "") {
			return false;
		} else {
			return true;
		}
	}
}