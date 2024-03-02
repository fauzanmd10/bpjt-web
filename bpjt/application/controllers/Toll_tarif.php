<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll_Tarif extends CI_Controller {
    public function index() {

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

	public function api_get_toll_gates() {
		if (!empty($this->input->get('toll_road_id', TRUE))) {
			$this->load->model('toll_gate');
			$toll_road_id = clean_str($this->input->get('toll_road_id', TRUE));
			$db_toll_gates = $this->toll_gate->get_published_toll_gates_by_toll_road($toll_road_id);
			echo json_encode(array('status'=>'success', 'toll_gates'=>$db_toll_gates));
		}
	}

	public function api_get_kepmen() {
		if (!empty($this->input->get('toll_road_id', TRUE))) {
			$this->load->model('toll_road');
			$kepmen = "";
			$meta = $this->toll_road->get_toll_road_meta(clean_str($this->input->get('toll_road_id', TRUE)), 'kepmen_tarif');
			if (!empty($meta)) {
				$kepmen = $meta[0]->meta_value;
			}

			echo json_encode(array('status'=>'success', 'kepmen'=>$kepmen));
		}
	}
    
    
}