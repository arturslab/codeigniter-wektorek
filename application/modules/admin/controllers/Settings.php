<?php

class Settings extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(['admin/setting']);
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
        $settings         = $this->setting->get_all('', [], '', '', '', '', false);

        $this->view_data['module_description']  = 'W tym miejscu znajdują się ustawienia serwisu. Możesz tutaj m.in. zmienić nazwę serwisu, ustawienia do serwisów społecznościowych.';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "settings_list";
        $this->view_data['settings'] = $settings;

        $this->load->view($this->_container, $this->view_data);
    }

    public function create()
    {
        if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->category->insert($data);
            redirect('/admin/categories', 'refresh');
        }

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_create";

        $this->load->view($this->_container, $this->view_data);
    }

    public function edit($id)
    {

        if ($this->input->post('value')) {
            $data['value'] = $this->input->post('value');
            $this->setting->update($data, $id);
            redirect('/admin/settings', 'refresh');
        }
        $setting         = $this->setting->get($id);

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "settings_edit";
        $this->view_data['setting'] = $setting;

        $this->load->view($this->_container, $this->view_data);
    }

    public function delete($id)
    {
        $this->setting->delete($id);
        redirect('/admin/settings', 'refresh');
    }
}