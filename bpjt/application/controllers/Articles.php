<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->lang->load('id', 'indonesia');
		$lang = $this->session->userdata('lang');
		if (!empty($lang) && $lang == 'en') {
			$this->lang->load('en', 'english');
		} else {
			$this->session->set_userdata(array('lang'=>'id'));
		}
	}

	public function index() {
		$this->load->model(array('article', 'media'));

		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$data = $this->cache->file->get('article_data_' . $this->session->userdata('lang') . '_' . $page);
		if(!$data){
			$jscripts = array();
			$stylesheets = array();

			$entry = 25;
			// $page = (isset($this->input->get('page', TRUE))) ? intval($this->input->get('page', TRUE)) : 1;
			
			$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
			$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
			$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
			$articles = $this->article->get_articles_with_image($this->session->userdata('lang'), $page, $entry);
			$count_articles = $this->article->count_published_articles($this->session->userdata('lang'));
			$total_page = floor($count_articles/$entry);
			if ($count_articles % $entry > 0) {
				$total_page++;
			}
			$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

			$data = array(
				'prefix_title' => 'BERITA - ',
				'content' => $this->load->view('articles/index-new', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3,'articles'=>$articles, 'popular_articles'=>$this->article->get_popular_articles(3), 'count_articles'=>$count_articles, 'page'=>$page, 'total_page'=>$total_page), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$db_medias
			);

			$this->cache->file->save('article_data_' . $this->session->userdata('lang') . '_' . $page, $data, 30);
		}

		$this->load->view('layouts/content-new.php', $data);
	}
	
	public function viewnews() {
		$this->load->model(array('article', 'media'));

		$jscripts = array();
		$stylesheets = array();

		$entry = 10;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$articles = $this->article->get_articles_with_image2($this->session->userdata('lang'), $page, $entry);
		//foreach ($articles as $articless) {
		//	$gambar = $this->media->get_image_by_style($articles->image_name, 'pn640');
		//}
		//echo json_encode($gambar); 
		$jsonArticle = json_encode($articles);
		//$jsonGambar = json_encode($gambar);
		
		echo ''.$jsonArticle.'';
		//'<img src="'.$jsonGambar.'">';
	}

	public function show($slug) {
		$this->load->model(array('article', 'visitor', 'comment', 'media'));
		$this->load->helper('form');
		$this->load->helper('share');

		$article = $this->cache->file->get('article_' . sha1($slug));
		if(!$article){
			$article = $this->article->get_article_by_slug($slug);

			$this->cache->file->save('article_' . sha1($slug), $article, 30);
		}

		
		if (!empty($article)) {

			$data = $this->cache->file->get('article_data_' . sha1($slug));

			if(!$data){
				$this->visitor->add_visitor('articles', $article[0]->id);

				$stylesheets = array('video-js.css');
				$jscripts = array(
					'video.js'=>'vendor'
				);
				$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
				$viewed = $this->article->viewed_articles($article[0]->id);
				$popular_articles = $this->article->get_popular_articles(3);
				$popular_articles = $this->article->get_popular_articles(3);
				$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
				$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
				$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
				$related_articles = $this->article->get_related_articles($article[0]->id, $article[0]->article_category_id, $article[0]->article_sub_category_id, 4);
				$comments = $this->comment->prepare_comments($article[0]->id, $page, 5);
				$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
				$headlines = $this->article->get_articles_with_image($this->session->userdata('lang'), 1, 4);
				$videos = $this->article->get_article_meta($article[0]->id, 'video');
				$show_video = $this->article->get_article_meta($article[0]->id, 'show_video');
				$show_image = $this->article->get_article_meta($article[0]->id, 'show_image');
				$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
	
				$data = array(
					'content' => $this->load->view('articles/show-new', array('article'=>$article[0], 'videos'=>$videos, 'show_image'=>$show_image, 'show_video'=>$show_video, 'headlines'=>$headlines, 'popular_articles'=>$popular_articles, 'related_articles'=>$related_articles, 'comments'=>$comments, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'validation_errors'=>$this->session->flashdata('validation_errors'), 'comment_success'=>$this->session->flashdata('comment_success')), true),
					'stylesheets'=>$stylesheets,
					'jscripts'=>$jscripts,
					'galleries'=>$db_medias
				);

				$this->cache->file->save('article_data_' . sha1($slug), $data, 30);
			}
			
			$this->load->view('layouts/content-new.php', $data);
		} else {
			redirect('berita');
		}
	}
	
	public function pdf_version($slug) {
		$this->load->model(array('article', 'visitor', 'media'));
		$this->load->helper('text');
			
		$article = $this->article->get_article_by_slug($slug);
		if (!empty($article)) {
			$this->visitor->add_visitor('articles', $article[0]->id);
	
			$jscripts = array();
			$stylesheets = array();
			
			// $PDFLib = new PDFlib();
			// if ($PDFLib->begin_document("", "") == 0) die("Error: " . $PDFLib->get_errmsg());
			// $PDFLib->set_info("Title", $article[0]->title);
			// $PDFLib->begin_page_ext(595, 842, "");
			// //$PDFLib->set_text_option('wordspacing', 2);
			// $font = $PDFLib->load_font("Helvetica-Bold", "winansi", "");
			// $PDFLib->setfont($font, 24.0);
			// $PDFLib->set_text_pos(50, 750);
			// $PDFLib->show($article[0]->title);
			// $PDFLib->set_text_pos(50, 700);
			// $PDFLib->setfont($font, 10.0);
			// $var_content = str_replace('</p>', '%0A', $article[0]->content);
			// $var_content = str_replace('<br />', '%0A', $var_content);
			// $var_content = strip_tags(ascii_to_entities($var_content));
			// $var_content = explode('%0A', $var_content);
			// for($i=0; $i<count($var_content); $i++) {
			// 	$content = $var_content[$i];
			// 	while(strlen($content) > 0) {
			// 		$var_text = character_limiter($content, 80);
			// 		$var_text = str_replace('&#8230;', '', $var_text);
			// 		$PDFLib->continue_text(trim($var_text));
			// 		$content = trim(str_replace($var_text, "", $content));
			// 	}
			// 	$PDFLib->continue_text(' ');
			// }
			
			// $PDFLib->end_page_ext("");
			// $PDFLib->end_document("");
			
			// $buffer = $PDFLib->get_buffer();
			// $len = strlen($buffer);
			// $filename = str_replace(" ", "_", $article[0]->title).".pdf";
			
			// header("Content-type: application/pdf");
			// //header("Content-Length: $len");
			// //header("Content-Disposition: inline; filename=$filename");
			
			// print $buffer;
			// exit;

			require_once(dirname(__FILE__).'/../libraries/WkHtmlToPdf.php');
			//$table = $_POST['table_structure'];
			$content = "<h1>" . $article[0]->title . "</h1>";
			if (isset($article[0]->image_name)) {
				$content .= "<img src='" . $this->media->get_image_by_style($article[0]->image_name, 'pn640') . "' />";
				$content .= "<br />";
			}
			$content .= $article[0]->content;

			$pdf = new WkHtmlToPdf(array('bin'=>$this->config->item('wkhtmltopdf')));
			// Add a HTML file, a HTML string or a page from a URL
			$pdf->addPage("<html>" . $content . "</html>");

			// ... or send to client as file download
			if (!$pdf->send())
				throw new Exception('Could not create PDF: '.$pdf->getError());
		} else {
			redirect('berita');
		}
	}
	
	public function tag($article_category_id) {
		$this->load->model(array('article', 'media'));

		$jscripts = array();
		$stylesheets = array();

		$entry = 10;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$articles = $this->article->get_related_articles2($this->session->userdata('lang'), $article_category_id, $page, $entry);
		$count_articles = $this->article->count_published_tag_articles($this->session->userdata('lang'),$article_category_id);
		$total_page = floor($count_articles/$entry);
		if ($count_articles % $entry > 0) {
			$total_page++;
		}
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$data = array(
			'content' => $this->load->view('articles/index', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3,'articles'=>$articles, 'popular_articles'=>$this->article->get_popular_articles(3), 'count_articles'=>$count_articles, 'page'=>$page, 'total_page'=>$total_page), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content.php', $data);
	}
	
}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */
