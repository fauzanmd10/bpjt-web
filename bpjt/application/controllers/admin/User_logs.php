<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Logs extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('/admin');
		}

		$this->load->model('access');
		$this->user_access = $this->access->get_user_access_by_key('log', $this->session->userdata('user_group_id'));
		$this->user_access = $this->user_access[0];
		if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
			$this->session->set_flashdata('access_denied', true);
			redirect('/admin/dashboard');
		}
	}

	public function index() {
		$this->load->model('comment');

		$breadcrumbs = array(
			'' => 'User Log'
		);
		$jscripts = array(
			'elements.js'=>'application',
			'prettify/prettify.js'=>'vendor',
			'jquery.jgrowl.js'=>'vendor',
			'jquery.alerts.js'=>'vendor',
			'jquery.dataTables.min.js'=>'vendor',
			'admin.user-logs.index.js'=>'application'
		);

		$data = array(
			'menu' => $this->load->view('layouts/admin_menu', null, true),
			'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs'=>$breadcrumbs, 'subtitle' => 'USER LOG', 'title' => 'User Log'), true),
			'content' => $this->load->view('admin/user_logs/index', null, true),
			'jscripts' => $jscripts,
			'unread_comments' => $this->comment->get_total_unread_comments()
		);
		$this->load->view('layouts/admin_content.php', $data);
	}

	public function api_get_all_logs() {
		$this->load->model('user_log');

		$user_logs = $this->user_log->get_logs();

		$ret_logs = array();
		$no = 1;
		foreach($user_logs as $user_log) {
			$checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $user_log->id . "\" id=\"checker-" . $user_log->id . "\" /></span></div></span>";
			$created_at = strtotime($user_log->created_at);

			$temp_user_log = array($checkbox, $no, $user_log->log_message, $user_log->employee_first_name . " " . $user_log->employee_middle_name . " " . $user_log->employee_last_name, date('d M Y H:i:s', $created_at));
			array_push($ret_logs, $temp_user_log);
			$no++;
		}
		$json = array('aaData'=>$ret_logs);

		echo json_encode($json);
	}

}