<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_lelang extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_documents($page = "", $item_per_page = "", $filename = "", $user_id, $user_group_id, $id_ruas = null) {
		$this->db->select('documents_lelang.*,lelang_users.company_name,menus.name as ruas,concat(lelang_users.`ceo_name`," ",lelang_users.`ceo_name`) as fullname');
        $this->db->from('documents_lelang');
        $this->db->join('lelang_users', 'lelang_users.id = documents_lelang.lelang_user_id', 'left');
        $this->db->join('menus', 'menus.id = lelang_users.lelang_jt', 'left');
		$this->db->where("documents_lelang.status != 'deleted'");
        if ($user_group_id != "19"&&$user_group_id != "21"&&$user_group_id != "25"&&$user_group_id != "27"&&$user_group_id != "29"&&$user_group_id != "31"&&$user_group_id != "33"&&$user_group_id != "35"&&$user_group_id != "37"&&$user_group_id != "43"&&$user_group_id != "45"&&$user_group_id != "77") {
            $this->db->where("documents_lelang.lelang_user_id = '".$user_id."'");
		}
		if ($user_group_id == "19") {
            $this->db->where("lelang_users.user_group_id = '18'");
		}
		if ($user_group_id == "21") {
            $this->db->where("lelang_users.user_group_id = '20'");
		}
		if ($user_group_id == "27") {
            $this->db->where("lelang_users.user_group_id = '26'");
		}
		if ($user_group_id == "25") {
            $this->db->where("lelang_users.user_group_id = '24'");
		}
		if ($user_group_id == "29") {
            $this->db->where("lelang_users.user_group_id = '28'");
		}
		if ($user_group_id == "31") {
            $this->db->where("lelang_users.user_group_id = '30'");
		}
		if ($user_group_id == "33") {
            $this->db->where("lelang_users.user_group_id = '32'");
		}
		if ($user_group_id == "35") {
            $this->db->where("lelang_users.user_group_id = '34'");
		}
		if ($user_group_id == "37") {
            $this->db->where("lelang_users.user_group_id = '36'");
		}
		if ($user_group_id == "43") {
            $this->db->where("lelang_users.user_group_id = '42'");
		}
		if ($user_group_id == "45") {
            $this->db->where("lelang_users.user_group_id = '44'");
		}
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}

		if($id_ruas == 85){
			$this->db->where("lelang_users.user_group_id = '42'");
		} elseif($id_ruas == 63){
			$this->db->where("lelang_users.user_group_id = '44'");
		}

		$this->db->order_by('created_at', 'desc');
		// if ($page != "" && $item_per_page != "") {
		// 	$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		// }

		return $this->db->get()->result();
	}

	public function get_regulations($page = "", $item_per_page = "", $filename = "", $user_id,$user_group_id) {
		$this->db->select('documents_lelang.*,lelang_users.company_name,concat(lelang_users.`ceo_name`," ",lelang_users.`ceo_name`) as fullname');
        $this->db->from('documents_lelang');        
        $this->db->join('lelang_users', 'lelang_users.id = documents_lelang.lelang_user_id', 'left');
        if ($user_group_id != "4") {
            $this->db->where("documents_lelang.lelang_user_id = '".$user_id."'");
		}
		$this->db->where("documents_lelang.status != 'deleted'");
		$this->db->where('documents_lelang.content_type = "Lelang"');
		
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	
	
	public function get_published_documents($page = "", $item_per_page = "", $filename, $key) {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->join('document_metas', 'documents.id = document_metas.document_id', 'left');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where_in('documents_lelang.content_type', array('regulation','nspk'));
		$this->db->like('documents_lelang.title', $filename);
		$this->db->or_like('document_metas.meta_value', $key);
		$this->db->order_by('year ASC, semester ASC');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_regulations($page = "", $item_per_page = "", $filename = "", $semester = "", $year = "", $type = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where('documents_lelang.content_type = "regulation"');
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents_lelang.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents_lelang.year', $year);
		}
		if ($type != "" && $type != "all") {
			$this->db->where('documents_lelang.sub_content_type', $type);
		}
		$this->db->order_by('year ASC, semester ASC');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_spm($page = "", $item_per_page = "", $filename = "", $semester = "", $year = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where('documents_lelang.content_type = "spm"');
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents_lelang.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents_lelang.year', $year);
		}
		$this->db->order_by('year ASC, semester ASC');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_investment_opportunity() {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status != 'deleted'");
		$this->db->where('documents_lelang.content_type = "investment"');
		$this->db->order_by('created_at', 'desc');

		return $this->db->get()->result();
	}

	public function get_spm_recaps($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status != 'deleted'");
		$this->db->where('documents_lelang.content_type = "spm"');
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function count_documents($filename = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_regulations($filename = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status != 'deleted'");
		$this->db->where("documents_lelang.content_type = 'regulation'");
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_spm_recaps($filename = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status != 'deleted'");
		$this->db->where("documents_lelang.content_type = 'spm'");
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}

		return $this->db->count_all_results();
	}
	
	public function count_published_documents($filename = "", $key = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->join('document_metas', 'documents.id = document_metas.document_id', 'left');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where_in('documents_lelang.content_type', array('regulation','nspk'));
		$this->db->like('documents_lelang.title', $filename);
		$this->db->or_like('document_metas.meta_value', $key);
		return $this->db->count_all_results();
	}

	public function count_published_regulations($filename = "", $semester = "", $year = "", $type = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where("documents_lelang.content_type = 'regulation'");
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents_lelang.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents_lelang.year', $year);
		}
		if ($type != "" && $type != "all") {
			$this->db->where('documents_lelang.sub_content_type', $type);
		}

		return $this->db->count_all_results();
	}

	public function count_published_spm($filename = "", $semester = "", $year = "") {
		$this->db->select('*');
		$this->db->from('documents_lelang');
		$this->db->where("documents_lelang.status = 'published'");
		$this->db->where("documents_lelang.content_type = 'spm'");
		if ($filename != "") {
			$this->db->like('documents_lelang.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents_lelang.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents_lelang.year', $year);
		}

		return $this->db->count_all_results();
	}

	public function total_page($counts, $entry) {
		$page = floor($counts / $entry);

		if ($counts % $entry > 0) {
			$page += 1;
		}

		return $page;
	}

	public function get_documents_with_categories($item_per_page, $page) {
		$querystring = "SELECT documents_lelang.*, document_metas.meta_value FROM 
		(SELECT * FROM documents_lelang WHERE documents_lelang.status != 'deleted' ORDER BY documents_lelang.created_at LIMIT " . ($page-1) .", " . $item_per_page . ") documents_lelang
		LEFT OUTER JOIN document_metas ON documents_lelang.id = document_metas.document_id
		";

		return $this->db->query($querystring);
	}
	
	public function get_document($document_id) {
		$this->db->select('*');
		$this->db->where('id', $document_id);

		return $this->db->get('documents_lelang')->result();
	}

	public function get_regulation_by_slug($slug) {
		$this->db->where('slug', $slug);

		return $this->db->get('documents_lelang')->result();
	}

	public function get_document_metas($document_id) {
		$this->db->where('document_id', $document_id);

		return $this->db->get('document_metas')->result();
	}

	public function get_document_meta($document_id, $meta_key) {
		$this->db->select('meta_value');
		$this->db->where('document_id', $document_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->get('document_metas')->result();
	}

	public function get_all_document_categories() {
		$this->db->select('meta_value');
		$this->db->distinct();
		$this->db->where('meta_key = "keyword"');
		return $this->db->get('document_metas')->result();
	}
	
	public function insert($data) {
		return $this->db->insert('documents_lelang', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('document_metas', $data);
	}

	public function update($document_id, $data) {
		$this->db->where('id', $document_id);
		return $this->db->update('documents_lelang', $data);
	}

	public function update_meta($document_id, $data) {
		$this->db->where('id', $document_id);
		return $this->db->update('document_metas', $data);
	}

	public function destroy($document_id) {
		$document = $this->get_document($document_id);
		$document = $document[0];
		$data = array(
			'status'=>'deleted',
			'slug'=>$document->slug . '-' . $document->id,
			'title'=>$document->title . '-deleted',
			'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $document_id);
		return $this->db->update('documents_lelang', $data);
	}

	public function remove_meta($document_id, $meta_key) {
		$this->db->where('document_id', $document_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('document_metas');
    }
}
