<?php 
 if (!defined('BASEPATH'))exit('No direct script access allowed');

 class Cek_tarif extends CI_Controller {

  function __construct() {
   parent::__construct();
   
        $this->lang->load('id', 'indonesia');
                     $lang = $this->session->userdata('lang');
                     if (!empty($lang) && $lang == 'en') {
                             $this->lang->load('en', 'english');
                     } else {
                             $this->session->set_userdata(array('lang'=>'id'));
                     }
        //$this->load->helper(array('url',''));
        //$this->load->model('m_tarif');
        $this->load->database();
  }

  function index() {
        $this->load->model(array('m_tarif', 'vehicle_group', 'article', 'media'));
        
        $data = $this->cache->file->get('cek_tarif_data');
		if(!$data){
            $toll_road=$this->m_tarif->get_all_toll();
            $veh_gr=$this->m_tarif->get_all_veh();

            $path = base_url('assets');
            $popular_articles = $this->article->get_popular_articles(3);
            $newstickers = $this->content->get_published_contents_by_content_type('pengumuman', $this->session->userdata('lang'));
            $db_medias = $this->media->get_published_medias(1, 8, $this->session->userdata('lang'));
            $stylesheets = array();
            $data = array(
                'toll_road'=>$toll_road,
                            'veh_gr'=>$veh_gr,
                            'path'=>$path,
                            'newstickers'=>$newstickers,
                            'stylesheets'=>$stylesheets,
                            'popular_articles'=>$popular_articles,
                'galleries'=>$db_medias
            );

            $this->cache->file->save('cek_tarif_data', $data, 30);
        }        

        $this->load->view('toll_roads/ctarif-new', $data);
  }
  
  function add_ajax_tol($id_tol){
      $query = $this->db->get_where('toll_gates',array('toll_road_id'=>$id_tol, 'status'=>'published'));
      $data = "<option value=''>- Pilih Gerbang Masuk -</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->name."</option>";
      }
      echo $data;
  }
  
  function add_ajax_tol2($id_tol){
      $query = $this->db->get_where('toll_gates',array('toll_road_id'=>$id_tol, 'status'=>'published'));
      $data = "<option value=''>- Pilih Gerbang Keluar -</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->name."</option>";
      }
      echo $data;
  }
  
  function add_ajax_kepmen($id_tol){
      $query = $this->db->get_where('toll_road_metas',array('toll_road_id'=>$id_tol));
      $data = "";
      foreach ($query->result() as $value) {
          $data .= "Berdasarkan <text id='".$value->id."'>".$value->meta_value."</text>";
      }
      echo $data;
  }
  
	function add_ajax_tarif(){
		$id_tol = @intval($this->input->get("id_tol"));
		$id_gate1 = @intval($this->input->get("toll_gates"));
		$id_gate2 = @intval($this->input->get("toll_gates2"));
		$id_gol = @intval($this->input->get("veh_gr"));
				
		$tbl = 'toll_tariffs';
                
                    $where = array('toll_road_id' => $id_tol, 'enter_toll_gate_id' => $id_gate1, 'exit_toll_gate_id' => $id_gate2, 'vehicle_group_id' => $id_gol);
                    $this->db->select($tbl . '.tariff');
                    $this->db->from($tbl);
                    $this->db->where($where);
                    $query = $this->db->get();
                    $val = $query->row();
        if (!empty($val)) {
                    echo number_format($val->tariff, 2);
        } else {
            echo("tarif tidak ditemukan");
        }
    }
 }
?>