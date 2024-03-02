<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spm_Classification extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_classifications($entry, $page, $query, $type = 'array') {
		if (empty($query)) {
			$query_result = $this->get_classifications($page, $entry);
			if (empty($query_result)) {
				return array();
			} else {
				$result_tree = $this->parse_tree($query_result);
				$tree_flatten = $this->flatten_array($result_tree);
				$classification = $this->get_classification_array($tree_flatten);
				if($type == 'array') {
					return $classification;
				}if($type == 'tree') return array('tree' => $tree_flatten, 'array' => $classification);
			}
		} else {
			return $this->search_classifications($query, $page, $entry);
		}
	}
	
	public function get_classifications($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('spm_classifications');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_classifications_by_pos_and_parentid($pos, $parent_id = null) {
		$this->db->select('*');
		$this->db->from('spm_classifications');
		$this->db->where('pos', $pos);
		if (is_null($parent_id)) {
			$this->db->where('parent_id IS NULL');
		} else {
			$this->db->where('parent_id', $parent_id);
		}
		$this->db->order_by('pos', 'asc');
	
		return $this->db->get()->result();
	}

	public function get_parsed_classifications() {
		$this->db->select('*');
		$this->db->from('spm_classifications');
		$this->db->where("status = 'published'");
		$this->db->order_by('name', 'asc');

		$classifications = $this->db->get()->result();
		$classifications = $this->parse_treeview($classifications);

		return $classifications;
	}

	public function get_parsedtree_classifications() {
		$this->db->select('*');
		$this->db->from('spm_classifications');
		$this->db->where("status = 'published'");
		$this->db->order_by('name', 'asc');

		$classifications = $this->db->get()->result();
		$classifications = $this->parse_treeview_new($classifications);

		return $classifications;
	}
	
	public function search_classifications($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('spm_classifications');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('spm_classifications', $data);
	}
	
	public function get_classification($classification_id) {
		$this->db->where('id', $classification_id);
	
		return $this->db->get('spm_classifications')->result();
	}
	
	public function get_classification_by_parent_id($classification_id) {
		$this->db->where('parent_id', $classification_id);
	
		return $this->db->get('spm_classifications')->result();
	}
	
	public function update($classification_id, $data) {
		$this->db->where('id', $classification_id);
		return $this->db->update('spm_classifications', $data);
	}
		
	public function destroy($classification_id) {
		$this->delete_classification_child($classification_id);
		
		$classification = $this->get_classification($classification_id);
		$classification = $classification[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$classification->name . '-' . $classification->id . '-deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $classification_id);
		return $this->db->update('spm_classifications', $data);
	}
	
	private function delete_classification_child($parent_id) {
		$classification = $this->get_classification_by_parent_id($parent_id);
		foreach($classification as $key => $value) {
			$data = array(
					'status'=>'deleted',
					'name'=>$value->name . '-' . $value->id . '-deleted',
					'updated_at'=>date('Y-m-d H:i:s')
			);
			$this->db->where('id', $value->id);
			$this->db->update('spm_classifications', $data);
		}
	}
	
	public function parse_tree($tree, $prefix = null, $root = null) {
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $key => $value) {
			# A direct child is found
			if($value->parent_id == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$key]);
				# Append the child into result array and parse its children
				$temp_var = array(
					'id' => $value->id,
					'name' => $value->name,
					'parent_id' => $value->parent_id,
					'status' => $value->status,
					'created_at' => $value->created_at,
					'updated_at' => $value->updated_at,
					'children' => $this->parse_tree($tree, $prefix.'-', $value->id)
				);
				array_push($return, $temp_var);
			}
		}
	
		return empty($return) ? null : $return;
	}

	public function parse_treeview($tree, $prefix=null, $root=null) {
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $key => $value) {
			# A direct child is found
			if($value->parent_id == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$key]);
				# Append the child into result array and parse its children
				$temp_var = array(
					'id' => $value->id,
					'label' => $value->name,
					'children' => $this->parse_treeview($tree, $prefix.'-', $value->id)
				);
				if ($value->pos == 0) {
					array_push($return, $temp_var);
				} else {
					if (isset($return[$value->pos - 1])) {
						$idx = $value->pos;
						while (isset($return[$idx])) {
							$idx++;
						}
						$return[$idx] = $return[$value->pos - 1];
						$return[$value->pos - 1] = $temp_var;
					} else {
						$return[$value->pos - 1] = $temp_var;
					}
				}
			}
		}
	
		return empty($return) ? null : $return;
	}

	public function parse_treeview_new($tree, $prefix=null, $root=null) {
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $key => $value) {
			# A direct child is found
			if($value->parent_id == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$key]);
				# Append the child into result array and parse its children
				$temp_var = array(
					'id' => $value->id,
					'label' => $value->name,
					'children' => $this->parse_treeview_new($tree, $prefix.'-', $value->id)
				);
				array_push($return, $temp_var);
			}
		}
	
		return empty($return) ? null : $return;
	}
	
	public function flatten_array($input, $maxdepth = NULL, $depth = 0) {
		if(!is_array($input)) return $input;
	
		$depth++;
		$array = array();
		$temp_var = array();
		
		if(count($input) > 0) {
			$keys = array_keys($input);
			$limit_push = count($keys) - 1;
		}
		
		foreach($input as $key => $value) {
			if(($depth <= $maxdepth or is_null($maxdepth)) && (is_array($value) && count($value) > 0)){
				$array = array_merge($array, $this->flatten_array($value, $maxdepth, $depth));
			}elseif(!is_array($value)) {
				$temp_var[$key] = $value;
				if(count($temp_var) == $limit_push) array_push($array, $temp_var);
			}
		}
		return $array;
	}

	public function get_headers_old($input, $maxdepth = NULL, $depth = 0) {
		if(!is_array($input)) return $input;
	
		$depth++;
		$array = array();
		$temp_var = array();
		
		if(count($input) > 0) {
			$keys = array_keys($input);
			$limit_push = count($keys);
		}
		
		foreach($input as $key => $value) {
			if(($depth <= $maxdepth or is_null($maxdepth)) && (is_array($value) && count($value) > 0)){
				$array = array_merge($array, $this->get_headers($value, $maxdepth, $depth));
			}elseif(!is_array($value)) {
				$temp_var[$key] = $value;
				if(count($temp_var) == $limit_push) array_push($array, $temp_var);
			}
		}
		return $array;
	}

	public function get_headers($collections) {
		$columns = array();
		for($idx=0; $idx<count($collections); $idx++) {
			if (!empty($collections[$idx])) {
				$collection = $collections[$idx];
				if (empty($collection['children'])) {
					array_push($columns, $collection);
				} else {
					$columns = array_merge($columns, $this->get_headers($collection['children']));
				}
			}
		}

		return $columns;
	}

	public function count_columns(&$collections, &$child_count) {
		if (!empty($collections)) {
			foreach($collections as &$collection) {
				$collection['columns'] = 0;

				$this->count_columns($collection['children'], $collection['columns']);
				$child_count += $collection['columns'];
			}
		} else {
			$child_count++;
		}
	}

	public function assign_row_number(&$collections, $parent_pos) {
		if (!empty($collections)) {
			$tmp_parent_pos = $parent_pos+1;
			foreach($collections as &$collection) {
				$collection['row'] = $tmp_parent_pos;
				$this->assign_row_number($collection['children'], $tmp_parent_pos);
			}
		}
	}

	public function count_depth($collections, &$depth) {
		if (!empty($collections)) {
			foreach($collections as $collection) {
				if ($collection['row'] > $depth) {
					$depth = $collection['row'];
				}

				$this->count_depth($collection['children'], $depth);
			}
		}
	}

	public function convert_classifications_to_header($classifications, $depth) {
		$row = 2;
		while($row <= $depth) {
			echo "<tr>";
			$this->write_classification($classifications, $row, $depth);

			if ($row == 2) {
				echo "<th rowspan='".($depth-1)."'>Keterangan Waktu Evaluasi Pemenuhan SPM</th>";
				echo "<th rowspan='".($depth-1)."'>Keterangan Waktu Laporan Perbaikan Oleh BUJT</th>";
			}

			echo "</tr>";

			$row++;
		}
	}

	private function write_classification($collections, $row, $depth) {
		if (!empty($collections)) {
			for($idx=0; $idx<count($collections); $idx++) {
				if (!empty($collections[$idx])) {
					$collection = $collections[$idx];
					if ($collection['row'] == $row) {
						if ($collection['columns'] <= 1 && empty($collection['children'])) {
							if ($collection['row'] < $depth) {
								$rowspan = $depth - $collection['row'] + 1;
								echo "<th rowspan='{$rowspan}'>{$collection['label']}</th>";
							} else {
								echo "<th>{$collection['label']}</th>";
							}
						} else {
							echo "<th colspan='{$collection['columns']}'>{$collection['label']}</th>";
						}				
					} else {
						$this->write_classification($collection['children'], $row, $depth);
					}
				}
			}
		}
	}
	
	private function get_classification_array($array) {
		$classification = array();
		
		$classification[0] = '- Root -';
		foreach($array as $key => $value) {
			$classification[$value['id']] = $value['name'];
		}
		
		return $classification;
	}
}