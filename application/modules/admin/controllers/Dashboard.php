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

    }

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

    public function index()
    {

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "dashboard";

        $this->load->view($this->_container, $this->view_data);
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