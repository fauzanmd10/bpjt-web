<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Accesses extends CI_Controller {
	private $access_keys = array(
		'knowledge_center', 'artikel_berita', 'artikel_pengumuman', 'artikel_kategori_berita', 'artikel_sub_kategori_berita', 'konten_dinamis',
		'spm_klasifikasi', 'spm_penilaian', 'spm_keterangan_penilaian', 'spm_keterangan_definisi', 'spm_keterangan_rekapitulasi',
		'info_tarif_tol_konten', 'info_tarif_tol_golongan_kendaraan', 'info_tarif_tol_ruas_tol', 'info_tarif_tol_gerbang_tol', 'info_tarif_tol',
		'peraturan', 'konten_statis_syarat_ketentuan', 'konten_statis_tentang_kami', 'konten_statis_footer', 'konten_statis_telepon', 'konten_statis_fax', 'konten_statis_email', 'konten_statis_alamat', 'situs_terkait',
		'album_foto', 'galeri_foto', 'album_video', 'galeri_video', 'peluang_investasi', 'kalender_rapat', 'log', 
		'progres_konstruksi_daftar_bujt', 'progres_konstruksi_ruas_tol', 'progres_konstruksi_segment_ruas_tol', 'progres_konstruksi',
		'kepegawaian_sistem_informasi_kepegawaian', 'kepegawaian_propinsi', 'kepegawaian_kecamatan', 'kepegawaian_kabupaten', 
		'manajemen_aset_instansi', 'manajemen_aset_jenis_merk', 'manajemen_aset_jenis_inventaris', 'manajemen_aset_satuan_ukur', 'manajemen_aset_bangunan', 'manajemen_aset_ruang_bangunan', 'manajemen_aset_inventaris', 'manajemen_aset_inventaris_bangunan', 'perkantoran',
		'pengguna_grup_pengguna', 'hak_akses_pengguna'
	);
	public $user_access;

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('hak_akses_pengguna', $this->session->userdata('user_group_id'));
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
			'#' => 'Pengguna',
			'' => 'Hak Akses Pengguna'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.user-access.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Hak Akses Pengguna'), true),
			'content' => $this->load->view('admin/user_accesses/index', null, true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id) {
		$this->load->model(array('access', 'user_group', 'comment'));
		
		$breadcrumbs = array(
			'#' => 'Pengguna',
			'admin/user_accesses' => 'Hak Akses Pengguna',
			'' => 'Lihat Hak Akses'
		);
		$accesses = $this->access->get_user_accesses_by_group($id);

		if (!empty($accesses)) {
			$user_group = $this->user_group->get_user_group_by_id($id);
			$user_group = $user_group[0];
			$user_access = array('name'=>$user_group->name, 'access'=>array());

			foreach($accesses as $access) {
				$user_access['access'][$access->access_key] = array();
				if ($access->single) {
					$user_access['access'][$access->access_key]['single'] = '1';
				}

				if ($access->add) {
					$user_access['access'][$access->access_key]['add'] = '1';
				}

				if ($access->edit) {
					$user_access['access'][$access->access_key]['edit'] = '1';
				}

				if ($access->destroy) {
					$user_access['access'][$access->access_key]['destroy'] = '1';
				}
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Lihat Hak Akses Pengguna'), true),
				'content' => $this->load->view('admin/user_accesses/show', array('user_access'=>$user_access, 'flash'=>$this->session->flashdata('user_access_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value=null) {
		$this->load->model(array('access', 'user_group', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Pengguna',
			'admin/user_accesses' => 'Hak Akses Pengguna',
			'' => 'Tambah Hak Akses'
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
		$stylesheets = array('admin.user-access.form.css');
		
		$user_access = null;
		if (isset($filled_value)) {
			$user_access = $filled_value;
		}
		$db_user_groups = $this->user_group->get_published_user_groups();
		$user_groups = array();
		foreach($db_user_groups as $user_group) {
			$user_groups[$user_group->id] = $user_group->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Tambah Hak Akses Pengguna'), true),
			'content' => $this->load->view('admin/user_accesses/add', array('user_access'=>$user_access, 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create() {
		if ($this->input->post()) {

			$this->load->model(array('access', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|callback_check_user_group');
			$this->form_validation->set_message('check_user_group', 'Akses untuk grup pengguna sudah terdaftar.');

			if ($this->form_validation->run()) {
				$user_group_id = $this->input->post('user_group_id',true);
				$accesses = $this->input->post('access',true);

				foreach($this->access_keys as $access_key) {
					if (!array_key_exists($access_key, $accesses)) {
						$data = array(
							'access_key'=>$access_key,
							'index'=>0,
							'single'=>0,
							'add'=>0,
							'edit'=>0,
							'destroy'=>0,
							'user_group_id'=>$user_group_id,
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);
						$this->access->insert($data);
					}
				}

				foreach ($accesses as $key => $value) {
					$data = array(
						'access_key'=>$key,
						'index'=>(array_key_exists('single', $value)) ? $value['single'] : 0,
						'single'=>(array_key_exists('single', $value)) ? $value['single'] : 0,
						'add'=>(array_key_exists('add', $value)) ? $value['add'] : 0,
						'edit'=>(array_key_exists('edit', $value)) ? $value['edit'] : 0,
						'destroy'=>(array_key_exists('destroy', $value)) ? $value['destroy'] : 0,
						'user_group_id'=>$user_group_id,
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);
					$this->access->insert($data);
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'accesses', $user_group_id, 'Pengguna menambah data hak akses pengguna');

				$this->session->set_flashdata('user_access_success', true);
				redirect('admin/user_accesses/show/' . $this->input->post('user_group_id',true));
			} else {
				$this->add($this->input->post());
			}
			
		}
	}

	public function edit($id, $filled_value=null) {
		$this->load->model(array('access', 'user_group', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'Pengguna',
			'admin/user_accesses' => 'Hak Akses Pengguna',
			'' => 'Ubah Hak Akses'
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
		$stylesheets = array('admin.user-access.form.css');
		
		if (isset($filled_value)) {
			$user_access = $filled_value;
		} else {
			$temp_user_accesses = $this->access->get_user_accesses_by_group($id);
			$user_access = array();
			foreach($temp_user_accesses as $access) {
				$user_access['user_group_id'] = $access->user_group_id;
				$user_access['access'][$access->access_key] = array();
				if ($access->single) {
					$user_access['access'][$access->access_key]['single'] = '1';
				}

				if ($access->add) {
					$user_access['access'][$access->access_key]['add'] = '1';
				}

				if ($access->edit) {
					$user_access['access'][$access->access_key]['edit'] = '1';
				}

				if ($access->destroy) {
					$user_access['access'][$access->access_key]['destroy'] = '1';
				}
			}
		}
		$db_user_groups = $this->user_group->get_published_user_groups();
		$user_groups = array();
		foreach($db_user_groups as $user_group) {
			$user_groups[$user_group->id] = $user_group->name;
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'PENGATURAN', 'title' => 'Ubah Hak Akses Pengguna'), true),
			'content' => $this->load->view('admin/user_accesses/edit', array('user_access'=>$user_access, 'id'=>$id, 'user_groups'=>$user_groups), true),
			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function update($id) {
		if ($this->input->post()) {
			$this->load->model(array('access', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|callback_check_user_group_update');
			$this->form_validation->set_message('check_user_group_update', 'Akses untuk grup pengguna sudah terdaftar.');

			if ($this->form_validation->run()) {
				$old_user_group_id = $this->input->post('old_user_group_id',true);
				$user_group_id = $this->input->post('user_group_id',true);
				$accesses = $this->input->post('access',true);

				$this->access->destroy($old_user_group_id);

				foreach($this->access_keys as $access_key) {
					if (!array_key_exists($access_key, $accesses)) {
						$data = array(
							'access_key'=>$access_key,
							'index'=>0,
							'single'=>0,
							'add'=>0,
							'edit'=>0,
							'destroy'=>0,
							'user_group_id'=>$user_group_id,
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);
						$this->access->insert($data);
					}
				}

				foreach ($accesses as $key => $value) {
					$data = array(
						'access_key'=>$key,
						'index'=>(array_key_exists('single', $value)) ? $value['single'] : 0,
						'single'=>(array_key_exists('single', $value)) ? $value['single'] : 0,
						'add'=>(array_key_exists('add', $value)) ? $value['add'] : 0,
						'edit'=>(array_key_exists('edit', $value)) ? $value['edit'] : 0,
						'destroy'=>(array_key_exists('destroy', $value)) ? $value['destroy'] : 0,
						'user_group_id'=>$user_group_id,
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					);
					$this->access->insert($data);
				}

				$this->user_log->add_log($this->session->userdata('user_id'), 'accesses', $user_group_id, 'Pengguna mengubah data hak akses pengguna');

				$this->session->set_flashdata('user_access_success', true);
				redirect('admin/user_accesses/show/' . $this->input->post('user_group_id',true));
			} else {
				$this->edit($id, $this->input->post());
			}
		}
	}

	public function destroy() {
		if ($this->input->post()) {
			$this->load->model(array('access', 'user_log'));
			$user_group_ids = $this->input->post('user_group_ids',true);
			foreach($user_group_ids as $user_group_id) {
				$this->access->destroy($user_group_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'accesses', $user_group_id, 'Pengguna menghapus data hak akses pengguna');
			}
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail', 'code'=>0));
		}
	}

	public function api_get_all_user_accesses() {
		$this->load->model('access');

		$user_accesses = $this->access->get_user_accesses();

		$ret_user_accesses = array();
		$no = 1;
		foreach($user_accesses as $user_access) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $user_access->id . "\" id=\"checker-" . $user_access->id . "\" /></span></div></span>";
			$created_at = strtotime($user_access->created_at);
    		$updated_at = strtotime($user_access->updated_at);

			$temp_user_access = array($checkbox, $no, $user_access->name, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at));
			array_push($ret_user_accesses, $temp_user_access);
			$no++;
		}
		$json = array('aaData'=>$ret_user_accesses);

		echo json_encode($json);
	}

	public function check_user_group() {
		$this->load->model('access');

		$accesses = $this->access->get_user_accesses_by_group($this->input->post('user_group_id',true));
		if (empty($accesses)) {
			return true;
		} else {
			return false;
		}
	}

	public function check_user_group_update() {
		if ($this->input->post('old_user_group_id',true) != $this->input->post('user_group_id',true)) {
			$this->load->model('access');

			$accesses = $this->access->get_user_accesses_by_group($this->input->post('user_group_id',true));
			if (empty($accesses)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

}