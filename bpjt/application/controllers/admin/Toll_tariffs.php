<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Tariffs extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('info_tarif_tol', $this->session->userdata('user_group_id'));
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
			'#' => 'Info Tarif Tol',
			'' => 'Tarif Tol'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.toll-tariff.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'INFO TARIF TOL', 'title' => 'Tarif Tol'), true),
			'content' => $this->load->view('admin/toll_tariffs/index', array('flash'=>$this->session->flashdata('toll_tariffs_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('toll_tariff', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Info Tarif Tol',
			'admin/toll_tariffs' => 'Tarif Tol',
			'' => 'Lihat Tarif Tol'
		);

		$toll_tariff = $this->toll_tariff->get_toll_tariff($id);
		if (count($toll_tariff) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'INFO TARIF TOL', 'title' => 'Lihat Tarif Tol'), true),
				'content' => $this->load->view('admin/toll_tariffs/show', array('toll_tariff'=>$toll_tariff[0], 'flash'=>$this->session->flashdata('toll_tariff_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('toll_road', 'toll_tariff', 'toll_gate', 'vehicle_group', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Info Tarif Tol',
			'admin/toll_tariffs' => 'Tarif Tol',
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
			'admin.toll-tariff.form.js'=>'application'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'admin.album.form.css');
		$toll_tariff = null;
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
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'INFO TARIF TOL', 'title' => 'Tambah Tarif Tol'), true),
			'content' => $this->load->view('admin/toll_tariffs/add', array('toll_tariff'=>$toll_tariff, 'kepmen'=>$kepmen, 'toll_roads'=>$toll_roads, 'toll_gates'=>$toll_gates, 'vehicle_groups'=>$vehicle_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('toll_road', 'toll_tariff', 'user_log'));
			$this->load->library('form_validation');

			// $this->form_validation->set_rules('tariff', 'Tarif', 'trim|callback_check_tariff');
			$this->form_validation->set_rules('tariff_id1','Golongan 1',  'trim|callback_check_tariff1');
			$this->form_validation->set_rules('tariff_id2','Golongan 2', 'trim|callback_check_tariff2');
			$this->form_validation->set_rules('tariff_id3','Golongan 3','trim|callback_check_tariff3');
			$this->form_validation->set_rules('tariff_id4','Golongan 4','trim|callback_check_tariff4');
			$this->form_validation->set_rules('tariff_id5','Golongan 5','trim|callback_check_tariff5');
			$this->form_validation->set_message('check_tariff1', 'Tarif Golongan 1 harus diisi.');
			$this->form_validation->set_message('check_tariff2', 'Tarif Golongan 2 harus diisi.');
			$this->form_validation->set_message('check_tariff3', 'Tarif Golongan 3 harus diisi.');
			$this->form_validation->set_message('check_tariff4', 'Tarif Golongan 4 harus diisi.');
			$this->form_validation->set_message('check_tariff5', 'Tarif Golongan 5 harus diisi.');
			// echo 'masuk sini \n';
			// echo $this->input->post('tariff_id1',true);
			if ($this->form_validation->run()) {
				// die('masuk if');

				$a=array();
				for ($i=1; $i < 7 ; $i++) { 

					if($this->input->post('tariff_id'.$i,true) == ''){
						break;
					}
					$data_id = array(
						'toll_road_id'=>$this->input->post('toll_road_id',true),
						'enter_toll_gate_id'=>$this->input->post('enter_toll_gate_id',true),
						'exit_toll_gate_id'=>$this->input->post('exit_toll_gate_id',true),
						// 'vehicle_group_id'=>$this->input->post('vehicle_group_id',true)+,
						'vehicle_group_id'=>$i+1,
						'tariff'=>$this->input->post('tariff_id'.$i,true),
						'status'=>$this->input->post('status_id',true),
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					if (trim($this->input->post('kepmen',true)) != "") {
						$kepmen = $this->toll_road->get_toll_road_meta($this->input->post('toll_road_id',true), 'kepmen_tarif');
						if (empty($kepmen)) {
							$data_meta = array(
								'toll_road_id'=>$this->input->post('toll_road_id',true),
								'meta_key'=>'kepmen_tarif',
								'meta_value'=>trim($this->input->post('kepmen',true))
							);

							$this->toll_road->insert_meta($data_meta);
						} elseif (!empty($kepmen) && $kepmen[0]->meta_value != trim($this->input->post('kepmen',true))) {
							$this->toll_road->remove_meta($this->input->post('toll_road_id',true), 'kepmen_tarif');

							$data_meta = array(
								'toll_road_id'=>$this->input->post('toll_road_id',true),
								'meta_key'=>'kepmen_tarif',
								'meta_value'=>trim($this->input->post('kepmen',true))
							);

							$this->toll_road->insert_meta($data_meta);
						}
					}

					$this->toll_tariff->insert($data_id);
					$toll_tariff_id = $this->db->insert_id();

					$this->user_log->add_log($this->session->userdata('user_id'), 'toll_tariffs', $toll_tariff_id, 'Pengguna menambah data Tarif Tol');
					array_push($a,$data_id);
				}
				
				// echo "<pre>";
				// print_r ($a);
				// echo "</pre>";exit();
				
				$this->session->set_flashdata('toll_tariffs_success', true);
				redirect('admin/toll_tariffs/show/' . $toll_tariff_id);
			} else {
				// die('masuk else');

				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('toll_tariff', 'toll_road', 'toll_gate', 'vehicle_group', 'comment'));
		$this->load->helper('form');

		$toll_tariff = $this->toll_tariff->get_toll_tariff($id);

		if (count($toll_tariff) > 0) {
			$breadcrumbs = array(
				'#' => 'Info Tarif Tol',
				'admin/toll_tariffs' => 'Tarif Tol',
				'' => 'Ubah Tarif Tol'
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
				'wysiwyg.js'=>'vendor'
			);
			$stylesheets = array('bootstrap-fileupload.min.css', 'admin.album.form.css');

			$kepmen = "";
			if (isset($filled_value)) {
				$toll_tariff[0]->toll_road_id = $filled_value['toll_road_id'];
				$toll_tariff[0]->enter_toll_gate_id = $filled_value['enter_toll_gate_id'];
				$toll_tariff[0]->exit_toll_gate_id = $filled_value['exit_toll_gate_id'];
				$toll_tariff[0]->vehicle_group_id = $filled_value['vehicle_group_id'];
				$toll_tariff[0]->tariff = $filled_value['tariff'];
				$toll_tariff[0]->status = $filled_value['status'];
			}

			$db_toll_roads = $this->toll_road->get_published_toll_roads();
			$toll_roads = array();
			foreach($db_toll_roads as $toll_road) {
				$toll_roads[$toll_road->id] = $toll_road->name;
			}

			$toll_gates = array();
			if (!empty($toll_roads)) {
				$db_toll_gates = $this->toll_gate->get_published_toll_gates_by_toll_road($toll_tariff[0]->toll_road_id);		
				foreach($db_toll_gates as $toll_gate) {
					$toll_gates[$toll_gate->id] = $toll_gate->name;
				}

				$toll_road_meta = $this->toll_road->get_toll_road_meta($toll_tariff[0]->toll_road_id, 'kepmen_tarif');
				if (!empty($toll_road_meta)) {
					$kepmen = $toll_road_meta[0]->meta_value;

					if (isset($filled_value)) {
						$kepmen = $filled_value['kepmen'];
					}
				}
			}

			$db_vehicle_groups = $this->vehicle_group->get_published_vehicle_groups();
			$vehicle_groups = array();
			foreach($db_vehicle_groups as $vehicle_group) {
				$vehicle_groups[$vehicle_group->id] = $vehicle_group->name;
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'INFO TARIF TOL', 'title' => 'Ubah Tarif Tol'), true),
				'content' => $this->load->view('admin/toll_tariffs/edit', array('toll_tariff'=>$toll_tariff[0], 'kepmen'=>$kepmen, 'id'=>$id, 'toll_roads'=>$toll_roads, 'toll_gates'=>$toll_gates, 'vehicle_groups'=>$vehicle_groups), true),
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
			$this->load->model(array('toll_road', 'toll_tariff', 'user_log'));
			$this->load->library('form_validation');

			$toll_tariff = $this->toll_tariff->get_toll_tariff($id);

			if (count($toll_tariff) > 0) {
				// $this->form_validation->set_rules('tariff', 'Tarif', 'trim|callback_check_tariff');
				$this->form_validation->set_rules('tariff', 'Tarif', 'trim|required');
				$this->form_validation->set_message('check_tariff', 'Tarif harus diisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'toll_road_id'=>$this->input->post('toll_road_id',true),
						'enter_toll_gate_id'=>$this->input->post('enter_toll_gate_id',true),
						'exit_toll_gate_id'=>$this->input->post('exit_toll_gate_id',true),
						'vehicle_group_id'=>$this->input->post('vehicle_group_id',true),
						'tariff'=>$this->input->post('tariff',true),
						'status'=>$this->input->post('status',true),
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					if (trim($this->input->post('kepmen',true)) != "") {
						$kepmen = $this->toll_road->get_toll_road_meta($this->input->post('toll_road_id',true), 'kepmen_tarif');
						if (empty($kepmen)) {
							$data_meta = array(
								'toll_road_id'=>$this->input->post('toll_road_id',true),
								'meta_key'=>'kepmen_tarif',
								'meta_value'=>trim($this->input->post('kepmen',true))
							);

							$this->toll_road->insert_meta($data_meta);
						} elseif (!empty($kepmen) && $kepmen[0]->meta_value != trim($this->input->post('kepmen',true))) {
							$this->toll_road->remove_meta($this->input->post('toll_road_id',true), 'kepmen_tarif');

							$data_meta = array(
								'toll_road_id'=>$this->input->post('toll_road_id',true),
								'meta_key'=>'kepmen_tarif',
								'meta_value'=>trim($this->input->post('kepmen',true))
							);

							$this->toll_road->insert_meta($data_meta);
						}
					}

					$this->toll_tariff->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'toll_tariffs', $id, 'Pengguna mengubah data Tarif Tol');

					$this->session->set_flashdata('toll_tariffs_success', true);
					redirect('admin/toll_tariffs/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('toll_tariff', 'user_log'));
		$toll_tariff = $this->toll_tariff->get_toll_tariff($id);
		$toll_tariff = $toll_tariff[0];
		if ($toll_tariff->status != "deleted") {
			if ($toll_tariff->status == "published") {
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

			$this->toll_tariff->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'toll_tariffs', $id, 'Pengguna mengubah status data tarif tol');

			$this->session->set_flashdata('toll_tariffs_success', true);
			redirect('admin/toll_tariffs');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('toll_tariff_ids',true)) {
			$this->load->model(array('toll_tariff', 'user_log'));
			$toll_tariff_ids = $this->input->post('toll_tariff_ids',true);
			foreach($toll_tariff_ids as $toll_tariff_id) {
				$this->toll_tariff->destroy($toll_tariff_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'toll_tariffs', $toll_tariff_id, 'Pengguna menghapus data Tarif Tol');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_toll_tariffs() {
		$this->load->model('toll_tariff');
		$toll_tariffs = $this->toll_tariff->fetch_toll_tariffs("", "", null);

		$ret_toll_tariffs = array();
		$no = 1;
		foreach($toll_tariffs as $value) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";
			$created_at = strtotime($value->created_at);
    		$updated_at = strtotime($value->updated_at);

    		if ($this->user_access->edit) {
	    		if ($value->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/toll_tariffs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/toll_tariffs/update_status/' . $value->id) . "\" class=\"album-status\" data-id=\"" . $value->id . "\" id=\"album-status-" . $value->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_toll_tariff = array($checkbox, $no, $value->toll_road_name, $value->enter_toll_gate_name, $value->exit_toll_gate_name, $value->vehicle_group_name, $value->tariff, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_toll_tariffs, $temp_toll_tariff);
			$no++;
		}
		$json = array('aaData'=>$ret_toll_tariffs);

		echo json_encode($json);
	}

	public function api_get_toll_gates() {
		if (!empty($this->input->get('toll_road_id',true))) {
			$this->load->model('toll_gate');
			$toll_road_id = clean_str($this->input->get('toll_road_id',true));
			$db_toll_gates = $this->toll_gate->get_published_toll_gates_by_toll_road($toll_road_id);
			echo json_encode(array('status'=>'success', 'toll_gates'=>$db_toll_gates));
		}
	}

	public function api_get_kepmen() {
		if (!empty($this->input->get('toll_road_id',true))) {
			$this->load->model('toll_road');
			$kepmen = "";
			$meta = $this->toll_road->get_toll_road_meta(clean_str($this->input->get('toll_road_id',true)), 'kepmen_tarif');
			if (!empty($meta)) {
				$kepmen = $meta[0]->meta_value;
			}

			echo json_encode(array('status'=>'success', 'kepmen'=>$kepmen));
		}
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_tariff() {
		if ($this->input->post('tariff1',true)) {
			$title = $this->input->post('tariff1',true);
			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else if($this->input->post('tariff_id1',true)){
			$title_id = $this->input->post('tariff_id1',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}else if($this->input->post('tariff_id2',true)){
			$title_id = $this->input->post('tariff_id2',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}else if($this->input->post('tariff_id3',true)){
			$title_id = $this->input->post('tariff_id3',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}else if($this->input->post('tariff_id4',true)){
			$title_id = $this->input->post('tariff_id4',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}else if($this->input->post('tariff_id5',true)){
			$title_id = $this->input->post('tariff_id5',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		}
	}
	public function check_tariff1() {
		// if ($this->input->post('tariff1',true)) {
		// 	$title = $this->input->post('tariff1',true);
		// 	if ($title == "") {
		// 		return false;
		// 	} else {
		// 		return true;
		// 	}
		// } else if($this->input->post('tariff_id1',true)){
			$title_id = $this->input->post('tariff_id1',true);
			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		// }
	}
	public function check_tariff2() {
		// if ($this->input->post('tariff1',true)) {
		// 	$title = $this->input->post('tariff1',true);
		// 	if ($title == "") {
		// 		return false;
		// 	} else {
		// 		return true;
		// 	}
		// } else if($this->input->post('tariff_id2',true)){
			$title_id = $this->input->post('tariff_id2',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		// }
	}
	public function check_tariff3() {
		// if ($this->input->post('tariff1',true)) {
		// 	$title = $this->input->post('tariff1',true);
		// 	if ($title == "") {
		// 		return false;
		// 	} else {
		// 		return true;
		// 	}
		// } else if($this->input->post('tariff_id3',true)){
			$title_id = $this->input->post('tariff_id3',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		// }
	}
	public function check_tariff4() {
		// if ($this->input->post('tariff1',true)) {
		// 	$title = $this->input->post('tariff1',true);
		// 	if ($title == "") {
		// 		return false;
		// 	} else {
		// 		return true;
		// 	}
		// } else if($this->input->post('tariff_id4',true)){
			$title_id = $this->input->post('tariff_id4',true);

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		// }
	}
	public function check_tariff5() {
		// if ($this->input->post('tariff1',true)) {
		// 	$title = $this->input->post('tariff1',true);
		// 	if ($title == "") {
		// 		return false;
		// 	} else {
		// 		return true;
		// 	}
		// } else if($this->input->post('tariff_id5',true)){
			$title_id = $this->input->post('tariff_id5',true);
			// die('tarif 5');

			if ($title_id == "") {
				return false;
			} else {
				return true;
			}
		// }
	}

	public function check_imagetype() {
		if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_id']['type']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
        
        
}