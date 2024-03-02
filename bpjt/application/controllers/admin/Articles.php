<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {
    // if ($mime == 'application/pdf' || $mime == 'application/msword' || $mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mime == 'application/vnd.ms-excel' || $mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('artikel_berita', $this->session->userdata('user_group_id'));
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
			'' => 'Berita'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'ckeditor/ckeditor.js'=>'vendor',
			'admin.article.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'ARTIKEL', 'title' => 'Berita'), true),
			'content' => $this->load->view('admin/articles/index', array('flash'=>$this->session->flashdata('article_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		// die('tes');

		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('article', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Artikel',
			'admin/articles' => 'Berita',
			'' => 'Lihat Berita'
		);
		$article = $this->article->get_article($id);

		if (count($article) > 0) {
			$keywords_meta = $this->article->get_article_meta($article[0]->id, 'keyword');
			$allow_comment_meta = $this->article->get_article_meta($article[0]->id, 'allow_comment');
			$video_meta = $this->article->get_article_meta($article[0]->id, 'video');

			$keywords = $allow_comment = $video = "";
			if (!empty($keywords_meta)) {
				foreach($keywords_meta as $keyword) {
					$keywords .= $keyword->meta_value . ", ";
				}

				$keywords = rtrim($keywords, ", ");
			}

			if (!empty($allow_comment_meta)) {
				if ($allow_comment_meta[0]->meta_value == "allowed") {
					$allow_comment = '1';
				} else {
					$allow_comment = '0';
				}
			}

			if (!empty($video_meta)) {
				$video = $video_meta[0]->meta_value;
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'ARTIKEL', 'title' => 'Lihat Berita'), true),
				'content' => $this->load->view('admin/articles/show', array('article'=>$article[0], 'keywords'=>$keywords, 'video'=>$video, 'allow_comment'=>$allow_comment, 'flash'=>$this->session->flashdata('article_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('article', 'article_category', 'article_sub_category', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Artikel',
			'admin/articles' => 'Berita',
			'' => 'Tambah Berita'
		);
		$jscripts = array(
			'bootstrap-fileupload.min.js'=>'vendor',
			'bootstrap-timepicker.min.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.validate.min.js'=>'vendor',
			'jquery.tagsinput.min.js'=>'vendor',
			'jquery.autogrow-textarea.js'=>'vendor',
			'charCount.js'=>'vendor',
			'ui.spinner.min.js'=>'vendor',
			'chosen.jquery.min.js'=>'vendor',
			'forms.js'=>'vendor',
			//'tinymce/jquery.tinymce.js'=>'vendor',
			'ckeditor/ckeditor.js'=>'vendor',
			//'ckfinder.js'=>'vendor',
			'bootstrap-datepicker.js'=>'vendor',
			'admin.article.form.js'=>'application'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.article.form.css', 'datepicker.css');

		$category_ids = array();
		$sub_category_ids = array();
		$category_ens = array();
		$sub_category_ens = array();
		$article = null;
		if ($filled_value) {
			$article = $filled_value;
		}

		$categories = $this->article_category->get_categories_by_lang("id");
		if (count($categories) > 0) {
			$sub_categories = $this->article_sub_category->get_sub_categories_by_category_id($categories[0]->id);

			foreach($sub_categories as $sub_category) {
				$sub_category_ids[$sub_category->id] = $sub_category->name;
			}

			if (count($sub_category_ids) == 0) {
				$sub_category_ids['0'] = "Pilih Sub Kategori";	
			}
		} else {
			$sub_category_ids['0'] = "Pilih Sub Kategori";
		}

		foreach($categories as $category) {
			$category_ids[$category->id] = $category->name;
		}

		$categories = $this->article_category->get_categories_by_lang("en");
		if (count($categories) > 0) {
			$sub_categories = $this->article_sub_category->get_sub_categories_by_category_id($categories[0]->id);

			foreach($sub_categories as $sub_category) {
				$sub_category_ens[$sub_category->id] = $sub_category->name;
			}

			if (count($sub_category_ens) == 0) {
				$sub_category_ens['0'] = "Select Sub Category";	
			}
		} else {
			$sub_category_ens['0'] = 'Select Sub Category';
		}
		foreach($categories as $category) {
			$category_ens[$category->id] = $category->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'ARTIKEL', 'title' => 'Berita'), true),
			'content' => $this->load->view('admin/articles/add', array('article'=>$article, 'category_ids'=>$category_ids, 'category_ens'=>$category_ens, 'sub_category_ids'=>$sub_category_ids, 'sub_category_ens'=>$sub_category_ens), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {
			$this->load->model(array('article', 'user_log', 'media'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title_category_sub_category_content', '', 'trim|callback_check_required');
			$this->form_validation->set_rules('en_title_category_sub_category_content', '', 'trim|callback_check_en_required');
			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_title');
			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_existing_title');
			$this->form_validation->set_rules('category', 'Kategori / Category', 'trim|callback_check_category');
			$this->form_validation->set_rules('sub_category', 'Sub Kategori / Sub Category', 'trim|callback_check_sub_category');
			$this->form_validation->set_rules('content', 'Konten / Content', 'trim|callback_check_content');
			$this->form_validation->set_rules('excerpt', 'Pengantar / Introduction', 'trim|callback_check_excerpt');
			$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_imagetype');
			$this->form_validation->set_message('check_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_en_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Inggris juga harus terisi');
			$this->form_validation->set_message('check_title', 'Minimal salah satu judul Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_existing_title', 'Judul yang Anda masukkan sudah terlebih dahulu terdaftar di dalam basis data.');
			$this->form_validation->set_message('check_category', 'Minimal salah satu kategori Bahasa Indonesia atau Bahasa Inggris harus terpilih.');
			$this->form_validation->set_message('check_sub_category', 'Minimal salah satu kategori Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_content', 'Minimal salah satu konten Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_excerpt', 'Minimal salah satu pengantar Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_imagetype', 'Silakan ganti image karena tipe image tidak dikenal.');

			if ($this->form_validation->run()) {
				$ffmpeg = $this->config->item('ffmpeg');
				$options = '-an -y -f mjpeg -ss 2 -s 640x264 -vframes 1 ';

				if ($this->input->post('title_id',true) != '') {
					$data_article = array(
						'title'=>$this->input->post('title_id',true),
						'content'=>$this->input->post('content_id',true),
						'slug'=>$this->create_slug($this->input->post('title_id',true)),
						'article_category_id'=>$this->input->post('category_id',true),
						'article_sub_category_id'=>$this->input->post('sub_category_id',true),
						'excerpt'=>$this->input->post('excerpt_id',true),
						'author_id'=>'1',
						'lang'=>'id',
						'status'=>$this->input->post('status_id',true),
						'created_at'=>$this->input->post('tgl_id',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->article->insert($data_article);
					$article_id = $this->db->insert_id();
					
					/* allow comment or not */
					$data_meta = array(
						'article_id'=>$article_id,
						'meta_key'=>'allow_comment',
						'meta_value'=>($this->input->post('allow_comment_id',true) == "1") ? "allowed" : "unallowed"
					);
					$this->article->insert_meta($data_meta);

					$data_meta = array(
						'article_id'=>$article_id,
						'meta_key'=>'show_image',
						'meta_value'=>($this->input->post('show_image_id',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* keywords */
					if ($this->input->post('keywords_id',true) != "") {
						$keywords = trim($this->input->post('keywords_id',true));
						$keywords = explode(',', $keywords);
						foreach($keywords as $keyword) {
							$data_meta = array(
								'article_id'=>$article_id,
								'meta_key'=>'keyword',
								'meta_value'=>trim($keyword)
							);
							$this->article->insert_meta($data_meta);
						}
					}

					

					/* show video */
					$data_meta = array(
						'article_id'=>$article_id,
						'meta_key'=>'show_video',
						'meta_value'=>($this->input->post('show_video_id',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* image uploaded */
					if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image_id']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
							
							$filename = $_FILES['image_id']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image_id']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/front/img/article/';

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$new_filename = $this->create_slug($this->input->post('title_id',true)) . '.' . $extension;
							$new_imagepath = base_url() . 'img/article/' . $article_id . '/' . $new_filename;

							move_uploaded_file($_FILES['image_id']['tmp_name'], $upload_dir . '/' . $new_filename);

							/* image processing */
							$this->media->content_image_processing($upload_dir, $new_filename);

							$data_meta = array(
								'article_id'=>$article_id,
								'meta_key'=>'image',
								'meta_value'=>$new_imagepath
							);
							$this->article->insert_meta($data_meta);
						}
					}

					
				}

				/* en data */
				if ($this->input->post('title_en',true) != "") {
					$data_article = array(
						'title'=>$this->input->post('title_en',true),
						'content'=>$this->input->post('content_en',true),
						'slug'=>$this->create_slug($this->input->post('title_en',true)),
						'article_category_id'=>$this->input->post('category_en',true),
						'article_sub_category_id'=>$this->input->post('sub_category_en',true),
						'excerpt'=>$this->input->post('excerpt_en',true),
						'author_id'=>'1',
						'lang'=>'en',
						'status'=>$this->input->post('status_en',true),
						'created_at'=>$this->input->post('tgl_en',true),
						'updated_at'=>date('Y-m-d H:i:s')
					);

					$this->article->insert($data_article);
					$en_article_id = $this->db->insert_id();

					/* allow comment or not */
					$data_meta = array(
						'article_id'=>$en_article_id,
						'meta_key'=>'allow_comment',
						'meta_value'=>($this->input->post('allow_comment_en',true) == "1") ? "allowed" : "unallowed"
					);
					$this->article->insert_meta($data_meta);

					$data_meta = array(
						'article_id'=>$en_article_id,
						'meta_key'=>'show_image',
						'meta_value'=>($this->input->post('show_image_en',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* keywords */
					if ($this->input->post('keywords_en',true) != "") {
						$keywords = trim($this->input->post('keywords_en',true));
						$keywords = explode(',', $keywords);
						foreach($keywords as $keyword) {
							$data_meta = array(
								'article_id'=>$en_article_id,
								'meta_key'=>'keyword',
								'meta_value'=>trim($keyword)
							);
							$this->article->insert_meta($data_meta);
						}
					}

					

					/* show video */
					$data_meta = array(
						'article_id'=>$en_article_id,
						'meta_key'=>'show_video',
						'meta_value'=>($this->input->post('show_video_en',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* image uploaded */
					if ($_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image_en']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
							
							$filename = $_FILES['image_en']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image_en']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/front/img/article/' . $en_article_id;

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$new_filename = $this->create_slug($this->input->post('title_en',true)) . '.' . $extension;
							$new_imagepath = base_url() . '/img/article/' . $en_article_id . '/' . $new_filename;

							move_uploaded_file($_FILES['image_en']['tmp_name'], $upload_dir . '/' . $new_filename);

							/* image processing */
							$this->media->content_image_processing($upload_dir, $new_filename);

							$data_meta = array(
								'article_id'=>$en_article_id,
								'meta_key'=>'image',
								'meta_value'=>$new_imagepath
							);
							$this->article->insert_meta($data_meta);
						}
					}

					

					if ($article_id) {
						$article_id = $en_article_id;
					}
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'articles', $article_id, 'Pengguna menambah data berita');

				$this->session->set_flashdata('article_success', true);
				redirect('admin/articles/show/' . $article_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('article', 'article_category', 'article_sub_category', 'comment'));
		$this->load->helper('form');

		$article = $this->article->get_article($id);

		if (count($article)  > 0) {
			$breadcrumbs = array(
				'#' => 'Artikel',
				'admin/articles' => 'Berita',
				'' => 'Ubah Berita'
			);
			$jscripts = array(
				'bootstrap-fileupload.min.js'=>'vendor',
				'bootstrap-timepicker.min.js'=>'vendor',
				'jquery.alerts.js'=>'vendor',
				'jquery.validate.min.js'=>'vendor',
				'jquery.tagsinput.min.js'=>'vendor',
				'jquery.autogrow-textarea.js'=>'vendor',
				'charCount.js'=>'vendor',
				'ui.spinner.min.js'=>'vendor',
				'chosen.jquery.min.js'=>'vendor',
				'forms.js'=>'vendor',
				//'tinymce/jquery.tinymce.js'=>'vendor',
				'ckeditor/ckeditor.js'=>'vendor',
				'wysiwyg.js'=>'vendor',
				'admin.article.form.js'=>'application'
			);
			$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.article.form.css');

			$category_temps = array();
			$categories = array();
			$sub_categories = array();
			$keywords = "";
			$allow_comment = '1';
			$video = "";
			$show_image = "";
			$show_video = "";

			if ($article[0]->lang == "id") {
				$category_temps = $this->article_category->get_categories_by_lang("id");
			} else {
				$category_temps = $this->article_category->get_categories_by_lang("en");	
			}

			foreach($category_temps as $category) {
				$categories[$category->id] = $category->name;
			}

			$sub_category_temps = $this->article_sub_category->get_sub_categories_by_category_id($article[0]->article_category_id);
			foreach($sub_category_temps as $sub_category) {
				$sub_categories[$sub_category->id] = $sub_category->name;
			}

			/* article meta */
			$keywords_meta = $this->article->get_article_meta($id, 'keyword');
			$allow_comment_meta = $this->article->get_article_meta($id, 'allow_comment');
			$video_meta = $this->article->get_article_meta($id, 'video');
			$show_image_meta = $this->article->get_article_meta($id, 'show_image');
			$show_video_meta = $this->article->get_article_meta($id, 'show_video');

			if (!empty($keywords_meta)) {
				foreach($keywords_meta as $keyword) {
					$keywords .= $keyword->meta_value . ", ";
				}

				$keywords = rtrim($keywords, ", ");
			}

			if (!empty($allow_comment_meta)) {
				if ($allow_comment_meta[0]->meta_value == "allowed") {
					$allow_comment = '1';
				} else {
					$allow_comment = '0';
				}
			}

			if (!empty($video_meta)) {
				$video = $video_meta[0]->meta_value;
			}

			if (!empty($show_image_meta)) {
				$show_image = $show_image_meta[0]->meta_value;
			}

			if (!empty($show_video_meta)) {
				$show_video = $show_video_meta[0]->meta_value;
			}

			if ($filled_value) {
				$article[0]->title = $filled_value['title'];
				$article[0]->article_category_id = $filled_value['category'];
				$article[0]->article_sub_category_id = $filled_value['sub_category'];
				$article[0]->content = $filled_value['content'];
				$article[0]->status = $filled_value['status'];
				$article[0]->excerpt = $filled_value['excerpt'];
				$article[0]->created_at = $filled_value['created_at'];
				$keywords = $filled_value['keywords'];
				$allow_comment = $filled_value['allow_comment'];
				$video = $filled_value['video'];
				$show_image = $filled_value['show_image'];
				$show_video = $filled_value['show_video'];

				$sub_category_temps = $this->article_sub_category->get_sub_categories_by_category_id($article[0]->article_category_id);
				foreach($sub_category_temps as $sub_category) {
					$sub_categories[$sub_category->id] = $sub_category->name;
				}
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'ARTIKEL', 'title' => 'Ubah Berita'), true),
				'content' => $this->load->view('admin/articles/edit', array('article'=>$article[0], 'categories'=>$categories, 'sub_categories'=>$sub_categories, 'video'=>$video, 'allow_comment'=>$allow_comment, 'keywords'=>$keywords, 'show_image'=>$show_image, 'show_video'=>$show_video, 'id'=>$id), true),
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
			$this->load->model(array('article', 'user_log', 'media'));
			$this->load->library('form_validation', 'image_lib');

			$this->form_validation->set_rules('title_category_sub_category_content', '', 'trim|callback_check_required');
			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_title');
			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_existing_title');
			$this->form_validation->set_rules('category', 'Kategori / Category', 'trim|callback_check_category');
			$this->form_validation->set_rules('sub_category', 'Sub Kategori / Sub Category', 'trim|callback_check_sub_category');
			$this->form_validation->set_rules('content', 'Konten / Content', 'trim|callback_check_content');
			$this->form_validation->set_rules('excerpt', 'Pengantar / Introduction', 'trim|callback_check_excerpt');
			$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_imagetype');
			$this->form_validation->set_message('check_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_en_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Inggris juga harus terisi');
			$this->form_validation->set_message('check_title', 'Minimal salah satu judul Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_existing_title', 'Judul yang Anda masukkan sudah terlebih dahulu terdaftar di dalam basis data.');
			$this->form_validation->set_message('check_category', 'Minimal salah satu kategori Bahasa Indonesia atau Bahasa Inggris harus terpilih.');
			$this->form_validation->set_message('check_sub_category', 'Minimal salah satu kategori Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_content', 'Minimal salah satu konten Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_excerpt', 'Minimal salah satu pengantar Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_imagetype', 'Silakan ganti image karena tipe image tidak dikenal.');
			if ($this->form_validation->run()) {
				$ffmpeg = $this->config->item('ffmpeg');
				$options = '-an -y -f mjpeg -ss 2 -s 640x264 -vframes 1 ';
				$article = $this->article->get_article($id);

				$data_article = array(
					'title'=>$this->input->post('title',true),
					'content'=>$this->input->post('content',true),
					'slug'=>$this->create_slug($this->input->post('title',true)),
					'article_category_id'=>$this->input->post('category',true),
					'article_sub_category_id'=>$this->input->post('sub_category',true),
					'excerpt'=>$this->input->post('excerpt',true),
					'author_id'=>'1',
					'lang'=>$article[0]->lang,
					'status'=>$this->input->post('status',true),
					'created_at'=>$this->input->post('tgl_id',true),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				if ($this->article->update($id, $data_article)) {
					/* allow comment or not */
					$this->article->remove_meta($id, 'allow_comment');
					$data_meta = array(
						'article_id'=>$id,
						'meta_key'=>'allow_comment',
						'meta_value'=>($this->input->post('allow_comment',true) == "1") ? "allowed" : "unallowed"
					);
					$this->article->insert_meta($data_meta);

					/* show image */
					$this->article->remove_meta($id, 'show_image');
					$data_meta = array(
						'article_id'=>$id,
						'meta_key'=>'show_image',
						'meta_value'=>($this->input->post('show_image',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* keywords */
					if ($this->input->post('keywords',true) != "") {
						$this->article->remove_meta($id, 'keyword');
						$keywords = trim($this->input->post('keywords',true));
						$keywords = explode(',', $keywords);
						foreach($keywords as $keyword) {
							$data_meta = array(
								'article_id'=>$id,
								'meta_key'=>'keyword',
								'meta_value'=>trim($keyword)
							);
							$this->article->insert_meta($data_meta);
						}
					}

					
					/* show video */
					$this->article->remove_meta($id, 'show_video');
					$data_meta = array(
						'article_id'=>$id,
						'meta_key'=>'show_video',
						'meta_value'=>($this->input->post('show_video',true) == "yes") ? "yes" : "no"
					);
					$this->article->insert_meta($data_meta);

					/* image uploaded */
					if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
						$mime = mime_content_type($_FILES['image']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
							
							$filename = $_FILES['image']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/front/img/article/' . $id;

							if (!is_dir($upload_dir)) {
								mkdir($upload_dir, 0755, true);
							}

							$new_filename = $this->create_slug($this->input->post('title',true)) . '.' . $extension;
							$new_imagepath = base_url() . 'front/img/article/' . $id . '/' . $new_filename;

							move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . '/' . $new_filename);

							/* image processing */
							$this->media->content_image_processing($upload_dir, $new_filename);

							$this->article->remove_meta($id, 'image');
							$data_meta = array(
								'article_id'=>$id,
								'meta_key'=>'image',
								'meta_value'=>$new_imagepath
							);
							$this->article->insert_meta($data_meta);
						}
					}



					$this->user_log->add_log($this->session->userdata('user_id'), 'articles', $id, 'Pengguna mengubah data berita');

					$this->session->set_flashdata('article_success', true);
					redirect('admin/articles/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				$this->edit($id, $this->input->post());
			}
		}
	}

	public function update_status($id) {
		$this->load->model(array('article', 'user_log'));
		$article = $this->article->get_article($id);
		$article = $article[0];
		if ($article->status != "deleted") {
			if ($article->status == "published") {
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

			$this->article->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'articles', $id, 'Pengguna mengubah status data berita');

			$this->session->set_flashdata('article_success', true);
			redirect('admin/articles');
		} else {
			redirect('/admin');
		}
	}

	public function destroy() {
		if ($this->input->post()) {
			$this->load->model(array('article', 'user_log'));
			$article_ids = $this->input->post('article_ids',true);
			foreach($article_ids as $article_id) {
				$this->article->destroy($article_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'articles', $article_id, 'Pengguna menghapus data berita');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_articles() {
		$this->load->model('article');
		$articles = $this->article->fetch_articles("", "", null);

		$ret_articles = array();
		$no = 1;
		foreach($articles as $article) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $article->id . "\" id=\"checker-" . $article->id . "\" /></span></div></span>";
			$created_at = strtotime($article->created_at);
    		$lang = ($article->lang == "id") ? "Indonesia" : "Inggris";

    		if ($this->user_access->edit) {
	    		if ($article->status == "published") {
	    			$status = "<a href=\"" . site_url('admin/articles/update_status/' . $article->id) . "\" class=\"article-status\" data-id=\"" . $article->id . "\" id=\"article-status-" . $article->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
	    		} else {
	    			$status = "<a href=\"" . site_url('admin/articles/update_status/' . $article->id) . "\" class=\"article-status\" data-id=\"" . $article->id . "\" id=\"article-status-" . $article->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
	    		}
	    	} else {
	    		$status = "";
	    	}

			$temp_article = array($checkbox, $no, $article->title, $article->slug, $article->category_name, $article->sub_category_name, date('d M Y H:i:s', $created_at), $article->username, $lang, $status);
			array_push($ret_articles, $temp_article);
			$no++;
		}
		$json = array('aaData'=>$ret_articles);

		echo json_encode($json);
	}

	/* START: validation callback */
	public function check_required() {
		if ($this->input->post('title',true)) {
			if ($this->input->post('title',true) == "" || $this->input->post('category',true) == "" || $this->input->post('sub_category',true) == "0" || $this->input->post('content',true) == "" || $this->input->post('excerpt',true) == "") {
				return false;
			} else {
				return true;
			}
		} elseif ($this->input->post('title_id',true) != "") {
			if ($this->input->post('category_id',true) == "" || $this->input->post('sub_category_id',true) == "0" || $this->input->post('content_id',true) == "" || $this->input->post('excerpt_id',true) == "") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_en_required() {
		if ($this->input->post('title_en',true) != "") {
			if ($this->input->post('category_en',true) == "" || $this->input->post('sub_category_en',true) == "0" || $this->input->post('content_en',true) == "" || $this->input->post('excerpt_en',true) == "") {
				return false;
			} else {
				return true;
			}
		}
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

	public function check_existing_title() {
		$this->load->model('article');

		if ($this->input->post('title',true)) {
			$slug = $this->create_slug($this->input->post('title',true));
			$article = $this->article->get_article_by_slug($slug);

			if (empty($article)) {
				return true;
			} else {
				$article = $article[0];
				if ($article->id == $this->input->post('article_id',true)) {
					return true;
				} else {
					return false;
				}
				
			}
		} else {
			$title_id = $this->input->post('title_id',true);
			$title_en = $this->input->post('title_en',true);
			$status = false;

			if ($title_id != "") {
				$slug = $this->create_slug($title_id);
				$article = $this->article->get_article_by_slug($slug);

				if (empty($article)) {
					$status = true;
				}
			}

			if ($title_en != "") {
				$slug = $this->create_slug($title_en);
				$article = $this->article->get_article_by_slug($slug);

				if (empty($article)) {
					$status = true;
				}
			}

			return $status;
		}
	}

	public function check_category() {
		if ($this->input->post('category',true)) {
			if ($this->input->post('category',true) == "") {
				return false;
			} else {
				return true;
			}
		} else {
			if ($this->input->post('category_id',true) == "" && $this->input->post('category_en',true) == "") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_sub_category() {
		if ($this->input->post('sub_category',true)) {
			if ($this->input->post('sub_category',true) == "0") {
				return false;
			} else {
				return true;
			}
		} else {
			if ($this->input->post('sub_category_id',true) == "0" && $this->input->post('sub_category_en',true) == "0") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_content() {
		if ($this->input->post('content',true)) {
			if ($this->input->post('content',true) == "") {
				return false;
			} else {
				return true;
			}
		} else {
			if ($this->input->post('content_id',true) == "" && $this->input->post('content_en',true) == "") {
				return false;
			} else {
				return true;
			}
		}
		
	}

	public function check_excerpt() {
		if ($this->input->post('excerpt',true)) {
			if ($this->input->post('excerpt',true) == "") {
				return false;
			} else {
				return true;
			}
		} else {
			if ($this->input->post('excerpt_id',true) == "" && $this->input->post('excerpt_en',true) == "") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_imagetype() {

		
		if (@$_FILES['image']) {
			if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {

				$filetype = mime_content_type($_FILES['image']['tmp_name']);

				if ($this->allowed_type[$filetype]) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			if (@$_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
				$filetype = mime_content_type($_FILES['image_id']['tmp_name']);

				if ($this->allowed_type[$filetype]) {
					return true;
				} else {
					return false;
				}
			} elseif (@$_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
				$filetype = mime_content_type($_FILES['image_en']['tmp_name']);

				if ($this->allowed_type[$filetype]) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}
	}
	/* END: validation callback */

	private function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}
}

/* End of file articles.php */
/* Location: ./application/controllers/admin/articles.php */