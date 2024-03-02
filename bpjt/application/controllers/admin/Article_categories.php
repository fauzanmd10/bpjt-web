<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_Categories extends CI_Controller {
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('artikel_kategori_berita', $this->session->userdata('user_group_id'));
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
			'#' => 'Artikel',
			'' => 'Kategori'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.category.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Kategori'), true),
			'content' => $this->load->view('admin/article_categories/index', array('flash'=>$this->session->flashdata('article_categories_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('article_category', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Artikel',
			'admin/article_categories' => 'Kategori',
			'' => 'Lihat Kategori'
		);

		$category = $this->article_category->get_category($id);
		if (count($category) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Lihat Kategori'), true),
				'content' => $this->load->view('admin/article_categories/show', array('category'=>$category[0], 'flash'=>$this->session->flashdata('article_categories_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('article_category', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Artikel',
			'admin/article_categories' => 'Kategori',
			'' => 'Tambah Kategori'
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
		$stylesheets = array('admin.category.form.css');
		$category = null;
		if (isset($filled_value)) {
			$category = $filled_value;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Tambah Kategori'), true),
			'content' => $this->load->view('admin/article_categories/add', array('category'=>$category), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('article_category', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_title');
			$this->form_validation->set_message('check_title', 'Minimal salah satu judul Bahasa Indonesia atau Bahasa Inggris harus terisi.');

			if ($this->form_validation->run()) {
				if ($this->input->post('title_id',true) != "") {
					$data_id = array(
						'name'=>$this->input->post('title_id',true),
						'slug'=>$this->create_slug($this->input->post('title_id',true)),
						'status'=>$this->input->post('status_id',true),
						'lang'=>'id',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->article_category->insert($data_id);
					$category_id = $this->db->insert_id();
				}

				if ($this->input->post('title_en',true) && $this->input->post('title_en',true) != "") {
					$data_en = array(
						'name'=>$this->input->post('title_en',true),
						'slug'=>$this->create_slug($this->input->post('title_en',true)),
						'status'=>$this->input->post('status_en',true),
						'lang'=>'en',
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->article_category->insert($data_en);
					if (!isset($category_id)) {
						$category_id = $this->db->insert_id();
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'article_categories', $category_id, 'Pengguna menambah data kategori berita');

				$this->session->set_flashdata('article_categories_success', true);
				redirect('admin/article_categories/show/' . $category_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('article_category', 'comment'));
		$this->load->helper('form');

		$category = $this->article_category->get_category($id);

		if (count($category) > 0) {
			$breadcrumbs = array(
				'#' => 'Artikel',
				'admin/article_categories' => 'Kategori',
				'' => 'Ubah Kategori'
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
			$stylesheets = array('admin.category.form.css');

			if (isset($filled_value)) {
				$category[0]->name = $filled_value['title'];
				$category[0]->status = $filled_value['status'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Ubah Kategori'), true),
				'content' => $this->load->view('admin/article_categories/edit', array('category'=>$category[0], 'id'=>$id), true),
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
			$this->load->model(array('article_category', 'user_log'));
			$this->load->library('form_validation');

			$category = $this->article_category->get_category($id);

			if (count($category) > 0) {
				$this->form_validation->set_rules('title', 'Judul / Title', 'trim|required');
				$this->form_validation->set_message('required', 'Judul / Title harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'name' => $this->input->post('title',true),
						'slug'=>$this->create_slug($this->input->post('title',true)),
						'status' => $this->input->post('status',true)
					);

					$this->article_category->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'article_categories', $id, 'Pengguna mengubah data kategori berita');

					$this->session->set_flashdata('article_categories_success', true);
					redirect('admin/article_categories/show/' . $id);
				} else {
					$this->edit($id, $_POST);
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('article_category', 'user_log'));
		$article_category = $this->article_category->get_category($id);
		$article_category = $article_category[0];
		if ($article_category->status != "deleted") {
			if ($article_category->status == "published") {
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

			$this->article_category->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'article_categories', $id, 'Pengguna mengubah status data kategori berita');

			$this->session->set_flashdata('article_categories_success', true);
			redirect('admin/article_categories');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post('category_ids',true)) {
			$this->load->model(array('article_category', 'user_log'));
			$category_ids = $this->input->post('category_ids',true);
			foreach($category_ids as $category_id) {
				$this->article_category->destroy($category_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'article_categories', $category_id, 'Pengguna menghapus data kategori berita');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_categories() {
		$this->load->model('article_category');
		$categories = $this->article_category->fetch_categories("", "", null);

		$ret_categories = array();
		$no = 1;
		foreach($categories as $category) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $category->id . "\" id=\"checker-" . $category->id . "\" /></span></div></span>";
			$created_at = strtotime($category->created_at);
    		$updated_at = strtotime($category->updated_at);
    		$lang = ($category->lang == "id") ? "Indonesia" : "Inggris";

    		if ($this->user_access->edit) {
	    		if ($category->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/article_categories/update_status/' . $category->id) . "\" class=\"category-status\" data-id=\"" . $category->id . "\" id=\"category-status-" . $category->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/article_categories/update_status/' . $category->id) . "\" class=\"category-status\" data-id=\"" . $category->id . "\" id=\"category-status-" . $category->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_category = array($checkbox, $no, $category->name, $category->slug, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $lang);
			array_push($ret_categories, $temp_category);
			$no++;
		}
		$json = array('aaData'=>$ret_categories);

		echo json_encode($json);
	}

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_title() {
		if ($this->input->post('title',true)) {
			$title = $this->input->post('title',true);

			if ($title == "") {
				return false;
			} else {
				return true;
			}
		} else {
			$title_id = $this->input->post('title_id',true);
			$title_en = $this->input->post('title_en',true);

			if ($title_id == "" && $title_en == "") {
				return false;
			} else {
				return true;
			}
		}
	}
}

/* End of file article_categories.php */
/* Location: ./application/controllers/admin/article_categories.php */