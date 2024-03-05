<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Form_Toll extends CI_Controller
{
    public $user_access;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('/admin');
        }

        // $this->load->model('access');
        // $this->user_access = $this->access->get_user_access_by_key('artikel_sub_kategori_berita', $this->session->userdata('user_group_id'));
        // $this->user_access = $this->user_access[0];
        // if (($this->router->fetch_method() == 'index' || $this->router->fetch_method() == 'show') && !$this->user_access->single) {
        //     $this->session->set_flashdata('access_denied', true);
        //     redirect('/admin/dashboard');
        // } elseif ($this->router->fetch_method() == 'add' && !$this->user_access->add) {
        //     $this->session->set_flashdata('access_denied', true);
        //     redirect('/admin/dashboard');
        // } elseif ($this->router->fetch_method() == 'edit' && !$this->user_access->edit) {
        //     $this->session->set_flashdata('access_denied', true);
        //     redirect('/admin/dashboard');
        // } elseif ($this->router->fetch_method() == 'destroy' && !$this->user_access->destroy) {
        //     echo json_encode(array('status' => 'fail', 'code' => 1));
        //     exit;
        // }
    }

    public function index()
    {
        $this->load->model('comment');

        $breadcrumbs = array(
            '#' => 'Artikel',
            '' => 'Sub Kategori'
        );
        $jscripts = array(
            'elements.js' => 'application',
            'prettify/prettify.js' => 'vendor',
            'jquery.jgrowl.js' => 'vendor',
            'jquery.alerts.js' => 'vendor',
            'jquery.dataTables.min.js' => 'vendor',
            'admin.sub-category.index.js' => 'application'
        );

        $data = array(
            'menu' => $this->load->view('layouts/admin_menu', null, true),
            'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Sub Kategori'), true),
            'content' => $this->load->view('admin/form_toll/index', array('flash' => $this->session->flashdata('form_toll')), true),
            'jscripts' => $jscripts,
            'unread_comments' => $this->comment->get_total_unread_comments()
        );
        $this->load->view('layouts/admin_content.php', $data);
    }

    public function show($id)
    {
        $this->load->model(array('article_sub_category', 'comment'));

        $breadcrumbs = array(
            '#' => 'Artikel',
            'admin/article_sub_categories' => 'Sub Kategori',
            '' => 'Lihat Sub Kategori'
        );

        $sub_category = $this->article_sub_category->get_sub_category($id);

        if (count($sub_category) > 0) {
            $data = array(
                'menu' => $this->load->view('layouts/admin_menu', null, true),
                'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Lihat Sub Kategori'), true),
                'content' => $this->load->view('admin/article_sub_categories/show', array('sub_category' => $sub_category[0], 'flash' => $this->session->flashdata('article_sub_categories_success')), true),
                'unread_comments' => $this->comment->get_total_unread_comments()
            );
            $this->load->view('layouts/admin_content.php', $data);
        } else {
            redirect('admin');
        }
    }

    public function add($filled_value = null)
    {
        $this->load->model(array('article_category', 'article_sub_category', 'comment'));
        $this->load->helper('form');

        $breadcrumbs = array(
            '#' => 'Artikel',
            'admin/article_sub_categories' => 'Sub Kategori',
            '' => 'Tambah Kategori'
        );
        $jscripts = array(
            'jquery.validate.min.js' => 'vendor',
            'jquery.tagsinput.min.js' => 'vendor',
            'jquery.autogrow-textarea.js' => 'vendor',
            'charCount.js' => 'vendor',
            'ui.spinner.min.js' => 'vendor',
            'chosen.jquery.min.js' => 'vendor',
            'forms.js' => 'vendor',
            'tinymce/jquery.tinymce.js' => 'vendor',
            'wysiwyg.js' => 'vendor'
        );
        $stylesheets = array('admin.sub-category.form.css');
        $sub_category = null;
        if (isset($filled_value)) {
            $sub_category = $filled_value;
        }
        $category_ids = array();
        $category_ens = array();

        $categories = $this->article_category->get_categories_by_lang("id");
        foreach ($categories as $category) {
            $category_ids[$category->id] = $category->name;
        }

        $categories = $this->article_category->get_categories_by_lang("en");
        foreach ($categories as $category) {
            $category_ens[$category->id] = $category->name;
        }

        $data = array(
            'menu' => $this->load->view('layouts/admin_menu', null, true),
            'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Tambah Sub Kategori'), true),
            'content' => $this->load->view('admin/article_sub_categories/add', array('sub_category' => $sub_category, 'category_ids' => $category_ids, 'category_ens' => $category_ens), true),
            'jscripts' => $jscripts,
            'stylesheets' => $stylesheets,
            'unread_comments' => $this->comment->get_total_unread_comments()
        );
        $this->load->view('layouts/admin_content.php', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->load->model(array('article_sub_category', 'user_log'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Judul / Title', 'trim|callback_check_title');
            $this->form_validation->set_message('check_title', 'Minimal salah satu judul Bahasa Indonesia atau Bahasa Inggris harus terisi.');

            if ($this->form_validation->run()) {
                if ($this->input->post('title_id', true) != '') {
                    $data_id = array(
                        'name' => $this->input->post('title_id', true),
                        'slug' => $this->create_slug($this->input->post('title_id', true)),
                        'status' => $this->input->post('status_id', true),
                        'article_category_id' => $this->input->post('category_id', true),
                        'lang' => 'id',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->article_sub_category->insert($data_id);
                    $sub_category_id = $this->db->insert_id();
                }

                if ($this->input->post('title_en', true) && $this->input->post('title_en', true) != "") {
                    $data_en = array(
                        'name' => $this->input->post('title_en', true),
                        'slug' => $this->create_slug($this->input->post('title_en', true)),
                        'status' => $this->input->post('status_en', true),
                        'article_category_id' => $this->input->post('category_en', true),
                        'lang' => 'en',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->article_sub_category->insert($data_en);

                    if (!isset($sub_category_id)) {
                        $sub_category_id = $this->db->insert_id();
                    }
                }

                $this->user_log->add_log($this->session->userdata('user_id'), 'article_sub_categories', $sub_category_id, 'Pengguna menambah data sub kategori berita');

                $this->session->set_flashdata('article_sub_categories_success', true);
                redirect('admin/article_sub_categories/show/' . $sub_category_id);
            } else {
                $this->add($this->input->post());
            }
        }
    }

    public function edit($id, $filled_value = null)
    {
        $this->load->model(array('article_category', 'article_sub_category', 'comment'));
        $this->load->helper('form');

        $sub_category = $this->article_sub_category->get_sub_category($id);

        if (count($sub_category) > 0) {
            $breadcrumbs = array(
                '#' => 'Artikel',
                'admin/article_sub_categories' => 'Sub Kategori',
                '' => 'Ubah Kategori'
            );
            $jscripts = array(
                'jquery.validate.min.js' => 'vendor',
                'jquery.tagsinput.min.js' => 'vendor',
                'jquery.autogrow-textarea.js' => 'vendor',
                'charCount.js' => 'vendor',
                'ui.spinner.min.js' => 'vendor',
                'chosen.jquery.min.js' => 'vendor',
                'forms.js' => 'vendor',
                'tinymce/jquery.tinymce.js' => 'vendor',
                'wysiwyg.js' => 'vendor'
            );
            $stylesheets = array('admin.sub-category.form.css');

            if (isset($filled_value)) {
                $sub_category[0]->name = $filled_value['title'];
                $sub_category[0]->status = $filled_value['status'];
                $sub_cateogry[0]->article_category_id = $filled_value['category_id'];
            }
            $categories = array();

            if ($sub_category[0]->lang == "id") {
                $category_ids = $this->article_category->get_categories_by_lang("id");
                foreach ($category_ids as $category) {
                    $categories[$category->id] = $category->name;
                }
            } else {
                $category_ens = $this->article_category->get_categories_by_lang("en");
                foreach ($category_ens as $category) {
                    $categories[$category->id] = $category->name;
                }
            }

            $data = array(
                'menu' => $this->load->view('layouts/admin_menu', null, true),
                'content_head' => $this->load->view('layouts/admin_content_head', array('breadcrumbs' => $breadcrumbs, 'subtitle' => 'KONTEN', 'title' => 'Ubah Sub Kategori'), true),
                'content' => $this->load->view('admin/article_sub_categories/edit', array('sub_category' => $sub_category[0], 'categories' => $categories, 'id' => $id), true),
                'jscripts' => $jscripts,
                'stylesheets' => $stylesheets,
                'unread_comments' => $this->comment->get_total_unread_comments()
            );
            $this->load->view('layouts/admin_content.php', $data);
        } else {
            redirect('admin');
        }
    }

    public function update($id)
    {
        if ($this->input->post()) {
            $this->load->model(array('article_sub_category', 'user_log'));
            $this->load->library('form_validation');

            $sub_category = $this->article_sub_category->get_sub_category($id);

            if (count($sub_category) > 0) {
                $this->form_validation->set_rules('title', 'Judul / Title', 'trim|required');
                $this->form_validation->set_message('required', 'Judul / Title harus terisi.');

                if ($this->form_validation->run()) {
                    $data = array(
                        'name' => $this->input->post('title', true),
                        'slug' => $this->create_slug($this->input->post('title', true)),
                        'article_category_id' => $this->input->post('category_id', true),
                        'status' => $this->input->post('status', true)
                    );

                    $this->article_sub_category->update($id, $data);

                    $this->user_log->add_log($this->session->userdata('user_id'), 'article_sub_categories', $id, 'Pengguna mengubah data sub kategori berita');

                    $this->session->set_flashdata('article_sub_categories_success', true);
                    redirect('admin/article_sub_categories/show/' . $id);
                } else {
                    $this->edit($id, $this->input->post());
                }
            } else {
                redirect('admin');
            }
        }
    }

    public function update_status($id)
    {
        $this->load->model(array('article_sub_category', 'user_log'));
        $article_sub_category = $this->article_sub_category->get_sub_category($id);
        $article_sub_category = $article_sub_category[0];
        if ($article_sub_category->status != "deleted") {
            if ($article_sub_category->status == "published") {
                $data = array(
                    'status' => 'draft',
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'status' => 'published',
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }

            $this->article_sub_category->update($id, $data);

            $this->user_log->add_log($this->session->userdata('user_id'), 'article_sub_categories', $id, 'Pengguna mengubah status data sub kategori berita');

            $this->session->set_flashdata('article_sub_categories_success', true);
            redirect('admin/article_sub_categories');
        } else {
            redirect('/admin');
        }
    }

    public function destroy()
    {
        if ($this->input->post('sub_category_ids', true)) {
            $this->load->model(array('article_sub_category', 'user_log'));
            $sub_category_ids = $this->input->post('sub_category_ids', true);
            foreach ($sub_category_ids as $sub_category_id) {
                $this->article_sub_category->destroy($sub_category_id);
                $this->user_log->add_log($this->session->userdata('user_id'), 'article_sub_categories', $sub_category_id, 'Pengguna menghapus data sub kategori berita');
            }
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'fail', 'code' => 0));
        }
    }

    public function api_get_all_sub_categories()
    {
        $this->load->model('article_sub_category');

        $sub_categories = $this->article_sub_category->fetch_sub_categories("", "", null);

        $ret_sub_categories = array();
        $no = 1;
        foreach ($sub_categories as $sub_category) {
            $checkbox = "<span class=\"center\"><div class=\"checker\" id=\"uniform-checker-" . $no . "\"><span><input type=\"checkbox\" class=\"checkerbox\" data-id=\"" . $sub_category->id . "\" id=\"checker-" . $sub_category->id . "\" /></span></div></span>";
            $created_at = strtotime($sub_category->created_at);
            $updated_at = strtotime($sub_category->updated_at);
            $lang = ($sub_category->lang == "id") ? "Indonesia" : "Inggris";

            if ($this->user_access->edit) {
                if ($sub_category->status == "published") {
                    $status = "<a href=\"" . site_url('admin/article_sub_categories/update_status/' . $sub_category->id) . "\" class=\"sub-category-status\" data-id=\"" . $sub_category->id . "\" id=\"sub-category-status-" . $sub_category->id . "\" data-status=\"published\"><i class=\"icon-ok\"></i></a>";
                } else {
                    $status = "<a href=\"" . site_url('admin/article_sub_categories/update_status/' . $sub_category->id) . "\" class=\"sub-category-status\" data-id=\"" . $sub_category->id . "\" id=\"sub-category-status-" . $sub_category->id . "\" data-status=\"draft\"><i class=\"icon-remove\"></i></a>";
                }
            } else {
                $status = "";
            }

            $temp_sub_category = array($checkbox, $no, $sub_category->name, $sub_category->category_name, $sub_category->slug, $status, date('d M Y H:i:s', $created_at), date('d M Y H:i:s', $updated_at), $lang);
            array_push($ret_sub_categories, $temp_sub_category);
            $no++;
        }
        $json = array('aaData' => $ret_sub_categories);

        echo json_encode($json);
    }

    public function api_get_by_category_id()
    {
        if ($this->input->get('category_id', true)) {
            $this->load->model('article_sub_category');
            $category_id = clean_str($this->input->get('category_id', true));
            $db_sub_categories = $this->article_sub_category->get_sub_categories_by_category_id($category_id);

            $sub_categories = array();
            foreach ($db_sub_categories as $sub_category) {
                array_push($sub_categories, array('id' => $sub_category->id, 'value' => $sub_category->name));
            }

            echo json_encode(array('status' => 'success', 'sub_categories' => $sub_categories));
        } else {
            echo json_encode(array('status' => 'fail', 'code' => 0));
        }
    }

    private function create_slug($string)
    {
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);

        return $string;
    }

    public function check_title()
    {
        if ($this->input->post('title', true)) {
            $title = $this->input->post('title', true);

            if ($title == "") {
                return false;
            } else {
                return true;
            }
        } else {
            $title_id = $this->input->post('title_id', true);
            $title_en = $this->input->post('title_en', true);

            if ($title_id == "" && $title_en == "") {
                return false;
            } else {
                return true;
            }
        }
    }
}

/* End of file article_sub_categories.php */
/* Location: ./application/controllers/admin/article_sub_categories.php */