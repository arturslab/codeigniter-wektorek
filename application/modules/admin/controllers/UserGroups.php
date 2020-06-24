<?php

class UserGroups extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the user groups page.');
            redirect('admin/dashboard');
        }

        $this->view_data['module_path'] = '/application/modules/admin';
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/';
    }

    public function index()
    {
        $groups         = $this->ion_auth->groups()->result();
//        $data['groups'] = $groups;
//        $data['page']   = $this->config->item('ci_my_admin_template_dir_admin') . "groups_list";
//        $this->load->view($this->_container, $data);

        $this->view_data['module_description']  = 'Zarządzanie grupami użytkowników mających dostęp do panelu. Poszczególne grupy mają dostęp do wydzielonych sekcji panelu. Pamiętaj, że zanim dodasz nowego użytkownika, musi być utworzona grupa, do której ma należeć nowy użytkownik.';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "groups_list";
        $this->view_data['env'] = $this->env;
        $this->view_data['groups'] = $groups;

        $this->load->view($this->_container, $this->view_data);
    }

    public function create()
    {
        if ($this->input->post('name')) {
            $name        = $this->input->post('name');
            $description = $this->input->post('description');
            $group       = $this->ion_auth->create_group($name, $description);
            if ( ! $group) {
                $view_errors = $this->ion_auth->messages();
            } else {
                redirect('/admin/usergroups', 'refresh');
            }
        }

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "groups_create";

        $this->load->view($this->_container, $this->view_data);
    }

    public function edit(int $id)
    {
        if ($this->input->post('name')) {
            $name         = $this->input->post('name');
            $description  = $this->input->post('description');
            $group_update = $this->ion_auth->update_group($id, $name, ['description'=>$description]);
            redirect('/admin/usergroups', 'refresh');
        }

        $group         = $this->ion_auth->group($id)->row();

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "groups_edit";
        $this->view_data['group'] = $group;
        $this->view_data['user_group'] = $this->ion_auth->get_users_groups($id)->row();

        $this->load->view($this->_container, $this->view_data);
    }

    public function delete(int $id)
    {
        $group_delete = $this->ion_auth->delete_group($id);
        redirect('/admin/usergroups', 'refresh');
    }
}