<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petacetak extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_ruas_tol() {
		$this->db->from('ruas_jalan_tol');
		$this->db->order_by('nama', 'asc');
		return $this->db->get()->result_array(); 
	}
	
	public function count_ruas_tol($where) {
		$this->db->select('COUNT(*) AS CNT');
		$this->db->where($where);
		$query = $this->db->get('ruas_jalan_tol_detail');
		return $query->row_array();
	}
	
	public function get_one($prm)
	{
		if(isset($prm['select']))
		{
			$this->db->select($prm['select']);
		}
		
		$this->db->from($prm['table']);
		
		if(isset($prm['join']))
		{
			foreach($prm['join'] as $join)
			{
				if(isset($join['type']))
				{
					$this->db->join($join['table'], $join['on'], $join['type']);
				}
				else
				{
					$this->db->join($join['table'], $join['on']);
				}
			}
		}
		
		if(isset($prm['where']))
		{
			$this->db->where($prm['where']);
		}
		
		if(isset($prm['where_like']))
		{
			$this->db->like($prm['where_like']['field'],$prm['where_like']['match'],isset($prm['where_like']['side']) ? $prm['where_like']['side'] : 'both');
		}
		
		if(isset($prm['order_sort']))
		{
			$dir = (isset($prm['order_dir']) ? $prm['order_dir'] : 'ASC');
			$this->db->order_by($prm['order_sort'], $dir);
		}
		
		$this->db->limit(1);
		
		return $this->db->get();
	}
	
	function get_list($prm)
	{
		$this->db->from($prm['table']);
		
		if(isset($prm['join']))
		{
			foreach($prm['join'] as $join)
			{
				if(isset($join['type']))
				{
					$this->db->join($join['table'], $join['on'], $join['type']);
				}
				else
				{
					$this->db->join($join['table'], $join['on']);
				}
			}
		}
		
		if(isset($prm['select']))
		{
			$this->db->select($prm['select'],isset($prm['quote']) ? $prm['quote'] : TRUE);
		}
		
		if(isset($prm['where']))
		{
			$this->db->where($prm['where']);
		}
		
		if(isset($prm['where_like']))
		{
			$this->db->where($prm['where_like']);
		}
		
		if(isset($prm['where_in']))
		{
			$this->db->where_in($prm['where_in'][0],$prm['where_in'][1]);
		}
		
		if(isset($prm['where_not_in']))
		{
			$this->db->where_not_in($prm['where_not_in'][0],$prm['where_not_in'][1]);
		}
		
		if(isset($prm['group_by']))
		{
			$this->db->group_by($prm['group_by']);
		}
		
		if(isset($prm['order_sort']))
		{
			$dir = (isset($prm['order_dir']) ? $prm['order_dir'] : 'ASC');
			$this->db->order_by($prm['order_sort'], $dir);
		}
		
		if(isset($prm['limit']))
		{
			$this->db->limit($prm['limit']);
		}
		
		$query = $this->db->get();
		return $query;
	}
}
