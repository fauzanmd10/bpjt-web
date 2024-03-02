<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Classifications extends CI_Controller {
	public $user_access;
	
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('spm_klasifikasi', $this->session->userdata('user_group_id'));
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
			'#' => 'SPM - Standar Pelayanan Minimal',
			'' => 'Klasifikasi'
		);
		
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.spm-classification.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'SPM - Klasifikasi'), true),
			'content' => $this->load->view('admin/spm_classifications/index', array('flash'=>$this->session->flashdata('spm_classifications_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('spm_classification', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'SPM - Standar Pelayanan Minimal',
			'admin/spm_classifications' => 'Klasifikasi',
			'' => 'Lihat Klasifikasi'
		);

		$classification = $this->spm_classification->get_classification($id);
		if (count($classification) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Lihat Klasifikasi'), true),
				'content' => $this->load->view('admin/spm_classifications/show', array('classification'=>$classification[0], 'flash'=>$this->session->flashdata('classification_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('spm_classification', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'SPM - Standar Pelayanan Minimal',
			'admin/spm_classifications' => 'Klasifikasi',
			'' => 'Tambah Klasifikasi'
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
		
		$stylesheets = array('admin.album.form.css');
		
		$classification = array();
		if (isset($filled_value)) {
			$classification = $filled_value;
		}
		
		$parents = $this->spm_classification->fetch_classifications("", "", null);
				
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Tambah Klasifikasi'), true),
			'content' => $this->load->view('admin/spm_classifications/add', array('classification'=>$classification, 'parents' => $parents), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('spm_classification', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Nama / Name', 'trim|callback_check_name');
			$this->form_validation->set_message('check_title', 'Minimal salah satu nama Bahasa Indonesia atau Bahasa Inggris harus terisi.');

			if ($this->form_validation->run()) {
				$parent = ($this->input->post('parent_id',true) == 0) ? null : $this->input->post('parent_id',true);
				$pos = ($this->input->post('pos_id',true) == '') ? 0 : intval($this->input->post('pos_id',true));

				if ($pos != 0) {
					do {
						$classifications = $this->spm_classification->get_classifications_by_pos_and_parentid($pos, $parent);
						if (!empty($classifications)) $pos++;
					} while(!empty($classifications));
				}
				$data_id = array(
					'name'=>$this->input->post('name_id',true),
					'description'=>$this->input->post('description_id',true),
					'parent_id' => $parent,
					'pos'=>$pos,
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->spm_classification->insert($data_id);
				$classification_id = $this->db->insert_id();

				if ($this->input->post('name_en',true) && $this->input->post('name_en',true) != "") {
					$parent = ($this->input->post('parent_en',true) == 0) ? null : $this->input->post('parent_en',true);
					$pos = ($this->input->post('pos_en',true) == '') ? 0 : intval($this->input->post('pos_en',true));

					if ($pos != 0) {
						do {
							$classifications = $this->spm_classification->get_classifications_by_pos_and_parentid($pos, $parent);
							if (!empty($classifications)) $pos++;
						} while(!empty($classifications));
					}
					$data_en = array(
						'name'=>$this->input->post('name_en',true),
						'description'=>$this->input->post('description_en',true),
						'parent_id' => $parent,
						'pos'=>$pos,
						'status'=>$this->input->post('status_en',true),
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->spm_classification->insert($data_en);
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_classifications', $classification_id, 'Pengguna menambah data klasifikasi SPM');

				$this->session->set_flashdata('classification_success', true);
				redirect('admin/spm_classifications/show/' . $classification_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('spm_classification', 'comment'));
		$this->load->helper('form');

		$parents = $this->spm_classification->fetch_classifications("", "", null);
		$classification = $this->spm_classification->get_classification($id);
		unset($parents[$id]);
				
		if (count($classification > 0)) {
			$breadcrumbs = array(
				'#' => 'SPM - Standar Pelayanan Minimal',
				'admin/spm_classifications' => 'Klasifikasi',
				'' => 'Edit Klasifikasi'
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
			$stylesheets = array('admin.album.form.css');

			if (isset($filled_value)) {
				$classification[0]->name = $filled_value['name'];
				$classification[0]->description = $filled_value['description'];
				$classification[0]->parent_id = $filled_value['parent'];
				$classification[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'Dokumen', 'title' => 'Edit Klasifikasi'), true),
				'content' => $this->load->view('admin/spm_classifications/edit', array('classification'=>$classification[0], 'id'=>$id, 'parents' => $parents), true),
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
			$this->load->model(array('spm_classification', 'user_log'));
			$this->load->library('form_validation');

			$classification = $this->spm_classification->get_classification($id);

			if (count($classification) > 0) {
				$this->form_validation->set_rules('name', 'Nama / Name', 'trim|required');
				$this->form_validation->set_message('required', 'Nama / Name harus terisi.');

				if ($this->form_validation->run()) {
					$parent = ($this->input->post('parent',true) == 0) ? null : $this->input->post('parent',true);
					$target_classification = $this->spm_classification->get_classification($this->input->post('parent',true));
					$pos = ($this->input->post('pos',true) == '') ? 0 : intval($this->input->post('pos',true));
					
					if($target_classification[0]->parent_id == $classification[0]->id) {
						$this->spm_classification->update($target_classification[0]->id, array('parent_id' => $classification[0]->parent_id));
					}

					if ($classification[0]->pos == 0) {
						if ($pos != 0) {
							do {
								$classifications = $this->spm_classification->get_classifications_by_pos_and_parentid($pos, $parent);
								if (!empty($classifications)) $pos++;
							} while(!empty($classifications));
						}
					} else {
						if ($pos != 0) {
							$classifications = $this->spm_classification->get_classifications_by_pos_and_parentid($pos, $parent);
							if (!empty($classifications)) {
								$data = array('pos'=>$classification[0]->pos);
								$this->spm_classification->update($classifications[0]->id, $data);
							}
						}
					}
					
					$data = array(
						'name' => $this->input->post('name',true),
						'description' => $this->input->post('description',true),
						'parent_id' => $parent,
						'pos'=>$pos,
						'status' => $this->input->post('status',true),
						'updated_at' => date('Y-m-d H:i:s')
					);

					$this->spm_classification->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'spm_classifications', $id, 'Pengguna mengubah data klasifikasi SPM');

					$this->session->set_flashdata('classification_success', true);
					redirect('admin/spm_classifications/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('spm_classification', 'user_log'));
		$spm_classification = $this->spm_classification->get_classification($id);
		$spm_classification = $spm_classification[0];
		if ($spm_classification->status != "deleted") {
			if ($spm_classification->status == "published") {
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

			$this->spm_classification->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'spm_classifications', $id, 'Pengguna mengubah status data klasifikasi SPM');

			$this->session->set_flashdata('spm_classifications_success', true);
			redirect('admin/spm_classifications');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('classification_ids',true)) {
			$this->load->model(array('spm_classification', 'user_log'));
			$classification_ids = $this->input->post('classification_ids',true);
			foreach($classification_ids as $classification_id) {
				$this->spm_classification->destroy($classification_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'spm_classifications', $classification_id, 'Pengguna menghapus data klasifikasi SPM');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_classification() {
		$this->load->model('spm_classification');
		$classification = $this->spm_classification->fetch_classifications("", "", null, 'tree');

		$ret_classification = array();
		$no = 1;
		if (!empty($classification['tree'])) {
			foreach($classification['tree'] as $value) {
				$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value['id'] . "\" id=\"checker-" . $value['id'] . "\" /></span></div></span>";
				$created_at = strtotime($value['created_at']);
	    		$updated_at = strtotime($value['updated_at']);

	    		if ($this->user_access->edit) {
		    		if ($value['status'] == "published") {
		    			$status = "<a href=\"" . site_url('admin/spm_classifications/update_status/' . $value['id']) . "\" class=\"album-status\" data-id=\"" . $value['id'] . "\" id=\"album-status-" . $value['id'] . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
		    		} else {
		    			$status = "<a href=\"" . site_url('admin/spm_classifications/update_status/' . $value['id']) . "\" class=\"album-status\" data-id=\"" . $value['id'] . "\" id=\"album-status-" . $value['id'] . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
		    		}
		    	} else {
		    		$status = "";
		    	}
				if(isset($value['parent_id'])) $parent = str_replace('-', '', $classification['array'][$value['parent_id']]);
				else $parent = 'root';
	    		
				$temp_class = array($checkbox, $no, $value['name'], $parent, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
				array_push($ret_classification, $temp_class);
				$no++;
			}
		}
		$json = array('aaData'=>$ret_classification);

		echo json_encode($json);
	}

	public function tree() {
		$this->load->model('spm_classification');
		$classifications = $this->spm_classification->get_parsedtree_classifications();

		echo json_encode($classifications);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_name() {
		if ($this->input->post('name',true)) {
			$title = $this->input->post('name',true);

			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else {
			$title_id = $this->input->post('name_id',true);
			$title_en = $this->input->post('name_en',true);

			if ($title_id == "" && $title_en == "") {
				return false;
			} else {
				return true;
			}
		}
	}
	
	
		
}