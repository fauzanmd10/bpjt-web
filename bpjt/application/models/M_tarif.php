<?php 
 if (!defined('BASEPATH'))exit('No direct script access allowed');

 class M_tarif extends CI_Model {
  
  function __construct() {
   parent::__construct();
  }
  
  function get_all_toll() {
   $this->db->select('*');
   $this->db->from('toll_roads');
   $this->db->where("status != 'deleted'");
   $this->db->where("status != 'draft'");
   $this->db->order_by('name', 'asc');
   $query = $this->db->get();
   
   return $query->result();
  }
  
  function get_all_veh() {
   $this->db->select('*');
   $this->db->from('vehicle_groups');
   $query = $this->db->get();
   
   return $query->result();
  }
 }
?>