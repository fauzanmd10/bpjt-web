<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cctv extends CI_Controller {

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

	public function cctv_inframe() {
		$this->load->model(array('cctv_model'));
		
        $idruas = clean_str($this->input->get("id_ruas"));
		$status = clean_str($this->input->get("status"));
		
		$jscripts = array();
		$stylesheets = array();

        if(empty($idruas)){
			$data = $this->cache->file->get('cctv_data');
			if(!$data){
				$cctv = $this->cctv_model->get_ruas_cctv();

				$data = array(
					'prefix_title' => 'CCTV TOL - ',
					'content' => $this->load->view('cctv/cctv-inframe', array('cctv' =>$cctv,'id_ruas' =>$idruas) ,true),
					'stylesheets'=>$stylesheets,
					'jscripts'=>$jscripts
				);

				$this->cache->file->save('cctv_data', $data, 60);
			}
        }else{
			$data = $this->cache->file->get('cctv_data_' . sha1($idruas . $status));
			if(!$data){
				$cctv = $this->cctv_model->get_cctv($idruas, $status);
				
				$data = array(
					'prefix_title' => 'CCTV TOL - ',
					'content' => $this->load->view('cctv/cctv-inframe', array('cctv' =>$cctv,'id_ruas' =>$idruas) ,true),
					'stylesheets'=>$stylesheets,
					'jscripts'=>$jscripts
				);
				$this->cache->file->save('cctv_data_' . sha1($idruas), $data, 60);
			}
        }
		
		$this->load->view('layouts/content-new.php', $data);
    }
}