<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends Admin_Controller
{

    function construct_OLD()
    {
        parent::__construct();
        $this->load->library(['ion_auth']);
        if ( ! $this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_admin') . "layout.php";
//        $this->_container = $this->config->item('ci_my_admin_template_dir_public') . "layout.php";
//        $this->_modules = $this->config->item('modules_locations');
//        log_message('debug', 'CI My Admin : MY_Controller class loaded');

    }

    function __construct()
    {
        parent::__construct();
        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }

    }

    /*
    function __construct()
    {
        parent::__construct();
        $this->load->model(['admin/brand']);

    }
    */

    public function index()
    {
        $data['page']  = $this->config->item('ci_my_admin_template_dir_admin') . "dashboard";
        $data['env'] = $this->env;
        $data['view_data'] = $this->view_data;

        $this->load->view($this->_container, $data);
    }

    /*
    public function brands_list()
    {
        $this->load->model(['admin/brand']);
        $data = $this->brand->get_all();
        print_r($data);
    }
    */
}