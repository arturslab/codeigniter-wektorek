<?php

class Settings extends Admin_Controller
{
    function __construct()
    {
//        parent::__construct();

        parent::__construct();
        $this->load->model(['admin/setting']);
        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }
    }

    public function index()
    {
        $settings         = $this->setting->get_all('', [], '', '', '', '', false);
        $data['settings'] = $settings;
        $data['page']       = $this->config->item('ci_my_admin_template_dir_admin') . "settings_list";
        $data['env'] = $this->env;
        $data['view_data'] = $this->view_data;

        $this->load->view($this->_container, $data);
    }

    public function create()
    {
        if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->category->insert($data);
            redirect('/admin/categories', 'refresh');
        }
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_create";
        $data['env'] = $this->env;
        $data['view_data'] = $this->view_data;
        $this->load->view($this->_container, $data);
    }

    public function edit($id)
    {

        if ($this->input->post('value')) {
            $data['value'] = $this->input->post('value');
            $this->setting->update($data, $id);
            redirect('/admin/settings', 'refresh');
        }
        $setting         = $this->setting->get($id);
        $data['setting'] = $setting;
        $data['page']     = $this->config->item('ci_my_admin_template_dir_admin') . "settings_edit";
        $data['env'] = $this->env;
        $data['view_data'] = $this->view_data;
        $this->load->view($this->_container, $data);
    }

    public function delete($id)
    {
        $this->setting->delete($id);
        redirect('/admin/settings', 'refresh');
    }
}