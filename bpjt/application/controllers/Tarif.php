<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarif extends CI_Controller {


	function index(){
		$this->load->view('toll_roads/vtarif');
	}
}

