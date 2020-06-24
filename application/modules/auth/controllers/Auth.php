<?php
if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'),
            $this->config->item('error_end_delimiter', 'ion_auth'));
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/dashboard', 'refresh');
        } else {
            $data['page']   = $this->config->item('ci_my_admin_template_dir_public') . "login_form";
            $data['module'] = 'auth';
            $this->load->view($this->_container, $data);
        }
    }

    function login()
    {
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Hasło', 'trim|required');
        $this->form_validation->set_rules('ajax','AJAX','trim|is_natural');
        if ($this->form_validation->run() == true) {
            $remember = (bool)$this->input->post('remember');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->ion_auth->set_hook('post_login_successful', 'get_gravatar_hash', $this, '_gravatar', []);
            if ($this->ion_auth->login($email, $password, $remember)) {

                // Sprawdz czy logowanie AJAXem
                if($this->input->post('ajax'))
                {
                    $response['logged_in'] = 1;
                    header("content-type:application/json");
                    echo json_encode($response);
                    exit;
                }

                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('/admin/dashboard', 'refresh');
            } else {

                // Sprawdz czy logowanie AJAXem
                if($this->input->post('ajax'))
                {

                    $response['error'] = $this->ion_auth->errors();
                    header("content-type:application/json");
                    echo json_encode($response);
                    exit;
                }


                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth', 'refresh');
            }
        } else {

            if($this->input->post('ajax'))
            {
                $response['email_error'] = form_error('email');
                $response['password_error'] = form_error('password');
                header("content-type:application/json");
                echo json_encode($response);
                exit;
            }

            $this->session->set_flashdata('message', $this->ion_auth->errors());
            (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data = [];
            $data['page']   = $this->config->item('ci_my_admin_template_dir_public') . "login_form";
            $data['module'] = 'auth';
            $this->load->view($this->_container, $data);
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('auth', 'refresh');
    }

    public function _gravatar()
    {
        if($this->form_validation->valid_email($_SESSION['email']))
        {
            $gravatar_url = md5(strtolower(trim($_SESSION['email'])));
            $_SESSION['gravatar'] = $gravatar_url;
        }
        return TRUE;
    }
}