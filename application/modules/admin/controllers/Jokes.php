<?php

class Jokes extends Admin_Controller
{
    private $top_category = 2; // ID of top level category for this controller
    private $allowed_categories = []; // ID's of allowed categories (parent, children) for this controller

    function __construct()
    {
        parent::__construct();

        $this->load->model(['blog/post']);
        $this->load->model(['blog/category']);
        $this->load->model(['blog/post_category']);

        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }

        $this->view_data['module_path'] = '/application/modules/admin';
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/';
    }

    public function index()
    {

        $this->load->helper('text');

        $categories         = $this->category->get_all();
        $categories_names = [];
        foreach($categories as $v) {
            $categories_names[$v['id']] = $v['name'];
        }

        $allowed_categories         = $this->category->get_sub_categories($this->top_category);
        $allowed_categories[] = $this->top_category;

        $posts = $this->post->posts_from_categories($allowed_categories);
        foreach($posts as $id => $v){
            if($v['content']) {
                $posts[$id]['content'] = word_limiter($v['content'], 10);
            }
        }

        $this->view_data['module_description']  = '';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "jokes_list";
        $this->view_data['posts'] = $posts;
        $this->view_data['categories_names'] = $categories_names;

        $this->load->view($this->_container, $this->view_data);
    }

    public function create()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_id', 'Kategoria','trim|required|greater_than[0]');
        $this->form_validation->set_rules('content', 'Treść','trim|required');
        $this->form_validation->set_rules('title', 'Tytuł', 'trim');
        $this->form_validation->set_rules('slug', 'Slug', 'trim');

        if($this->form_validation->run()===FALSE) {

            $this->view_data['category_options'] = $this->category->get_all_categories_selector($this->top_category, '');
            $this->view_data['module_description']  = '';
            $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "jokes_create";

            $this->load->view($this->_container, $this->view_data);
        }
        else {
            if($this->input->post('title')=='') {
                $title = 'joke_' . md5(time());
                $slug = $title;
            }
            else {
                $title = $this->input->post('title');
                $slug = $this->input->post('slug');
            }
            // Generate slug if empty
            if(!$this->input->post('slug')) {
                $slug = seo_url_slug($title, ['transliterate' => true]);
            }

            $title = 'joke_' . md5(time());
            $data['category_id'] = $this->input->post('category_id');
            $data['title'] = $title;
            $data['slug'] = $title;
            $data['content'] = $this->input->post('content');
            $this->post->create($data);
            redirect('/admin/jokes', 'refresh');
        }

    }

    public function edit(int $id)
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_id', 'Kategoria', 'trim|required|greater_than[0]');
        $this->form_validation->set_rules('content', 'Treść', 'trim|required');
        $this->form_validation->set_rules('title', 'Tytuł', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim');

        if($this->form_validation->run()===FALSE) {

            $old_post_categories = $this->post_category->get_post_categories($id);
            $post         = $this->post->get($id);
            $post->category_id = $old_post_categories->category_id;

            $this->view_data['category_options'] = $this->category->get_all_categories_selector($this->top_category, '');
            $this->view_data['post'] = $post;
            $this->view_data['module_description']  = '';
            $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "jokes_edit";

            $this->load->view($this->_container, $this->view_data);
        }
        else {
            // Get post categories before update
            $old_post_categories = $this->post_category->get_post_categories($id);

            if($this->input->post('title')=='') {
                $title = 'joke_' . md5(time());
                $slug = $title;
            }
            else {
                $title = $this->input->post('title');
                $slug = $this->input->post('slug');
            }
            // Generate slug if empty
            if(!$this->input->post('slug')) {
                $slug = seo_url_slug($title, ['transliterate' => true]);
            }

            $data['category_id'] = $this->input->post('category_id');
            $data['title'] = $title;
            $data['slug'] = $slug;
            $data['content'] = $this->input->post('content');
            $this->post->update_post($data, $old_post_categories, $id);
            redirect('/admin/jokes', 'refresh');
        }

    }

    public function delete($id)
    {
        $this->post->delete($id);
        redirect('/admin/jokes', 'refresh');
    }
}