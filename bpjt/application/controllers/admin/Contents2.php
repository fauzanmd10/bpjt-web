<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents2 extends CI_Controller {
	private $allowed_type = array('image/jpeg'=>1, 'image/jpg'=>1, 'image/png'=>1, 'image/gif'=>1, 'video/mp4'=>1);
	
	private $content_type_lib = array(
		'bpjt'=>'BPJT',
		'jalan-tol'=>'Jalan Tol',
		'bujt'=>'BUJT',
		'info-tarif-tol'=>'Info Tarif Tol',
		'investasi'=>'Investasi',
		'progress-pembangunan'=>'Progress Pembangunan',
		'syarat-ketentuan'=>'Kamus Istilah',
		'tentang-kami'=>'Tentang Kami',
		'footer'=>'Footer',
		'telepon'=>'Telepon',
		'fax'=>'Fax',
		'email'=>'Email',
		'alamat'=>'Alamat',
		'spm'=>'SPM',
		'golongan-kendaraan'=>'Konten Golongan Kendaraan'
	);

	private $sub_content_type_lib = array(
		''=>'',
		'sekilas-bpjt'=>'Sekilas BPJT',
		'visi-misi'=>'Visi dan Misi',
		'struktur-organisasi'=>'Struktur Organisasi',
		'tugas-bpjt'=>'Tugas BPJT',
		'sejarah'=>'Sejarah',
		'tujuan-manfaat'=>'Tujuan dan Manfaat',
		'kebijakan-percepatan-pembangunan'=>'Kebijakan Percepatan Pembangunan',
		'nama-ruas-tol'=>'Nama Ruas Tol',
		'trafik-pengguna'=>'Trafik Pengguna',
		'prinsip-penyelenggaraan'=>'Prinsip Penyelenggaraan',
		'skema-investasi'=>'Skema Investasi',
		'tahapan-makro-pengusahaan-jalan-tol'=>'Tahapan Makro Pengusahaan Jalan Tol',
		'prosedur-investasi'=>'Prosedur Investasi',
		'rencana'=>'Rencana',
		'ruas-tol'=>'Ruas Tol',
		'progress'=>'Progress',
		'beroperasi'=>'Beroperasi',
		'jalan-tol-ppjt'=>'Jalan Tol PPJT',
		'tender-tender'=>'Tender-Tender',
		'persiapan-tender'=>'Persiapan Tender',
		'definisi-spm'=>'Definisi SPM',
	);

	private $en_content_type_lib = array(
		''=>'',
		'golongan-kendaraan'=>'Vehicle Groups',
	);

	private $en_sub_content_type_lib = array(
		''=>'',
		'definisi-spm'=>'SPM Definition',
	);

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}
	}

	public function form($content_type, $sub_content_type=null, $filled_value=null) {
		$this->load->model(array('content', 'comment'));
		$this->load->library('form_validation');

		$this->check_access($content_type, $sub_content_type);

		$sub_content_type = (empty($sub_content_type)) ? "" : $sub_content_type;
		$content_type_label = $this->menu->get_menu_by_slug($content_type);
		$content_type_label = (empty($content_type_label)) ? "" : $content_type_label[0]->name;
		$sub_content_type_label = $this->menu->get_menu_by_slug($sub_content_type);
		$sub_content_type_label = (empty($sub_content_type_label)) ? "" : $sub_content_type_label[0]->name;
		$menu = ($sub_content_type_label == "") ? $this->menu->get_menu_by_slug($content_type) : $this->menu->get_menu_by_slug($sub_content_type);
		if (empty($menu)) {
			if (empty($this->sub_content_type_lib[$sub_content_type])) {
				$menu_name = $this->content_type_lib[$content_type];
				$en_menu_name = $this->en_content_type_lib[$content_type];
				$content_type_label = $menu_name;
				$sub_content_type_label = $menu_name;
			} else {
				$menu_name = $this->sub_content_type_lib[$sub_content_type];
				$en_menu_name = $this->en_sub_content_type_lib[$sub_content_type];
				$content_type_label = $this->content_type_lib[$content_type];
				$sub_content_type_label = $menu_name;
			}
		} else {
			$menu_name = $menu[0]->name;
			$en_menu_name = $menu[0]->name_en;
		}

		$breadcrumbs = array(
			'#' => 'Konten',
			'#' => $content_type_label,
			'' => $sub_content_type_label
		);
		$jscripts = array(
			''=>'',
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
			//'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.content.form.css');

		$contents = $this->content->get_content_by_paths($content_type, $sub_content_type);
		$content_data = array();
		$content_en = array();
		$keywords_id = "";
		$allow_comment_id = '1';
		$video_id = "";
		$show_image_id = "";
		$keywords_en = "";
		$allow_comment_en = '1';
		$video_en = "";
		$show_image_en = "";

		if (!empty($filled_value)) {
			$content_data = $filled_value;
		} else {
			foreach($contents as $content) {
				$keywords = $this->content->get_content_meta($content->id, 'keyword');
				$videos = $this->content->get_content_meta($content->id, 'video');
				$allow_comments = $this->content->get_content_meta($content->id, 'allow_comment');
				$show_image = $this->content->get_content_meta($content->id, 'show_image');
				$show_video = $this->content->get_content_meta($content->id, 'show_video');

				if ($content->lang == "id") {
					$content_data['title_id'] = $content->title;
					$content_data['content_id'] = $content->content;
					$content_data['status_id'] = $content->status;

					if (!empty($keywords)) {
						foreach($keywords as $keyword) {
							$keywords_id .= $keyword->meta_value . ", ";
						}

						$keywords_id = rtrim($keywords_id, ", ");

						$content_data['keywords_id'] = $keywords_id;
					}

					if (!empty($videos)) {
						$video_id = $videos[0]->meta_value;
						$content_data['video_id'] = $video_id;
					}

					if (!empty($allow_comments)) {
						if ($allow_comments[0]->meta_value == "allowed") {
							$allow_comment_id = '1';
						} else {
							$allow_comment_id = '0';
						}

						$content_data['allow_comment_id'] = $allow_comment_id;
					}

					if (!empty($show_image)) {
						$show_image_id = $show_image[0]->meta_value;
						$content_data['show_image_id'] = $show_image_id;
					}

					if (!empty($show_video)) {
						$show_video_id = $show_video[0]->meta_value;
						$content_data['show_video_id'] = $show_video_id;
					}

				} else {
					$content_data['title_en'] = $content->title;
					$content_data['content_en'] = $content->content;
					$content_data['status_en'] = $content->status;

					if (!empty($keywords)) {
						foreach($keywords as $keyword) {
							$keywords_en .= $keyword->meta_value . ", ";
						}

						$keywords_en = rtrim($keywords_en, ", ");

						$content_data['keywords_en'] = $keywords_en;
					}

					if (!empty($videos)) {
						$video_en = $videos[0]->meta_value;
						$content_data['video_en'] = $video_en;
					}

					if (!empty($allow_comments)) {
						if ($allow_comments[0]->meta_value == "allowed") {
							$allow_comment_en = '1';
						} else {
							$allow_comment_en = '0';
						}

						$content_data['allow_comment_en'] = $allow_comment_en;
					}

					if (!empty($show_image)) {
						$show_image_en = $show_image[0]->meta_value;
						$content_data['show_image_en'] = $show_image_en;
					}

					if (!empty($show_video)) {
						$show_video_en = $show_video[0]->meta_value;
						$content_data['show_video_en'] = $show_video_en;
					}
				}
			}
		}

		$tokens = enc('enc', date('mdY'));
		// exit();
		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => strtoupper($content_type_label), 'title' => ($sub_content_type_label == "") ? $content_type_label : $sub_content_type_label), true),
			'content' => $this->load->view('admin/contents/form', array('content'=>$content_data, 'menu'=>$menu, 'menu_name'=>$menu_name, 'en_menu_name'=>$en_menu_name, 'content_type'=>$content_type, 'sub_content_type'=>$sub_content_type, 'flash_success'=>$this->session->flashdata('article_content_success'),'tokens' =>$tokens), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function save() {
		
		
		if ($this->input->post()) {
			$tok =  enc('dec',$this->input->post('tokens',true));
			$content_type =  $this->input->post('content_type',true);
			$sub_content_type =  $this->input->post('sub_content_type',true);
			
			
			if($tok != date('mdY')){
				$this->form($content_type, $sub_content_type, $this->input->post());
				
				redirect('admin/contents/' . $content_type . '/' . $sub_content_type);
			}

			$this->load->model(array('content', 'user_log', 'media'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title_category_sub_category_content', '', 'trim|callback_check_required');
			$this->form_validation->set_rules('en_title_content', '', 'trim|callback_check_en_required');
			$this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_title');
			$this->form_validation->set_rules('content', 'Konten / Content', 'trim|callback_check_content');
			$this->form_validation->set_rules('image', 'Image', 'trim|callback_check_imagetype');
			$this->form_validation->set_rules('video', 'Video', 'trim|callback_check_videotype');
			$this->form_validation->set_rules('video', 'Video', 'trim|callback_check_videosize');
			$this->form_validation->set_message('check_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Indonesia harus terisi');
			$this->form_validation->set_message('check_en_required', 'Judul, Kategori, Sub Kategori, Konten, dan Pengantar dalam Bahasa Inggris juga harus terisi');
			$this->form_validation->set_message('check_title', 'Minimal salah satu judul Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_content', 'Minimal salah satu konten Bahasa Indonesia atau Bahasa Inggris harus terisi.');
			$this->form_validation->set_message('check_imagetype', 'Silakan ganti image karena tipe image tidak dikenal.');
			$this->form_validation->set_message('check_videotype', 'Silakan ganti video karena tipe video tidak dikenal.');
			$this->form_validation->set_message('check_videosize', 'Silakan ganti video karena ukuran video melebihi batas yang diperbolehkan.');

			$content_type = $this->input->post('content_type',true);
			$sub_content_type = $this->input->post('sub_content_type',true);

			if ($this->form_validation->run()) {
				$ffmpeg = $this->config->item('ffmpeg');
				$options = '-an -y -f mjpeg -ss 2 -s 640x264 -vframes 1 ';
				$content = $this->content->get_content_by_paths_and_lang($content_type, $sub_content_type, 'id');
				
				$data_content = array(
					'title'=>$this->input->post('title_id',true),
					'content'=>$this->input->post('content_id',true),
					'slug'=>$content_type.'/'.$sub_content_type,
					'content_type'=>$content_type,
					'sub_content_type'=>$sub_content_type,
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				if (empty($content)) {
					$saveret = $this->content->insert($data_content);
				} else {
					$saveret = $this->content->update($content[0]->id, $data_content);
				}
				

				if ($saveret) {
					if (empty($content)) {
						$content_id = $this->db->insert_id();
						$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $content_id, 'Pengguna menambah data ' . $content_type . '(' . $sub_content_type . ')');
					} else {
						$content_id = $content[0]->id;
						$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $content_id, 'Pengguna mengubah data ' . $content_type . '(' . $sub_content_type . ')');
					}

					/* allow comment or not */
					if (!empty($content)) {
						$this->content->remove_meta($content_id, 'allow_comment');
						$this->content->remove_meta($content_id, 'show_image');
						$this->content->remove_meta($content_id, 'show_video');
					}
					$data_meta = array(
						'content_id'=>$content_id,
						'meta_key'=>'allow_comment',
						'meta_value'=>($this->input->post('allow_comment_id',true) == "1") ? "allowed" : "unallowed"
					);
					$this->content->insert_meta($data_meta);

					$data_meta = array(
						'content_id'=>$content_id,
						'meta_key'=>'show_image',
						'meta_value'=>($this->input->post('show_image_id',true) == "yes") ? "yes" : "no"
					);
					$this->content->insert_meta($data_meta);

					/* keywords */
					if ($this->input->post('keywords_id',true) != "") {
						if (!empty($content)) {
							$this->content->remove_meta($content_id, 'keyword');
						}
						$keywords = trim($this->input->post('keywords_id',true));
						$keywords = explode(',', $keywords);
						foreach($keywords as $keyword) {
							$data_meta = array(
								'content_id'=>$content_id,
								'meta_key'=>'keyword',
								'meta_value'=>trim($keyword)
							);
							$this->content->insert_meta($data_meta);
						}
					}


					/* show video */
					$data_meta = array(
						'content_id'=>$content_id,
						'meta_key'=>'show_video',
						'meta_value'=>($this->input->post('show_video_id',true) == "yes") ? "yes" : "no"
					);
					$this->content->insert_meta($data_meta);

					/* image uploaded */
					if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
						echo 'masuk image';
						$mime = mime_content_type($_FILES['image_id']['tmp_name']);
						if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
							echo '  lolos mime  ';
							$filename = $_FILES['image_id']['name'];
							$extensions = explode('.', $filename);
							$extension = $extensions[count($extensions)-1];
							$filetype = $_FILES['image_id']['type'];
							$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/front/img/content/';

							// if (!is_dir($upload_dir)) {
							// 	mkdir($upload_dir, 0777, true);
							// }

							$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
							$new_imagepath = base_url() . 'front/img/content/' . $new_filename;
							$destination =  $upload_dir . $new_filename;
							// move_uploaded_file($_FILES['image_id']['tmp_name'], $upload_dir . $new_filename);
							$source = $_FILES['image_id']['tmp_name'];
							// $a = array();
							// $b = array();
							$a=1000000;
							for ($i=1; $i < 10 ; $i++) { 
								$q = 100-(10*$i);
								if ($a >= 500000) {
									unlink($destination);
									$compressedImage = $this->compressImage($source, $destination,$q);
									$a= $compressedImage;
								}else{
									break;
								}
							}
							
							

							// echo $compressedImage;
							// $imgsize = filesize($destination); 
							
							// echo "<pre>";
							// print_r ($compressedImage);
							// echo "</pre>";
							
							// $imgsize = filesize($destination); 
							// echo '/ '.$imgsize.'  /';
							// if ($imgsize >= 5000) {

							// 	$compressedImage = $this->compressImage2($destination, 'new'.$destination, 50);
							// 	echo $compressedImage;
							// 	echo ' / if';
							// }
							
							// if($compressedImage){ 
							// 	$status = 'success'; 
							// 	$statusMsg = "Image compressed successfully."; 
							// }else{ 
							// 	$statusMsg = "Image compress failed!"; 
							// } 
							
							/* image processing */
							// $this->media->content_image_processing($upload_dir, $new_filename);

							if (!empty($content)) {
								$this->content->remove_meta($content_id, 'image');
							}
							$data_meta = array(
								'content_id'=>$content_id,
								'meta_key'=>'image',
								'meta_value'=>$new_imagepath
							);
							
							// echo "<pre>";
							// print_r ($data_meta);
							// echo "</pre>";
							
							$this->content->insert_meta($data_meta);
						}
					}
					// echo $this->db->last_query();
					
					// exit();

					/* file uploaded */
					

					/* en data */
					if ($this->input->post('title_en',true) != "") {
						$content = $this->content->get_content_by_paths_and_lang($content_type, $sub_content_type, 'en');
						$data_content = array(
							'title'=>$this->input->post('title_en',true),
							'content'=>$this->input->post('content_en',true),
							'slug'=>'en/'.$content_type.'/'.$sub_content_type,
							'content_type'=>$content_type,
							'sub_content_type'=>$sub_content_type,
							'lang'=>'en',
							'status'=>$this->input->post('status_en',true),
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);

						if (empty($content)) {
							$saveret = $this->content->insert($data_content);
						} else {
							$saveret = $this->content->update($content[0]->id, $data_content);
						}

						if (empty($content)) {
							$en_content_id = $this->db->insert_id();
						} else {
							$en_content_id = $content[0]->id;
						}

						/* allow comment or not */
						if (!empty($content)) {
							$this->content->remove_meta($en_content_id, 'allow_comment');
							$this->content->remove_meta($en_content_id, 'show_image');
							$this->content->remove_meta($en_content_id, 'show_video');
						}
						$data_meta = array(
							'content_id'=>$en_content_id,
							'meta_key'=>'allow_comment',
							'meta_value'=>($this->input->post('allow_comment_en',true) == "1") ? "allowed" : "unallowed"
						);
						$this->content->insert_meta($data_meta);

						$data_meta = array(
							'content_id'=>$en_content_id,
							'meta_key'=>'show_image',
							'meta_value'=>($this->input->post('show_image_en',true) == "yes") ? "yes" : "no"
						);
						$this->content->insert_meta($data_meta);

						/* keywords */
						if ($this->input->post('keywords_en',true) != "") {
							if (!empty($content)) {
								$this->content->remove_meta($en_content_id, 'keyword');
							}
							$keywords = trim($this->input->post('keywords_en',true));
							$keywords = explode(',', $keywords);
							foreach($keywords as $keyword) {
								$data_meta = array(
									'content_id'=>$en_content_id,
									'meta_key'=>'keyword',
									'meta_value'=>trim($keyword)
								);
								$this->content->insert_meta($data_meta);
							}
						}

						/* video url */
					

						/* show video */
						$data_meta = array(
							'content_id'=>$en_content_id,
							'meta_key'=>'show_video',
							'meta_value'=>($this->input->post('show_video_id',true) == "yes") ? "yes" : "no"
						);
						$this->content->insert_meta($data_meta);

						/* image uploaded */
						if ($_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
							$mime = mime_content_type($_FILES['image_en']['tmp_name']);
							if ($mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'image/png' ){
								$filename = $_FILES['image_en']['name'];
								$extensions = explode('.', $filename);
								$extension = $extensions[count($extensions)-1];
								$filetype = $_FILES['image_en']['type'];
								$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bpjt_ci3/front/img/content/';

								if (!is_dir($upload_dir)) {
									mkdir($upload_dir, 0777, true);
								}

								$new_filename = md5($filename . date('YmdHis')) . '.' . $extension;
								$new_imagepath = base_url() . 'front/img/content/' . $new_filename;
								$destination =  $upload_dir . $new_filename;

								// move_uploaded_file($_FILES['image_en']['tmp_name'], $upload_dir . '/' . $new_filename);

								/* image processing */
								// $this->media->content_image_processing($upload_dir, $new_filename);

								// if (!empty($content)) {
								// 	$this->content->remove_meta($en_content_id, 'image');
								// }
								$source = $_FILES['image_en']['tmp_name'];
								// $a = array();
								// $b = array();
								$a= 1000000;
								for ($i=1; $i < 10 ; $i++) { 
									$q = 100-(10*$i);
									if ($a >= 500000) {
										unlink($destination);
										$compressedImage = $this->compressImage($source, $destination,$q);
										$a= $compressedImage;
									}else{
										break;
									}
								}
								$data_meta = array(
									'content_id'=>$en_content_id,
									'meta_key'=>'image',
									'meta_value'=>$new_imagepath
								);
								$this->content->insert_meta($data_meta);
							}
						}

						/* file uploaded */
					
					}

					$this->session->set_flashdata('article_content_success', true);
					redirect('admin/contents/' . $content_type . '/' . $sub_content_type);
				} else {
					$this->form($content_type, $sub_content_type, $this->input->post());
				}
			} else {
				$this->form($content_type, $sub_content_type, $this->input->post());
			}
		}
	}

	public function cms($content_type, $filled_value=null) {
		$this->load->model(array('content', 'comment'));
		$this->load->library('form_validation');

		$this->check_cms_access($content_type);

		$breadcrumbs = array(
			'#' => 'Konten',
			'#' => $this->content_type_lib[$content_type]
		);
		$jscripts = array(
			''=>'',
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
			'tinymce/jquery.tinymce.js'=>'vendor',
			'wysiwyg.js'=>'vendor'
		);
		$stylesheets = array('bootstrap-fileupload.min.css', 'bootstrap-timepicker.min.css', 'admin.content.form.css');

		$contents = $this->content->get_content_by_paths($content_type, "");
		$content_data = array();
		$content_en = array();

		if (!empty($filled_value)) {
			$content_data = $filled_value;
		} else {
			foreach($contents as $content) {
				if ($content->lang == "id") {
					$content_data['content_id'] = $content->content;
					$content_data['status_id'] = $content->status;

				} else {
					$content_data['content_en'] = $content->content;
					$content_data['status_en'] = $content->status;
				}
			}
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'CMS', 'title' => $this->content_type_lib[$content_type]), true),
			'content' => $this->load->view('admin/contents/cms', array('content'=>$content_data, 'content_type'=>$content_type, 'flash_success'=>$this->session->flashdata('article_content_success')), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function save_cms() {
		if ($this->input->post()) {
			$this->load->model(array('content', 'user_log', 'media'));
			$this->load->library('form_validation');

			$content_type = $this->input->post('content_type',true);

			//if ($this->form_validation->run()) {
				$content = $this->content->get_content_by_paths_and_lang($content_type, "", 'id');
				$data_content = array(
					'title'=>$this->content_type_lib[$content_type],
					'content'=>$this->input->post('content_id',true),
					'slug'=>$content_type.'/',
					'content_type'=>$content_type,
					'sub_content_type'=>'',
					'lang'=>'id',
					'status'=>$this->input->post('status_id',true),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				if (empty($content)) {
					$saveret = $this->content->insert($data_content);
				} else {
					$saveret = $this->content->update($content[0]->id, $data_content);
				}

				if ($saveret) {
					if (empty($content)) {
						$content_id = $this->db->insert_id();
						$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $content_id, 'Pengguna menambah data ' . $content_type);
					} else {
						$content_id = $content[0]->id;
						$this->user_log->add_log($this->session->userdata('user_id'), 'contents', $content_id, 'Pengguna mengubah data ' . $content_type);
					}

					/* en data */
					if ($this->input->post('content_en',true) != "") {
						$content = $this->content->get_content_by_paths_and_lang($content_type, "", 'en');
						$data_content = array(
							'title'=>$this->content_type_lib[$content_type],
							'content'=>$this->input->post('content_en',true),
							'slug'=>'en/'.$content_type.'/',
							'content_type'=>$content_type,
							'sub_content_type'=>'',
							'lang'=>'en',
							'status'=>$this->input->post('status_en',true),
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);

						if (empty($content)) {
							$saveret = $this->content->insert($data_content);
						} else {
							$saveret = $this->content->update($content[0]->id, $data_content);
						}

						if (empty($content)) {
							$en_content_id = $this->db->insert_id();
						} else {
							$en_content_id = $content[0]->id;
						}
					}

					$this->session->set_flashdata('article_content_success', true);
					redirect('admin/contents/cms/' . $content_type);
				} else {
					$this->cms($content_type, $this->input->post());
				}
			//} else {
			//	$this->cms($content_type, $this->input->post());
			//}
		}
	}

	/* START: validation callback */
	public function check_required() {
			if ($this->input->post('title_id',true) == "" || $this->input->post('content_id',true) == "") {
				return false;
			} else {
				return true;
			}
	}

	public function check_en_required() {
		if ($this->input->post('title_en',true) != "") {
			if ($this->input->post('content_en',true) == "") {
				return false;
			} else {
				return true;
			}
		}
	}

	public function check_title() {
		$title_id = $this->input->post('title_id',true);
		$title_en = $this->input->post('title_en',true);

		if ($title_id == "" && $title_en == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_content() {
		if ($this->input->post('content_id',true) == "" && $this->input->post('content_en',true) == "") {
			return false;
		} else {
			return true;
		}		
	}
	public function check_imagetype() {
		if ($_FILES['image_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_id']['tmp_name']);
			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} elseif ($_FILES['image_en']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['image_en']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	public function check_videotype() {
		if ($_FILES['video_id']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['video_id']['tmp_name']);

			if (isset($this->allowed_type[$filetype])) {
				return true;
			} else {
				return false;
			}
		} elseif ($_FILES['video_en']['error'] != UPLOAD_ERR_NO_FILE) {
			$filetype = mime_content_type($_FILES['video_en']['tmp_name']);

			if (isset($this->allowed_type['filetype'])) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	public function check_videosize() {
		if ($_FILES['video_id']['error'] != UPLOAD_ERR_NO_FILE) {
			if ($_FILES['video_id']['size'] <= 5242880) {
				return true;
			} else {
				return false;
			}
		} elseif ($_FILES['video_en']['error'] != UPLOAD_ERR_NO_FILE) {
			if ($_FILES['video_en']['size'] <= 5242880) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
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

	private function check_access($content_type, $sub_content_type=null) {
		//$access_key = str_replace('-', '_', $content_type);
		$access_key = 'konten_dinamis';
		if (!empty($sub_content_type)) {
			if ($sub_content_type == 'definisi-spm' && $content_type == 'spm') {
				$access_key = 'spm_keterangan_definisi';
			} else {
				//$sub_content_type = str_replace('-', '_', $sub_content_type);
				//$access_key = $access_key . '_' . $sub_content_type;
			}			
		} elseif ($content_type == 'golongan-kendaraan') {
			$access_key = 'info_tarif_tol_konten';
		} 

		$this->load->model('access');
		$access = $this->access->get_user_access_by_key($access_key, $this->session->userdata('user_group_id'));
		$access = $access[0];
		if ($this->router->fetch_method() == 'form' && !$access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		}
	}

	private function check_cms_access($content_type) {
		if ($content_type == 'syarat-ketentuan') {
			$access_key = 'konten_statis_syarat_ketentuan';
		} elseif ($content_type == 'tentang-kami') {
			$access_key = 'konten_statis_tentang_kami';
		} elseif ($content_type == 'footer') {
			$access_key = 'konten_statis_footer';
		} elseif ($content_type == 'telepon') {
			$access_key = 'konten_statis_telepon';
		} elseif ($content_type == 'fax') {
			$access_key = 'konten_statis_fax';
		} elseif ($content_type == 'email') {
			$access_key = 'konten_statis_email';
		} elseif ($content_type == 'alamat') {
			$access_key = 'konten_statis_alamat';
		}

		$this->load->model('access');
		$access = $this->access->get_user_access_by_key($access_key, $this->session->userdata('user_group_id'));
		$access = $access[0];
		if ($this->router->fetch_method() == 'cms' && !$access->edit) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		}
	}

	function compressImage($source, $destination, $quality) { 
		// Get image info 
		$imgInfo = getimagesize($source); 
		$mime = $imgInfo['mime']; 
		// Create a new image from file 
		switch($mime){ 
			case 'image/jpeg': 
				$image = imagecreatefromjpeg($source); 
			   imagejpeg($image, $destination, $quality);
				break;
			case 'image/png': 
				$image = imagecreatefrompng($source); 
				imagepng($image, $destination, $quality);
				break; 
			case 'image/gif': 
				$image = imagecreatefromgif($source); 
				imagegif($image, $destination, $quality);
				break; 
			default: 
				$image = imagecreatefromjpeg($source); 
			   imagejpeg($image, $destination, $quality);
		} 
		 
		$imgsize = filesize($destination); 
		
		// Return compressed image 
		return $imgsize.'/'.$quality; 
	} 

	
	
}

/* End of file contents.php */
/* Location: ./application/controllers/admin/content.php */