<?php

class Categories extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(['blog/category']);
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
        $categories         = $this->category->get_all();
        $categories_names = [];
        foreach($categories as $v) {
            $categories_names[$v['id']] = $v['name'];
        }

        $this->view_data['module_description']  = 'Zarządzanie kategoriami wszystkich wpisów w serwisie.';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_list";
        $this->view_data['categories'] = $categories;
        $this->view_data['categories_names'] = $categories_names;

        $this->load->view($this->_container, $this->view_data);
    }

    public function create()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nazwa kategorii','trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('parent_id', 'Kategoria nadrzędna','trim|required|is_natural');
        $this->form_validation->set_rules('slug', 'Slug','trim|required|alpha_dash|is_unique[categories.slug]');
        $this->form_validation->set_rules('title', 'Tytuł','trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('description', 'Opis','trim|alpha_numeric_spaces');

        if($this->form_validation->run()===FALSE) {

            $this->view_data['category_options'] = $this->category->get_all_categories_selector(0, '');

            $this->view_data['module_description']  = 'Edycja nowej kategorii.';
            $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_create";

            $this->load->view($this->_container, $this->view_data);
        }
        else {
            $data['parent_id'] = $this->input->post('parent_id');
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = $this->input->post('slug');
            $data['title'] = $this->input->post('title');
            $this->category->insert($data);
            redirect('/admin/categories', 'refresh');
        }

    }

    public function edit(int $id)
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nazwa kategorii','trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('parent_id', 'Kategoria nadrzędna','trim|required|is_natural');
        $this->form_validation->set_rules('slug', 'Slug','trim|required|alpha_dash'); // TODO: Artur |is_unique[categories.slug]
        $this->form_validation->set_rules('title', 'Tytuł','trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('description', 'Opis','trim');

        if($this->form_validation->run()===FALSE) {

            $category         = $this->category->get($id);
            $this->view_data['category_options'] = $this->category->get_all_categories_selector(0, '');
            $this->view_data['category'] = $category;
            $this->view_data['module_description']  = 'Edycja wybranej kategorii.';
            $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_edit";

            $this->load->view($this->_container, $this->view_data);
        }
        else {
            $data['parent_id'] = $this->input->post('parent_id');
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = $this->input->post('slug');
            $data['title'] = $this->input->post('title');
            $this->category->update($data, $id);
            redirect('/admin/categories', 'refresh');
        }

    }

    public function delete($id)
    {
        $this->category->delete($id);
        redirect('/admin/categories', 'refresh');
    }
}