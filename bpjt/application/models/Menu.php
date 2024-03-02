<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch_menus($entry, $page, $query, $type = 'array') {
		if (empty($query)) {
			$query_result = $this->get_menus($page, $entry);
			if (empty($query_result)) {
				return array('- Root -');
			} else {
				$result_tree = $this->parse_tree($query_result);
				$tree_flatten = $this->flatten_array($result_tree);
				$menu = $this->get_menu_array($tree_flatten);
				if($type == 'array') {
					return $menu;
				}if($type == 'tree') return array('tree' => $tree_flatten, 'array' => $menu);
			}
		} else {
			return $this->search_menus($query, $page, $entry);
		}
	}
	
	public function get_menus($page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('name', 'asc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}

	public function get_parsed_menus() {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->order_by('name', 'asc');

		$menus = $this->db->get()->result();
		$menus = $this->parse_treeview($menus);

		return $menus;
	}

	public function get_parsedtree_menus() {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status != 'deleted'");
		$this->db->order_by('id', 'asc');

		$menus = $this->db->get()->result();
		$menus = $this->parse_treeview($menus);

		return $menus;
	}
	
	public function get_parsedtree_menus_frontend() {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->order_by('id', 'asc');

		$menus = $this->db->get()->result();
		$menus = $this->parse_treeview($menus);

		return $menus;
	}
	
	public function search_menus($query, $page = "", $item_per_page = "") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status != 'deleted'");
		$this->db->like("name", $query);
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}
	
		return $this->db->get()->result();
	}
	
	public function insert($data) {
		return $this->db->insert('menus', $data);
	}
	
	public function get_menu($menu_id) {
		$this->db->where('id', $menu_id);
	
		return $this->db->get('menus')->result();
	}
	
	public function get_menu_by_parent_id($menu_id) {
		$this->db->where('parent_id', $menu_id);
	
		return $this->db->get('menus')->result();
	}

	public function get_menu_by_slug($slug) {
		$this->db->where('slug', $slug);

		return $this->db->get('menus')->result();
	}

	public function get_published_menu_by_parent_id($parent_id) {
		$this->db->where('parent_id', $parent_id);
		$this->db->where('status = "published"');
		//$this->db->order_by('created_at', 'desc');

		return $this->db->get('menus')->result();
	}
	
	public function update($menu_id, $data) {
		$this->db->where('id', $menu_id);
		return $this->db->update('menus', $data);
	}
		
	public function destroy($menu_id) {
		$this->delete_menu_child($menu_id);
		
		$menu = $this->get_menu($menu_id);
		$menu = $menu[0];
		$data = array(
			'status'=>'deleted',
			'name'=>$menu->name . '-' . $menu->id . '-deleted',
			'slug'=>$menu->slug . '-' . $menu->id . '-deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $menu_id);
		return $this->db->update('menus', $data);
	}
	
	private function delete_menu_child($parent_id) {
		$menu = $this->get_menu_by_parent_id($parent_id);
		foreach($menu as $key => $value) {
			$data = array(
					'status'=>'deleted',
					'name'=>$value->name . '-' . $value->id . '-deleted',
					'slug'=>$value->slug . '-' . $value->id . '-deleted',
					'updated_at'=>date('Y-m-d H:i:s')
			);
			$this->db->where('id', $value->id);
			$this->db->update('menus', $data);
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
					'name_en' => $value->name_en,
					'slug' => $value->slug,
					'created_at' => $value->created_at,
					'updated_at' => $value->updated_at,
					'children' => $this->parse_tree($tree, $prefix.'-', $value->id)
				);
				array_push($return, $temp_var);
			}
		}
	
		return empty($return) ? null : $return;
	}

	public function parse_treeview($tree, $prefix=null, $root=null, $root_slug="") {
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $key => $value) {
			# A direct child is found
			if($value->parent_id == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$key]);
				# Append the child into result array and parse its children
				$slug = ($root_slug == "") ? $value->slug : $root_slug . '/' . $value->slug;
				$temp_var = array(
					'id' => $value->id,
					'label' => $value->name,
					'label_en' => $value->name_en,
					'slug' => $slug,
					'children' => $this->parse_treeview($tree, $prefix.'-', $value->id, $slug)
				);
				array_push($return, $temp_var);
			}
		}
	
		return empty($return) ? array() : $return;
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

	public function print_admin_menu($collections) {
		foreach($collections as $collection) {
			if (empty($collection['children'])) {
				$current_uri = $this->uri->uri_string();
				$active = ($current_uri == 'admin/contents/' . $collection['slug']) ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : "";
				echo "<li><a href='" . site_url('admin/contents/' . $collection['slug']) . "' {$active}>" . $collection['label'] . "</a></li>";
			} else {
				$current_uri = $this->uri->uri_string();
				$strpos = strpos($current_uri, $collection['slug']);
				$active = ($strpos > 0) ? "style='display:block;padding-left:20px;'" : "style='padding-left:20px;'";
				echo "<li class='dropdown'><a href='#'>" . $collection['label'] . "</a><ul {$active}>";
				$this->print_admin_menu($collection['children']);
				echo "</ul></li>";
			}
		}
	}

	public function print_frontend_menu($collections, $with_active=true) {
		foreach($collections as $collection) {
			$lang = $this->session->userdata('lang');
			$ext = ($lang == 'en') ? 'en/' : '';
			$name = ($lang == 'en') ? $collection['label_en'] : $collection['label'];
			if (empty($collection['children'])) {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if ($lang == 'en') {
						unset($current_uris[0]);
						unset($current_uris[1]);
					} else {
						unset($current_uris[0]);
					}
					$current_uri = implode('/', $current_uris);
					$active = ($current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li><a href='" . site_url('konten/'.$ext.$collection['slug']) . "' title='{$name}' class='{$active}'>{$name}</a></li>";
			} else {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if (!empty($current_uris) && $current_uris[0] == 'konten') {
						if ($lang == 'en') {
							unset($current_uris[0]);
							unset($current_uris[1]);
							$current_uri = $current_uris[2];
						} else {
							unset($current_uris[0]);
							$current_uri = $current_uris[1];
						}
					}
					$active = (!empty($current_uris) && $current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li class='dropdown'><a class='{$active}' href='#' title='{$name}'data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $name . "<span class='caret'></span></a><ul class='dropdown-menu'>";
				$this->print_frontend_menu($collection['children']);
				echo "</ul></li>";
			}
		}
	}
	
	
	public function print_frontend_menu2($collections, $with_active=true) {
		foreach($collections as $collection) {
			$lang = $this->session->userdata('lang');
			$ext = ($lang == 'en') ? 'en/' : '';
			$name = ($lang == 'en') ? $collection['label_en'] : $collection['label'];
			if (empty($collection['children'])) {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if ($lang == 'en') {
						unset($current_uris[0]);
						unset($current_uris[1]);
					} else {
						unset($current_uris[0]);
					}
					$current_uri = implode('/', $current_uris);
					$active = ($current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li class='dropdown'><a href='". site_url('konten/'.$ext.$collection['slug']) . "' title='{$name}' class='{$active}'>{$name}</a></li>";
			} else {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if (!empty($current_uris) && $current_uris[0] == 'konten') {
						if ($lang == 'en') {
							unset($current_uris[0]);
							unset($current_uris[1]);
							$current_uri = $current_uris[2];
						} else {
							unset($current_uris[0]);
							$current_uri = $current_uris[1];
						}
					}
					$active = (!empty($current_uris) && $current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li><a class='{$active} test' href='#' title='{$name}'data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $name . "<span class='caret'></span></a><ul class='dropdown-menu'>";
				$this->print_frontend_menu2($collection['children']);
				echo "</ul></li>";
			}
		}
	}
	
	public function print_frontend_menu_new($collections, $with_active=true) {
		foreach($collections as $collection) {
			$lang = $this->session->userdata('lang');
			$ext = ($lang == 'en') ? 'en/' : '';
			$name = ($lang == 'en') ? $collection['label_en'] : $collection['label'];
			if (empty($collection['children'])) {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if ($lang == 'en') {
						unset($current_uris[0]);
						unset($current_uris[1]);
					} else {
						unset($current_uris[0]);
					}
					$current_uri = implode('/', $current_uris);
					$active = ($current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li class='menu-item'><a href='". site_url('konten/'.$ext.$collection['slug']) . "' title='{$name}' class='menu-link'>{$name}</a></li>";
			} else {
				if ($with_active) {
					$current_uri = $this->uri->uri_string();
					$current_uris = explode('/', $current_uri);
					if (!empty($current_uris) && $current_uris[0] == 'konten') {
						if ($lang == 'en') {
							unset($current_uris[0]);
							unset($current_uris[1]);
							$current_uri = $current_uris[2];
						} else {
							unset($current_uris[0]);
							$current_uri = $current_uris[1];
						}
					}
					$active = (!empty($current_uris) && $current_uri == $collection['slug']) ? "active" : "";
				} else {
					$active = "";	
				}
				echo "<li class='menu-item'><a class='menu-link' href='#' title='{$name}'data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $name . "<span class='caret'></span></a><ul class='sub-menu-container'>";
				$this->print_frontend_menu_new($collection['children']);
				echo "</ul></li>";
			}
		}
	}

	public function print_sitemap_menu($collections, $parent = null) {
		foreach($collections as $collection) {
			$lang = $this->session->userdata('lang');
			$ext = ($lang == 'en') ? 'en/' : '';
			$name = ($lang == 'en') ? $collection['label_en'] : $collection['label'];
			if (empty($collection['children'])) {
				echo "<li><a href='" . site_url('konten/'.$ext.$collection['slug']) . "' title='{$name}'>{$name}</a></li>";
			} else {
				if (is_null($parent)) {
					echo "<li class='first'><strong>" . $name . "</strong></li>";
				}

				echo "<ul class='level_1'>";
				echo "<li><a href='#' title='{$name}'>" . $name . "</a><ul class='level_1'>";
				$this->print_sitemap_menu($collection['children'], $collection['id']);
				echo "</ul></li><ul><br />";
			}
		}
	}
	
	private function get_menu_array($array) {
		$menu = array();
		
		$menu[0] = '- Root -';
		foreach($array as $key => $value) {
			$menu[$value['id']] = $value['name'] . '/' . $value['name_en'];
		}
		
		return $menu;
	}
	
	
	
	public function get_menu_jalantol($type="6") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("parent_id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_progress($type="8") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("parent_id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	public function get_menu_monitoring($type="33") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("parent_id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_profil($type="1") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("parent_id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_invest($type="9") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("parent_id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_lelangjt($type="53", $id = null, $include_draft = false) {
		$this->db->select('*');
		$this->db->from('menus');
		if(!$include_draft){
			$this->db->where("status = 'published'");
		}
		$this->db->where("parent_id", $type);
		if($id){
			$this->db->where("id", $id);
		}
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_jorr2el($type="65") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_patimban($type="67") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_kater($type="56") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_setakarat($type="73") {
		$this->db->select('*');
		$this->db->from('menus');
		// $this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_boser($type="75") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
	
	public function get_menu_kedigung($type="79") {
		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_gaetacim($type="85") {
		$this->db->select('*');
		$this->db->from('menus');
		// $this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}

	public function get_menu_gilmeng($type="63") {
		$this->db->select('*');
		$this->db->from('menus');
		// $this->db->where("status = 'published'");
		$this->db->where("id", $type);
		$this->db->order_by('id', 'asc');

		return $this->db->get()->result();
	}
}