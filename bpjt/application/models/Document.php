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
	
	
	public function get_published_documents($page = "", $item_per_page = "", $filename, $key) {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->join('document_metas', 'documents.id = document_metas.document_id', 'left');
		$this->db->where("documents.status = 'published'");
		$this->db->where_in('documents.sub_content_type', array('undang-undang','peraturan-pemerintah','peraturan-presiden','peraturan-menteri','keputusan-menteri','keputusan-kepala-bpjt','keputusan-gubernur','lainnya'));
		$this->db->where_in('documents.content_type', array('regulation','nspk'));
		$this->db->like('documents.title', $filename);
		$this->db->or_like('document_metas.meta_value', $key);
		$this->db->order_by('year ASC, semester ASC');
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
		$this->db->where_in('documents.sub_content_type', array('undang-undang','peraturan-pemerintah','peraturan-presiden','peraturan-menteri','keputusan-menteri','keputusan-kepala-bpjt','keputusan-gubernur','lainnya'));
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
	
	public function count_published_documents($filename = "", $key = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->join('document_metas', 'documents.id = document_metas.document_id', 'left');
		$this->db->where("documents.status = 'published'");
		$this->db->where_in('documents.sub_content_type', array('undang-undang','peraturan-pemerintah','peraturan-presiden','peraturan-menteri','keputusan-menteri','keputusan-kepala-bpjt','keputusan-gubernur','lainnya'));
		$this->db->where_in('documents.content_type', array('regulation','nspk'));
		$this->db->like('documents.title', $filename);
		$this->db->or_like('document_metas.meta_value', $key);
		return $this->db->count_all_results();
	}

	public function count_published_regulations($filename = "", $semester = "", $year = "", $type = "") {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where("documents.status = 'published'");
		$this->db->where_in('documents.sub_content_type', array('undang-undang','peraturan-pemerintah','peraturan-presiden','peraturan-menteri','keputusan-menteri','keputusan-kepala-bpjt','keputusan-gubernur','lainnya'));
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


	public function get_documentspq($page = "", $item_per_page = "", $filename = "", $id_ruas = "") {
		$subcontenttype1 = array('form-pq', 'form-conf');
		$subcontenttype2 = array('form-pqinvest', 'form-confinvest');
		$subcontenttype3 = array('form-investgili', 'form-confinvest');
		$subcontenttype4 = array('form-pqjorr2', 'form-confinvest');
		$subcontenttype5 = array('form-pqpatimban', 'form-confinvest');
		$subcontenttype6 = array('form-pqkater', 'form-confinvest');
		$subcontenttype7 = array('form-pqsetakarat', 'form-confinvest');
		$subcontenttype8 = array('form-pqboser', 'form-confinvest');
		$subcontenttype9 = array('form-pqkedigung', 'form-confinvest');
		$subcontenttype10 = array('form-pqgaetacim', 'form-confinvest');
		$subcontenttype11 = array('form-pqgilmeng', 'form-confinvest');
		$this->db->select('*');
		$this->db->from('documents');
		if ($this->session->userdata('user_group_id')=='19'||$this->session->userdata('user_group_id')=='21'||$this->session->userdata('user_group_id')=='25') {
			$this->db->where("documents.status != 'deleted'");
		}else{
			$this->db->where('documents.status','published');
		}
		// 
		if ($this->session->userdata('user_group_id')=='18'||$this->session->userdata('user_group_id')=='19') {
			# code...
			$this->db->where_in('documents.sub_content_type',$subcontenttype1);
			// $this->db->or_where("documents.sub_content_type = 'form-conf'");
		}
		if ($this->session->userdata('user_group_id')=='20'||$this->session->userdata('user_group_id')=='21'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype2);
			// $this->db->where("documents.sub_content_type = 'form-pqinvest'");
			// $this->db->or_where("documents.sub_content_type = 'form-confinvest'");
		}
		if ($this->session->userdata('user_group_id')=='24'||$this->session->userdata('user_group_id')=='25'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype3);
			// $this->db->where("documents.sub_content_type = 'form-pqinvest'");
			// $this->db->or_where("documents.sub_content_type = 'form-confinvest'");
		}
		if ($this->session->userdata('user_group_id')=='26'||$this->session->userdata('user_group_id')=='27'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype4);
			// $this->db->where("documents.sub_content_type = 'form-pqinvest'");
			// $this->db->or_where("documents.sub_content_type = 'form-confinvest'");
		}
		if ($this->session->userdata('user_group_id')=='28'||$this->session->userdata('user_group_id')=='29'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype5);
		}
		if ($this->session->userdata('user_group_id')=='30'||$this->session->userdata('user_group_id')=='31'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype6);
		}
		if ($this->session->userdata('user_group_id')=='32'||$this->session->userdata('user_group_id')=='33'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype7);
		}
		if ($this->session->userdata('user_group_id')=='34'||$this->session->userdata('user_group_id')=='35'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype8);
		}
		if ($this->session->userdata('user_group_id')=='36'||$this->session->userdata('user_group_id')=='37'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype9);
		}
		if ($this->session->userdata('user_group_id')=='42'||$this->session->userdata('user_group_id')=='43'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype10);
		}
		if ($this->session->userdata('user_group_id')=='44'||$this->session->userdata('user_group_id')=='45'){
			$this->db->where_in('documents.sub_content_type',$subcontenttype11);
		}
		if ($this->session->userdata('user_group_id')=='22') {
			# code...
			$this->db->where("documents.sub_content_type = 'form-conf'");
		}
		if ($this->session->userdata('user_group_id')=='23'){
			$this->db->where("documents.sub_content_type = 'form-confinvest'");
		}

		if ($filename != "") {
			$this->db->like('documents.title', $filename);
		}

		if($id_ruas == 85){
			$this->db->where_in('documents.sub_content_type',$subcontenttype10);
		} elseif($id_ruas == 63){
			$this->db->where_in('documents.sub_content_type',$subcontenttype11);
		}

		$this->db->order_by('created_at', 'desc');
		if ($page != "" && $item_per_page != "") {
			$this->db->limit($item_per_page, ($page-1) * $item_per_page);
		}

		return $this->db->get()->result();
	}
	public function downloadcek($document_id){
		# code...
		$this->db->select('*');
		$this->db->from('logs');		
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('object_id',$document_id);
		$this->db->where('log_message','Pengguna melakukan download ');
		return $this->db->get()->result();


	}

	  
}
