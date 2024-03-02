<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_documents($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}

		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_regulations($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");
		$this->db->where('documents.content_type = "regulation"');
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_regulations($page = "", $item_per_page = "", $filename = "", $semester = "", $year = "", $type = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status = 'published'");
		$this->db->where('documents.content_type = "regulation"');
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents.year', $year);
		}
		if ($type != "" && $type != "all") {
			$this->db->where('documents.sub_content_type', $type);
		}
		$this->db->order_by('year ASC, semester ASC');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_published_spm($page = "", $item_per_page = "", $filename = "", $semester = "", $year = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status = 'published'");
		$this->db->where('documents.content_type = "spm"');
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents.year', $year);
		}
		$this->db->order_by('year ASC, semester ASC');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function get_investment_opportunity() {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");
		$this->db->where('documents.content_type = "investment"');
		$this->db->order_by('created_at', 'desc');

		return $this->db->get()->result();
	}

	public function get_spm_recaps($page = "", $item_per_page = "", $filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");
		$this->db->where('documents.content_type = "spm"');
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}

	public function count_documents($filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");

		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_regulations($filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");
		$this->db->where("documents.content_type = 'regulation'");
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_spm_recaps($filename = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status != 'deleted'");
		$this->db->where("documents.content_type = 'spm'");
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}

		return $this->db->count_all_results();
	}

	public function count_published_regulations($filename = "", $semester = "", $year = "", $type = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status = 'published'");
		$this->db->where("documents.content_type = 'regulation'");
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents.year', $year);
		}
		if ($type != "" && $type != "all") {
			$this->db->where('documents.sub_content_type', $type);
		}

		return $this->db->count_all_results();
	}

	public function count_published_spm($filename = "", $semester = "", $year = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status = 'published'");
		$this->db->where("documents.content_type = 'spm'");
		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}
		if ($semester != "" && $semester != "0") {
			$this->db->where('documents.semester', $semester);
		}
		if ($year != "" && $year != "0") {
			$this->db->where('documents.year', $year);
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
		$querystring = "SELECT documents.*, document_metas.meta_value FROM 
		(SELECT * FROM documents WHERE documents.status != 'deleted' ORDER BY documents.created_at LIMIT " . ($page-1) .", " . $item_per_page . ") documents
		LEFT OUTER JOIN document_metas ON documents.id = document_metas.document_id
		";

		return $this->db->query($querystring);
	}
	
	public function get_document($document_id) {
		$this->db->select('*');
		$this->db->where('id', $document_id);

		return $this->db->get('documents')->result();
	}

	public function get_regulation_by_slug($slug) {
		$this->db->where('slug', $slug);

		return $this->db->get('documents')->result();
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
		return $this->db->insert('documents', $data);
	}

	public function insert_meta($data) {
		return $this->db->insert('document_metas', $data);
	}

	public function update($document_id, $data) {
		$this->db->where('id', $document_id);
		return $this->db->update('documents', $data);
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
		return $this->db->update('documents', $data);
	}

	public function remove_meta($document_id, $meta_key) {
		$this->db->where('document_id', $document_id);
		$this->db->where('meta_key', $meta_key);
		return $this->db->delete('document_metas');
	}
	  
}
