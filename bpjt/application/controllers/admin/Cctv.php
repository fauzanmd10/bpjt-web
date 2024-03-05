<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cctv extends CI_Controller
{
	public $user_access;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('konten_dinamis', $this->session->userdata('user_group_id'));
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
			echo json_encode(array('status' => 'fail', 'code' => 1));
			exit;
		}
	}

	public function index()
	{
		$this->load->model('comment');

		$breadcrumbs = array(
			'#' => 'CCTV',
			'' => 'CCTV'
		);

		//$this->menu->print_admin_menu();

		$jscripts = array(
			'elements.js' => 'application',
			'prettify/prettify.js' => 'vendor',
			'jquery.jgrowl.js' => 'vendor',
			'jquery.alerts.js' => 'vendor',
			'jquery.dataTables.min.js' => 'vendor',
			'admin.cctv.index.js' => 'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'CCTV', 'title' => 'CCTV'), true),
			// 'content' => $this->load->view('admin/cctv/index', array('flash'=>$this->session->flashdata('menus_success')), true),
			'content' => $this->load->view('admin/cctv/index', array('flash' => $this->session->flashdata('menus_success')), true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);

		$this->load->view('layouts/admin_content.php', $data);
	}

	public function show($id)
	{
		$this->load->model(array('cctv_model', 'comment'));

		$breadcrumbs = array(
			'#' => 'CCTV',
			'admin/menus' => 'CCTV',
			'' => 'Lihat CCTV'
		);

		$cctv = $this->cctv_model->get_first_cctv($id);
		if (count($cctv) > 0) {
			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'CCTV', 'title' => 'Lihat CCTV'), true),
				'content' => $this->load->view('admin/cctv/show', array('cctv' => $cctv[0], 'flash' => $this->session->flashdata('cctv_success')), true),
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function add($filled_value = null)
	{
		$this->load->model(array('cctv_model', 'comment'));
		$this->load->helper('form');

		$breadcrumbs = array(
			'#' => 'CCTV',
			'admin/menus' => 'CCTV',
			'' => 'Tambah CCTV'
		);

		$jscripts = array(
			'jquery.validate.min.js' => 'vendor',
			'jquery.tagsinput.min.js' => 'vendor',
			'jquery.autogrow-textarea.js' => 'vendor',
			'charCount.js' => 'vendor',
			'ui.spinner.min.js' => 'vendor',
			'chosen.jquery.min.js' => 'vendor',
			'forms.js' => 'vendor',
			'tinymce/jquery.tinymce.js' => 'vendor',
			'wysiwyg.js' => 'vendor'
		);

		$stylesheets = array('admin.album.form.css');

		$cctv = (object)array();
		if (isset($filled_value)) {
			$cctv->id_ruas = $filled_value['id_ruas'];
			$cctv->nama_ruas = $filled_value['nama_ruas'];
			$cctv->nama_cctv = $filled_value['nama_cctv'];
			$cctv->bujt = $filled_value['bujt'];
			$cctv->bujt_nama = $filled_value['bujt_nama'];
			$cctv->stream = $filled_value['stream'];
			$cctv->protocol = $filled_value['protocol'];
			$cctv->status = $filled_value['status'] ?? '';
			$cctv->lat = $filled_value['lat'];
			$cctv->long = $filled_value['long'];
		}

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			// 'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'CCTV', 'title' => 'Tambah CCTV'), true),
			'content' => $this->load->view('admin/cctv/add', array('cctv' => $cctv), true),
			'content' => $this->load->view('admin/form_toll/add', array('cctv' => $cctv), true),

			'jscripts' => $jscripts,
			'stylesheets' => $stylesheets,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function create()
	{
		if ($this->input->post()) {
			$this->load->model(array('cctv_model', 'user_log'));
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id_ruas', 'ID Ruas', 'trim|callback_check_id_ruas');
			$this->form_validation->set_rules('nama_ruas', 'Nama Ruas', 'trim|callback_check_nama_ruas');
			$this->form_validation->set_rules('nama_cctv', 'Nama CCTV', 'trim|callback_check_nama_cctv');
			$this->form_validation->set_rules('bujt', 'BUJT', 'trim|callback_check_bujt');
			$this->form_validation->set_rules('bujt_nama', 'Nama BUJT', 'trim|callback_check_bujt_nama');
			$this->form_validation->set_rules('stream', 'Stream URL', 'trim|callback_check_stream');
			$this->form_validation->set_rules('protocol', 'Protocol', 'trim|callback_check_protocol');
			$this->form_validation->set_rules('status', 'Status', 'trim|callback_check_status');
			$this->form_validation->set_rules('lat', 'Lat', 'trim|callback_check_lat');
			$this->form_validation->set_rules('long', 'Long', 'trim|callback_check_long');

			$this->form_validation->set_message('check_id_ruas', 'ID Ruas harus terisi.');
			$this->form_validation->set_message('check_nama_ruas', 'Nama Ruas harus terisi.');
			$this->form_validation->set_message('check_nama_cctv', 'Nama CCTV harus terisi.');
			$this->form_validation->set_message('check_bujt', 'BUJT harus terisi.');
			$this->form_validation->set_message('check_bujt_nama', 'Nama BUJT harus terisi.');
			$this->form_validation->set_message('check_stream', 'Stream harus terisi.');
			$this->form_validation->set_message('check_protocol', 'Protocol harus terisi.');
			$this->form_validation->set_message('check_status', 'Status harus terisi.');
			$this->form_validation->set_message('check_lat', 'Lat harus terisi.');
			$this->form_validation->set_message('check_long', 'Long harus terisi.');

			if ($this->form_validation->run()) {
				$data = array(
					'id_ruas' => $this->input->post('id_ruas', true),
					'nama_ruas' => $this->input->post('nama_ruas', true),
					'nama_cctv' => $this->input->post('nama_cctv', true),
					'bujt' => $this->input->post('bujt', true),
					'bujt_nama' => $this->input->post('bujt_nama', true),
					'stream' => $this->input->post('stream', true),
					'protocol' => $this->input->post('protocol', true),
					'status' => $this->input->post('status', true),
					'lat' => $this->input->post('lat', true),
					'long' => $this->input->post('long', true),
				);

				$this->cctv_model->insert($data);
				$cctv_id = $this->db->insert_id();

				$this->user_log->add_log($this->session->userdata('user_id'), 'cctv', $cctv_id, 'Pengguna menambah data menu');

				$this->session->set_flashdata('cctv_success', true);
				redirect('admin/cctv/show/' . $cctv_id);
			} else {
				$this->add($this->input->post());
			}
		}
	}

	public function edit($id, $filled_value = null)
	{
		$this->load->model(array('cctv_model', 'comment'));
		$this->load->helper('form');

		$cctv = $this->cctv_model->get_first_cctv($id);

		if (count($cctv) > 0) {
			$breadcrumbs = array(
				'#' => 'CCTV',
				'admin/cctv' => 'CCTV',
				'' => 'Ubah CCTV'
			);
			$jscripts = array(
				'jquery.validate.min.js' => 'vendor',
				'jquery.tagsinput.min.js' => 'vendor',
				'jquery.autogrow-textarea.js' => 'vendor',
				'charCount.js' => 'vendor',
				'ui.spinner.min.js' => 'vendor',
				'chosen.jquery.min.js' => 'vendor',
				'forms.js' => 'vendor',
				'tinymce/jquery.tinymce.js' => 'vendor',
				'wysiwyg.js' => 'vendor'
			);
			$stylesheets = array('admin.album.form.css');

			if (isset($filled_value)) {
				$cctv[0]->id_ruas = $filled_value['id_ruas'];
				$cctv[0]->nama_ruas = $filled_value['nama_ruas'];
				$cctv[0]->nama_cctv = $filled_value['nama_cctv'];
				$cctv[0]->bujt = $filled_value['bujt'];
				$cctv[0]->bujt_nama = $filled_value['bujt_nama'];
				$cctv[0]->stream = $filled_value['stream'];
				$cctv[0]->protocol = $filled_value['protocol'];
				$cctv[0]->status = $filled_value['status'];
				$cctv[0]->lat = $filled_value['lat'];
				$cctv[0]->long = $filled_value['long'];
			}

			$data = array(
				'menu' => $this->load->view('layouts/admin_menu', null, true),
				'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'CCTV', 'title' => 'Ubah CCTV'), true),
				'content' => $this->load->view('admin/cctv/edit', array('cctv' => $cctv[0], 'id' => $id), true),
				'jscripts' => $jscripts,
				'stylesheets' => $stylesheets,
				'unread_comments' => $this->comment->get_total_unread_comments()
			);
			$this->load->view('layouts/admin_content.php', $data);
		} else {
			redirect('admin');
		}
	}

	public function update($id)
	{
		if ($this->input->post()) {
			$this->load->model(array('cctv_model', 'content', 'user_log'));
			$this->load->library('form_validation');

			$cctv = $this->cctv_model->get_first_cctv($id);

			if (count($cctv) > 0) {
				$this->form_validation->set_rules('id_ruas', 'ID Ruas', 'trim|callback_check_id_ruas');
				$this->form_validation->set_rules('nama_ruas', 'Nama Ruas', 'trim|callback_check_nama_ruas');
				$this->form_validation->set_rules('nama_cctv', 'Nama CCTV', 'trim|callback_check_nama_cctv');
				$this->form_validation->set_rules('bujt', 'BUJT', 'trim|callback_check_bujt');
				$this->form_validation->set_rules('bujt_nama', 'Nama BUJT', 'trim|callback_check_bujt_nama');
				$this->form_validation->set_rules('stream', 'Stream URL', 'trim|callback_check_stream');
				$this->form_validation->set_rules('protocol', 'Protocol', 'trim|callback_check_protocol');
				$this->form_validation->set_rules('status', 'Status', 'trim|callback_check_status');
				$this->form_validation->set_rules('lat', 'Lat', 'trim|callback_check_lat');
				$this->form_validation->set_rules('long', 'Long', 'trim|callback_check_long');

				$this->form_validation->set_message('check_id_ruas', 'ID Ruas harus terisi.');
				$this->form_validation->set_message('check_nama_ruas', 'Nama Ruas harus terisi.');
				$this->form_validation->set_message('check_nama_cctv', 'Nama CCTV harus terisi.');
				$this->form_validation->set_message('check_bujt', 'BUJT harus terisi.');
				$this->form_validation->set_message('check_bujt_nama', 'Nama BUJT harus terisi.');
				$this->form_validation->set_message('check_stream', 'Stream harus terisi.');
				$this->form_validation->set_message('check_protocol', 'Protocol harus terisi.');
				$this->form_validation->set_message('check_status', 'Status harus terisi.');
				$this->form_validation->set_message('check_lat', 'Lat harus terisi.');
				$this->form_validation->set_message('check_long', 'Long harus terisi.');

				if ($this->form_validation->run()) {
					$data = array(
						'id_ruas' => $this->input->post('id_ruas', true),
						'nama_ruas' => $this->input->post('nama_ruas', true),
						'nama_cctv' => $this->input->post('nama_cctv', true),
						'bujt' => $this->input->post('bujt', true),
						'bujt_nama' => $this->input->post('bujt_nama', true),
						'stream' => $this->input->post('stream', true),
						'protocol' => $this->input->post('protocol', true),
						'status' => $this->input->post('status', true),
						'lat' => $this->input->post('lat', true),
						'long' => $this->input->post('long', true),
					);

					$this->cctv_model->update($id, $data);

					$this->user_log->add_log($this->session->userdata('user_id'), 'cctv', $id, 'Pengguna mengubah data cctv');

					$this->session->set_flashdata('cctv_success', true);
					redirect('admin/cctv/show/' . $id);
				} else {
					$this->edit($id, $this->input->post());
				}
			} else {
				redirect('admin');
			}
		}
	}

	public function update_status($id)
	{
		$this->load->model(array('cctv_model', 'user_log'));

		$cctv = $this->cctv_model->get_first_cctv($id);
		$cctv = $cctv[0];
		if ($cctv->status != "deleted") {
			if ($cctv->status == "online") {
				$data = array(
					'status' => 'offline'
				);
			} else {
				$data = array(
					'status' => 'online'
				);
			}

			$this->cctv_model->update($id, $data);

			$this->user_log->add_log($this->session->userdata('user_id'), 'cctv', $id, 'Pengguna mengubah status data cctv');

			$this->session->set_flashdata('cctv_success', true);
			redirect('admin/cctv');
		} else {
			redirect('/admin');
		}
	}

	public function update_sequence()
	{
		if ($this->input->post('cctv_ids', true)) {
			$this->load->model(array('cctv_model', 'user_log'));
			$cctv_ids = $this->input->post('cctv_ids', true);
			$sequences = $this->input->post('sequences', true);
			foreach ($cctv_ids as $cctv_idx => $cctv_id) {
				$this->cctv_model->update($cctv_id, [
					'sequence' => $sequences[$cctv_idx]
				]);
			}

			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'fail', 'code' => 0));
		}
	}

	public function destroy()
	{
		if ($this->input->post('cctv_ids', true)) {
			$this->load->model(array('cctv_model', 'user_log'));
			$cctv_ids = $this->input->post('cctv_ids', true);
			foreach ($cctv_ids as $cctv_id) {
				$this->cctv_model->destroy($cctv_id);
				$this->user_log->add_log($this->session->userdata('user_id'), 'cctv', $cctv_id, 'Pengguna menghapus data cctv');
			}
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'fail', 'code' => 0));
		}
	}

	public function api_get_all_cctv()
	{
		$this->load->model('cctv_model');
		$cctv = $this->cctv_model->fetch_all_cctv("", "", null, 'tree');

		$ret_cctv = array();
		$no = 1;
		if (!empty($cctv)) {
			foreach ($cctv as $value) {
				$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $value->id . "\" id=\"checker-" . $value->id . "\" /></span></div></span>";

				if ($this->user_access->edit) {
					if ($value->status == "online") {
						$status = "<a href=\"" . site_url('admin/cctv/update_status/' . $value->id) . "\" class=\"cctv-status\" data-id=\"" . $value->id . "\" id=\"cctv-status-" . $value->id . "\" data-status=\"online\" style=\"color: #333\"><i class=\"fa fa-2x fa-globe\" style=\"color: #47c157\"></i> Online</a>";
					} else {
						$status = "<a href=\"" . site_url('admin/cctv/update_status/' . $value->id) . "\" class=\"cctv-status\" data-id=\"" . $value->id . "\" id=\"cctv-status-" . $value->id . "\" data-status=\"offline\" style=\"color: #333\"><i class=\"fa fa-2x fa-ban\" style=\"color: #db1111\"></i> Offline</a>";
					}

					$urutan = '<input type="text" name="sequence_' . $value->id . '" id="sequence_' . $value->id . '" class="form-control" value="' . $value->sequence . '" style="width:50px;">';
				} else {
					$status = "";
					$urutan = "";
				}

				$temp_class = array($checkbox, $no, $value->id_ruas, $value->nama_ruas, $value->nama_cctv, $value->bujt_nama, $urutan, $value->stream, $value->protocol, $status);
				array_push($ret_cctv, $temp_class);
				$no++;
			}
		}
		$json = array('aaData' => $ret_cctv);

		echo json_encode($json);
	}

	private function create_slug($string)
	{
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	public function check_id_ruas()
	{
		return $this->input->post('id_ruas', true) == "" ? false : true;
	}

	public function check_nama_ruas()
	{
		return $this->input->post('nama_ruas', true) == "" ? false : true;
	}

	public function check_nama_cctv()
	{
		return $this->input->post('nama_cctv', true) == "" ? false : true;
	}

	public function check_stream()
	{
		return $this->input->post('stream', true) == "" ? false : true;
	}

	public function check_protocol()
	{
		return $this->input->post('protocol', true) == "" ? false : true;
	}

	public function check_bujt()
	{
		return $this->input->post('bujt', true) == "" ? false : true;
	}

	public function check_bujt_nama()
	{
		return $this->input->post('bujt_nama', true) == "" ? false : true;
	}

	public function check_status()
	{
		return $this->input->post('status', true) == "" ? false : true;
	}

	public function check_lat()
	{
		return $this->input->post('lat', true) == "" ? false : true;
	}

	public function check_long()
	{
		return $this->input->post('long', true) == "" ? false : true;
	}
}
