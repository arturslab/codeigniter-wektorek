<?php

class Users extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }

        $this->view_data['module_path'] = '/application/modules/admin';
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/';

    }

    public function test_page()
    {
        // TODO: Artur layout panelu admina do wyciecia w osobne widoki

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "test_layout";

        $this->load->view($this->_container, $this->view_data);
    }

    public function index()
    {
        //$users         = $this->ion_auth->users([1,2,3])->result();

        $this->load->model(['admin/user']);
        $_users = $this->user->get_users_with_groups();

        // Prepare data for view
        $users = $this->prepare_view_data($_users);

        $this->view_data['module_description']  = 'Zarządzanie użytkownikami, dodawanie (rejestrowanie) nowych. Użytkownikom możesz zmieniać uprawnienia poprzez przypisanie ich do odpowiednich grup użytkowników.';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_list";
        $this->view_data['users'] = $users;

        $this->load->view($this->_container, $this->view_data);
    }

    public function create()
    {

        if ($this->input->post('username')) {
            $username        = $this->input->post('username');
            $password        = $this->input->post('password');
            $email           = $this->input->post('email');
            $group_id        = [$this->input->post('group_id')];
            $additional_data = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'username'   => $this->input->post('username'),
                'phone'      => $this->input->post('phone'),
            ];
            $user            = $this->ion_auth->register($email, $password, $email, $additional_data, $group_id);
            if ( ! $user) {
                $errors = $this->ion_auth->errors();
                echo $errors;
                die('done');
            } else {
                redirect('/admin/users', 'refresh');
            }
        }


        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_create";
        $this->view_data['groups'] = $this->ion_auth->groups()->result();

        $this->load->view($this->_container, $this->view_data);
    }

    public function edit($id)
    {
        if ($this->input->post('first_name')) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name']  = $this->input->post('last_name');
            $data['email']      = $this->input->post('email');
            $data['phone']      = $this->input->post('phone');
            $group_id           = $this->input->post('group_id');
            $this->ion_auth->remove_from_group('', $id);
            $this->ion_auth->add_to_group($group_id, $id);
            $this->ion_auth->update($id, $data);
            redirect('/admin/users', 'refresh');
        }
        // TODO: Artur co to za helper (ui) ?!
//        $this->load->helper('ui');
//        $data['groups']     = $this->ion_auth->groups()->result();
//        $data['user']       = $this->ion_auth->user($id)->row();
//        $data['user_group'] = $this->ion_auth->get_users_groups($id)->row();
//        $data['page']       = $this->config->item('ci_my_admin_template_dir_admin') . "users_edit";
//
//        $data['env'] = $this->env;
//        $data['view_data'] = $this->view_data;
//
//        $this->load->view($this->_container, $data);


        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_edit";
        $this->view_data['groups'] = $this->ion_auth->groups()->result();
        $this->view_data['user'] = $this->ion_auth->user($id)->row();
        $this->view_data['user_group'] = $this->ion_auth->get_users_groups($id)->row();

        $this->load->view($this->_container, $this->view_data);
    }

    public function delete($id)
    {
        $this->ion_auth->delete_user($id);
        redirect('/admin/users', 'refresh');
    }

    /*
     * Tworzy konto użytkownika
     */
    public function register()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email','Email','trim|valid_email|required');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');

        if($this->form_validation->run()===FALSE)
        {
            $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_create";

            $this->view_data['groups'] = [];
            $groups = $this->ion_auth->groups()->result_array();
            if($groups) {
                foreach($groups as $v) {
                    $this->view_data['groups'][$v['id']] = $v['description'];
                }
            }
            $this->load->view($this->_container, $this->view_data);
        }
        else {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $username = $this->input->post('first_name');
            $email = $this->input->post('email');
            $password = $this->input->post('first_name');

            $additional_data = [
                'first_name' => $first_name,
                'last_name' => $last_name
            ];

            $this->load->library('ion_auth');
            if($this->ion_auth->register($username,$password,$email,$additional_data))
            {
                $_SESSION['auth_message'] = 'The account has been created. You may now login.';
                $this->session->mark_as_flash('auth_message');
                redirect('auth');
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('/admin/users/register', 'refresh');
            }
        }


    }

    // Przygotuj dane do insertu/widoku
    private function prepare_view_data($data)
    {
        $_data = [];
        foreach ($data as $row) {

            $html_belongs_to = '';
            $belongs_to = explode(',', $row['belongs_to']);
            foreach($belongs_to as $v) {
                $html_belongs_to .= '<span class="badge badge-users-' . trim($v) . '">' . trim($v) . '</span> ';
            }

            $_data[] = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'last_login' => $row['last_login'],
                'active' => $row['active'],
                'belongs_to' => trim($html_belongs_to),
            ];
        }

        return $_data;
    }
}