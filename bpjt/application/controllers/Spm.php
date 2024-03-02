<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm extends CI_Controller {

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
		$this->load->model(array('toll_road', 'media'));
		$this->load->helper('form');

		$jscripts = array(
			'spm-report-2.js'=>'application',
		);
		$stylesheets = array();

		$db_toll_roads = $this->toll_road->get_published_toll_roads();
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$toll_roads = array(0=>'Pilih Ruas');
		foreach($db_toll_roads as $toll_road) {
			$toll_roads[$toll_road->id] = $toll_road->name;
		}
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$data = array(
			'content' => $this->load->view('spm/index-new', array('toll_roads'=>$toll_roads, 'newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content-new.php', $data);
	}

	public function recap() {
		$this->load->model(array('document', 'article', 'media'));

		$jscripts = array();
		$stylesheets = array();

		$entry = 10;
		$page = ($this->input->get('page', TRUE)) ? intval($this->input->get('page', TRUE)) : 1;
		$newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
		$newstickers2 = $this->content->get_published_contents_by_content_type_news1('pengumuman', $this->session->userdata('lang'));
		$newstickers3 = $this->content->get_published_contents_by_content_type_news2('pengumuman', $this->session->userdata('lang'));
		$documents = $this->document->get_published_spm($page, $entry);
		$count_spm = $this->document->count_published_spm();
		$total_page = floor($count_spm/$entry);
		if ($count_spm % $entry > 0 || $count_spm == 0) {
			$total_page++;
		}
		$db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));

		$data = array(
			'content' => $this->load->view('spm/recap', array('newstickers'=>$newstickers, 'newstickers2'=>$newstickers2, 'newstickers3'=>$newstickers3, 'documents'=>$documents, 'popular_articles'=>$this->article->get_popular_articles(3), 'count_spm'=>$count_spm, 'page'=>$page, 'total_page'=>$total_page), true),
			'stylesheets'=>$stylesheets,
			'jscripts'=>$jscripts,
			'galleries'=>$db_medias
		);
		$this->load->view('layouts/content.php', $data);
	}

	private function search_array($array, $value) {
		$found = false;
		$idx = 0;
		while(!$found && $idx < count($array)) {

			$idx++;
		}

		if (!$found) {
			return false;
		} else {
			return $idx;
		}
	}

	public function get_spm_report() {
		$this->load->model(array('spm_report'));

		$toll_road_id = clean_str($this->input->get('toll_road_id', TRUE));
		$semester = clean_str($this->input->get('semester', TRUE));
		$year = clean_str($this->input->get('year', TRUE));

		$db_spm_reports = $this->spm_report->get_spm_report_by_parameter($toll_road_id, $year, $semester);
		if (empty($db_spm_reports)) {
			$retval = array('status'=>'fail');
		} else {
			$spm_reports = array();
			foreach($db_spm_reports as $spm_report) {
				$spm_reports[$spm_report->key]['condition'] = $spm_report->condition;
				$spm_reports[$spm_report->key]['remarks'] = $spm_report->remarks;
			}
			
			$retval = array('status'=>'success', 'report'=>$spm_reports);
		}

		echo json_encode($retval);
	}

	public function spmtosession() {
		if (isset($_POST)) {
			session_start();
			$_SESSION['toll_road_id'] = clean_str($this->input->post('toll_road_id', TRUE));
			$_SESSION['semester'] = clean_str($this->input->post('semester', TRUE));
			$_SESSION['year'] = clean_str($this->input->post('year', TRUE));

			echo json_encode(array('status'=>'success'));
		}
	}

	public function spmtopdf() {
		session_start();
		if (isset($_SESSION['toll_road_id'])) {
			$this->load->model('spm_report');

			require_once(dirname(__FILE__).'/../libraries/WkHtmlToPdf.php');
			//$table = $_POST['table_structure'];
			$toll_road_id = $_SESSION['toll_road_id'];
			$semester = $_SESSION['semester'];
			$year = $_SESSION['year'];

			$pdf = new WkHtmlToPdf(array('bin'=>$this->config->item('wkhtmltopdf')));
			// Add a HTML file, a HTML string or a page from a URL

			$db_spm_reports = $this->spm_report->get_spm_report_by_parameter($toll_road_id, $year, $semester);
			$spm_reports = array();
			foreach($db_spm_reports as $spm_report) {
				$spm_reports[$spm_report->key]['condition'] = $spm_report->condition;
				$spm_reports[$spm_report->key]['remarks'] = $spm_report->remarks;
			}

			$table = "
			<h4>1. Kondisi Jalan Tol</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th class=\"head0\" style='border:1px solid #000;'>No.</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th class=\"head0\" style='border:1px solid #000;'>Kondisi Saat Ini</th>
			            <th class=\"head0\" style='border:1px solid #000;'>Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Kekesatan</td>
			        	<td style='border:1px solid #000;'>&gt;0,33 µm</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_kekesatan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_kekesatan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Kerataan</td>
			        	<td style='border:1px solid #000;'>IRI &lt; 4 m/km</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_kerataan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_kerataan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Lubang</td>
			        	<td style='border:1px solid #000;'>100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_lubang']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_lubang']['remarks']}</td>
			        </tr>
                                <tr>
			        	<td style='border:1px solid #000;'>d</td>
			        	<td style='border:1px solid #000;'>Rutting</td>
			        	<td style='border:1px solid #000;'>100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_rutting']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_rutting']['remarks']}</td>
			        </tr>
                                <tr>
			        	<td style='border:1px solid #000;'>e</td>
			        	<td style='border:1px solid #000;'>Retak/Crack</td>
			        	<td style='border:1px solid #000;'>100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_retak']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kondisi_jalan_tol_retak']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>2. Kecepatan Tempuh Rata-Rata</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Kecepatan Tempuh Rata-Rata</td>
			        	<td style='border:1px solid #000;'>&gt;1,80 kali kecepatan non tol (jalan tol luar kota), &lt;1,60 kali kecepatan non tol (jalan tol dalam kota)</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kecepatan_tempuh']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['kecepatan_tempuh']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>3. Aksesibilitas</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Kecepatan Rata-Rata Transaksi</td>
			        	<td style='border:1px solid #000;'>
			                Terbuka<br />
			                &lt; 8 detik setiap Kendaraaan<br/><br/>

			                Tertutup<br/>
			                Gardu Masuk<br/>
			                &lt; 7 detik setiap Kendaraan<br/><br/>

			                Gardu Keluar<br/>
			                &lt; 11 detik setiap kendaraan
			            </td>
			        	<td style='border:1px solid #000;'>{$spm_reports['aksesibilitas_kecepatan_transaksi']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['aksesibilitas_kecepatan_transaksi']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Kapasitas Gardu Tol</td>
			        	<td style='border:1px solid #000;'>&lt; 450 kendaraan per jam per Gardu</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['aksesibilitas_kapasitas_gardu']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['aksesibilitas_kapasitas_gardu']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>4. Mobilitas (Kecepatan Penanganan Hambatan Lalu Lintas)</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Wilayah pengamatan/observasi patroli</td>
			        	<td style='border:1px solid #000;'>30 menit per siklus pengamatan</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_wilayah_patroli']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_wilayah_patroli']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Mulai informasi diterima sampai tempat kejadian</td>
			        	<td style='border:1px solid #000;'>&lt; 30 menit</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_informasi']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_informasi']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Penanganan akibat kendaraan mogok</td>
			        	<td style='border:1px solid #000;'>Melakukan penderekan ke Pintu Gerbang Tol terdekat</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_kendaraan_mogok']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_kendaraan_mogok']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>d</td>
			        	<td style='border:1px solid #000;'>Patroli kendaraan derek</td>
			        	<td style='border:1px solid #000;'>30 menit per siklus pengamatan</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_derek']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['mobilitas_derek']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>5. Keselamatan</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Perambuan</td>
			        	<td style='border:1px solid #000;'>Kelengkapan dan Kejelasan 100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_perambuan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_perambuan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Marka jalan</td>
			        	<td style='border:1px solid #000;'>Jumlah 100 % dan Reflektifitas &gt; 80%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_marka_jalan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_marka_jalan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Guide post dan reflector</td>
			        	<td style='border:1px solid #000;'>Jumlah 100 % dan Reflektifitas &gt; 80%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_guide_post']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_guide_post']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>d</td>
			        	<td style='border:1px solid #000;'>Patok KM</td>
			        	<td style='border:1px solid #000;'>100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_patok_km']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_patok_km']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>e</td>
			        	<td style='border:1px solid #000;'>Penerangan Jalan Umum</td>
			        	<td style='border:1px solid #000;'>Lampu Menyala 100%</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_penerangan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_penerangan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>f</td>
			        	<td style='border:1px solid #000;'>Pagar rumija</td>
			        	<td style='border:1px solid #000;'>Keberadaan 100%</td>
			        	<td style='border:1px solid #000;' style='border:1px solid #000;'>{$spm_reports['keselamatan_pagar_rumija']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_pagar_rumija']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>g</td>
			        	<td style='border:1px solid #000;'>Penanganan kecelakaan</td>
			        	<td style='border:1px solid #000;'>Melakukan penderekan gratis sampai ke pool derek</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_penanganan_kecelakaan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_penanganan_kecelakaan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>h</td>
			        	<td style='border:1px solid #000;'>Pengamanan dan penegakan hukum</td>
			        	<td style='border:1px solid #000;'>Keberadaan Polisi Patroli Jalan Raya (PJR) yang siap panggil 24 jam</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_pengamanan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['keselamatan_pengamanan']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>6. Unit Pertolongan/Penyelamatan dan Bantuan Pelayanan</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Ambulan</td>
			        	<td style='border:1px solid #000;'>1 Unit per 25 km atau minimum 1 unit</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_ambulan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_ambulan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Kendaraan Derek</td>
			        	<td style='border:1px solid #000;'>1 Unit per 5 km atau minimum 1 unit (LHR &gt; 100.000) 1 Unit per 10 km atau minimum 1 unit (LHR ≤ 100.000)</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_derek']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_derek']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Polisi PJR</td>
			        	<td style='border:1px solid #000;'>1 Unit per 15 km atau minimum 1 unit (LHR &gt; 100.000) 1 Unit per 20 km atau minimum 1 unit (LHR ≤ 100.000)</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_polisi_pjr']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_polisi_pjr']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>d</td>
			        	<td style='border:1px solid #000;'>Patroli jalan raya (operator)</td>
			        	<td style='border:1px solid #000;'>1 Unit per 15 km atau minimum 2 unit</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_patroli']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_patroli']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>e</td>
			        	<td style='border:1px solid #000;'>Rescue</td>
			        	<td style='border:1px solid #000;'>1 Unit per ruas Jalan Tol (dilengkapi dengan peralatan penyelamatan)</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_rescue']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_rescue']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>f</td>
			        	<td style='border:1px solid #000;'>Sistem informasi</td>
			        	<td style='border:1px solid #000;'>Setiap Gerbang Masuk</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_sistem_informasi']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['pertolongan_sistem_informasi']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />

			<h4>7. Lingkungan</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Kebersihan</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_kebersihan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_kebersihan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>Tanaman</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_tanaman']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_tanaman']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Rumput</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_rumput']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['lingkungan_rumput']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />
                        
			<h4>8. TI & TIP</h4>
			<table id=\"kondisi-jalan-tol\" class=\"table table-bordered responsive\" style='width:100%;border:1px solid #000;' cellpadding='7'>
			    <thead>
			        <tr>
			            <th style='border:1px solid #000;' class=\"head0\">No.</th>
			            <th style='border:1px solid #000;' class=\"head1\">Indikator</th>
			            <th class=\"head1\" style='border:1px solid #000;'>Tolak Ukur</th>
			            <th style='border:1px solid #000;' class=\"head0\">Kondisi Saat Ini</th>
			            <th style='border:1px solid #000;' class=\"head0\">Keterangan</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        	<td style='border:1px solid #000;'>a</td>
			        	<td style='border:1px solid #000;'>Kondisi Jalan</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_jalan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_jalan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>b</td>
			        	<td style='border:1px solid #000;'>On/Off Ramp</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_ramp']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_ramp']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>c</td>
			        	<td style='border:1px solid #000;'>Toilet</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_toilet']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_toilet']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>d</td>
			        	<td style='border:1px solid #000;'>Parkir Kendaraan</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_parkir']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_parkir']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>e</td>
			        	<td style='border:1px solid #000;'>Penerangan</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_penerangan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_penerangan']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>f</td>
			        	<td style='border:1px solid #000;'>Stasiun Pengisian Bahan Bakar</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_stasiun']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_stasiun']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>g</td>
			        	<td style='border:1px solid #000;'>Bengkel Umum</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_bengkel']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_bengkel']['remarks']}</td>
			        </tr>
			        <tr>
			        	<td style='border:1px solid #000;'>h</td>
			        	<td style='border:1px solid #000;'>Tempat Makan & Minum</td>
			        	<td style='border:1px solid #000;'></td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_makan']['condition']}</td>
			        	<td style='border:1px solid #000;'>{$spm_reports['ti_makan']['remarks']}</td>
			        </tr>
			    </tbody>
			</table>
			<br />
			";

			$pdf->addPage("<html>" . $table . "</html>");
			unset($_SESSION['toll_road_id']);
			unset($_SESSION['semester']);
			unset($_SESSION['year']);

			// ... or send to client as file download
			if (!$pdf->send())
				throw new Exception('Could not create PDF: '.$pdf->getError());
		} else {
			redirect('/');
		}
	}

}