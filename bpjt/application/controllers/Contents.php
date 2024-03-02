<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends CI_Controller {
	public $content_type_lib = array(
		'bpjt'=>'BPJT',
		'jalan-tol'=>'Jalan Tol',
		'bujt'=>'BUJT',
		'info-tarif-tol'=>'Info Tarif Tol',
		'investasi'=>'Investasi',
		'progress-pembangunan'=>'Progress',
		'syarat-ketentuan'=>'Syarat dan Ketentuan',
		'tentang-kami'=>'Tentang Kami',
		'footer'=>'Footer',
		'telepon'=>'Telepon',
		'fax'=>'Fax',
		'email'=>'Email',
		'alamat'=>'Alamat'
	);
	public $sub_content_type_lib = array(
		''=>'',
		'bpjt' => array(
			'sekilas-bpjt'=>'Sekilas BPJT',
			'visi-misi'=>'Visi dan Misi',
			'struktur-organisasi'=>'Struktur Organisasi',
			'tugas-bpjt'=>'Tugas BPJT'
		),
		'jalan-tol' => array(
			'sejarah'=>'Sejarah',
			'tujuan-manfaat'=>'Tujuan dan Manfaat',
			'kebijakan-percepatan-pembangunan'=>'Kebijakan Percepatan Pembangunan',
			//'nama-ruas-tol'=>'Nama Ruas Tol',
			//'trafik-pengguna'=>'Trafik Pengguna',
		),
		'bujt' => array(),
		'info-tarif-tol' => array(),
		'investasi' => array(
			'prinsip-penyelenggaraan'=>'Prinsip Penyelenggaraan',
			'skema-investasi'=>'Skema Investasi',
			'tahapan-makro-pengusahaan-jalan-tol'=>'Tahapan Makro Pengusahaan Jalan Tol',
			'prosedur-investasi'=>'Prosedur Investasi'
		),
		'progress-pembangunan' => array(
			//'rencana'=>'Rencana',
			//'ruas-tol'=>'Ruas Tol',
			'progress'=>'Progress',
			'beroperasi'=>'Beroperasi',
			'jalan-tol-ppjt'=>'Jalan Tol PPJT',
			'tender-tender'=>'Tender-Tender',
			//'persiapan-tender'=>'Persiapan Tender'
		)
	);

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

	public function show($segment1, $segment2 = null, $segment3 = null) {
		$this->load->model(array('content', 'article', 'menu', 'media'));

		if ($segment1 == "en") {
			$slug = $segment1 . "/" . $segment2 . "/" . $segment3;
			$main_segment = $segment2;
			$sub_segment = $segment3;
		} else {
			$slug = $segment1 . "/" . $segment2;
			$main_segment = $segment1;
			$sub_segment = $segment2;
		}

		if (is_null($sub_segment)) {
			$menu = $this->menu->get_menu_by_slug($main_segment);
		} else {
			$menu = $this->menu->get_menu_by_slug($sub_segment);
		}

		$menus = $parent_menu = array();
		if (!empty($menu)) {
			$menu = $menu[0];
			$menus = array();
			if (!is_null($menu->parent_id)) {
				$menus = $this->menu->get_published_menu_by_parent_id($menu->parent_id);
			}

			$parent_menu = $this->menu->get_menu($menu->parent_id);
			if (!empty($parent_menu)) {
				$parent_menu = $parent_menu[0];
			}
		}

		$content = $this->cache->file->get('content_' . sha1($slug));
		if(!$content){
			$content = $this->content->get_content_by_slug($slug);
			
			$this->cache->file->save('content_' . sha1($slug), $content, 30);
		}

		$content_data = $this->cache->file->get('content_data');
		if(!$content_data){
			$content_data = [
				'newstickers' => $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang')),
				'newstickers2' => $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang')),
				'newstickers3' => $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang')),
				'popular_articles' => $this->article->get_popular_articles(3),
				'db_medias' => $this->media->get_published_medias(1, 8, $this->session->userdata('lang'))
			];

			$this->cache->file->save('content_data', $content_data, 30);
		}

		$stylesheets = array('video-js.css');
		$jscripts = array(
			'video.js'=>'vendor'
		);

		if (!empty($content)) {

			$content_media = $this->cache->file->get('content_media_' . $content[0]->id);
			if(!$content_media){
				$content_media = [
					'show_image' => $this->content->get_content_meta($content[0]->id, 'show_image'),
					'show_video' => $this->content->get_content_meta($content[0]->id, 'show_video'),
					'videos' => $this->content->get_content_meta($content[0]->id, 'video')
				];

				$this->cache->file->save('content_media_' . $content[0]->id, $content_media, 30);
			}

			$data = array(
				'content' => $this->load->view('contents/show-new', array('content'=>$content[0], 'menus'=>$menus, 'newstickers'=>$content_data['newstickers'], 'newstickers2'=>$content_data['newstickers2'], 'newstickers3'=>$content_data['newstickers3'], 'parent_menu'=>$parent_menu, 'show_image'=>$content_media['show_image'], 'show_video'=>$content_media['show_video'], 'videos'=>$content_media['videos'], 'popular_articles'=>$content_data['popular_articles'], 'main_segment'=>$main_segment, 'sub_segment'=>$sub_segment), true),
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$content_data['db_medias']
			);
			$this->load->view('layouts/content-new.php', $data);
		} else {
			$data = array(
				'stylesheets'=>$stylesheets,
				'jscripts'=>$jscripts,
				'galleries'=>$content_data['db_medias'],
				'popular_articles'=>$content_data['popular_articles']
			);
			$this->load->view('layouts/404.php', $data);
		}
	}

	public function contact_us() {
		$this->load->model(array('article', 'media'));

		$stylesheets = array();
		$jscripts = array();
		$popular_articles = $this->article->get_popular_articles(3);
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
		$data = array(
			'content' => $this->load->view('contents/contact_us', array('popular_articles'=>$popular_articles), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content.php', $data);
	}

	public function sitemap() {
		$this->load->model(array('article', 'media'));

		$stylesheets = array();
		$jscripts = array();
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$popular_articles = $this->article->get_popular_articles(3);
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
		$data = array(
			'content' => $this->load->view('contents/sitemap', array('popular_articles'=>$popular_articles, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content.php', $data);
	}

	public function pdf($segment1, $segment2=null, $segment3=null) {
		$this->load->model('content');
		$this->load->helper('text');

		if ($segment1 == 'en') {
			$slug = $segment1 . "/" . $segment2 . "/" . $segment3;
		} else {
			$slug = $segment1 . "/" . $segment2;
		}

		$content = $this->content->get_content_by_slug($slug);
		if (!empty($content)) {	
			$jscripts = array();
			$stylesheets = array();

			$show_image = $this->content->get_content_meta($content[0]->id, 'show_image');

			require_once(dirname(__FILE__).'/../libraries/WkHtmlToPdf.php');
			//$table = $_POST['table_structure'];
			$pdf_content = "<h1>" . $content[0]->title . "</h1>";
			if (!empty($show_image)) { 
				if ($show_image[0]->meta_value == 'yes' && isset($content->image_name)) {
					$pdf_content .= "<img src='" . $this->media->get_image_by_style($content[0]->image_name, 'pn640') . "' />";
					$pdf_content .= "<br />";
				}
			}
			$pdf_content .= $content[0]->content;

			$pdf = new WkHtmlToPdf(array('bin'=>$this->config->item('wkhtmltopdf')));
			// Add a HTML file, a HTML string or a page from a URL
			$pdf->addPage("<html>" . $pdf_content . "</html>");

			// ... or send to client as file download
			if (!$pdf->send())
				throw new Exception('Could not create PDF: '.$pdf->getError());
		} else {
			redirect("/");
		}
	}
	
	public function notfound() {
		$this->load->view('layouts/404.php');
	}
}