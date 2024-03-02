<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {

	public function create() {
		if (isset($_POST)) {
			$this->load->model('comment');			
			$this->load->library('form_validation');

			$this->form_validation->set_rules('fullname', 'Nama', 'trim|callback_check_fullname');
			$this->form_validation->set_rules('email', 'Email', 'trim|callback_check_email');
			$this->form_validation->set_rules('comment', 'Komentar', 'trim|callback_check_comment');
			$this->form_validation->set_message('check_fullname', 'Nama harus terisi.');
			$this->form_validation->set_message('check_email', 'Email harus terisi.');
			$this->form_validation->set_message('check_comment', 'Komentar harus terisi.');

			if ($this->form_validation->run()) {
				$data = array(
					'comment'=>strip_tags($this->input->post('comment', TRUE)),
					'email'=>strip_tags($this->input->post('email', TRUE)),
					'fullname'=>strip_tags($this->input->post('email', TRUE)),
					'website'=>strip_tags($this->input->post('website', TRUE)),
					'article_id'=>$this->input->post('article_id', TRUE),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s')
				);

				$this->comment->insert($data);
				$this->session->set_flashdata('comment_success', true);
			} else {
				$this->session->set_flashdata('validation_errors', validation_errors());

			}

			redirect('berita/' . $this->input->post('slug', TRUE), 'refresh');
		}
	}

	public function check_fullname() {
		if ($this->input->post('fullname', TRUE) == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_email() {
		if ($this->input->post('email', TRUE) == "") {
			return false;
		} else {
			return true;
		}
	}

	public function check_comment() {
		if ($this->input->post('comment', TRUE) == "") {
			return false;
		} else {
			return true;
		}
	}
}

/* End of file comments.php */
/* Location: ./application/controllers/admin/comments.php */