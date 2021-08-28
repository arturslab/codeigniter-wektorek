<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Brands extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth']);
        if ( ! $this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
    }

    /*
    function __construct()
    {
        parent::__construct();
        $this->load->model(['admin/brand']);

    }
    */

    public function brands_list()
    {
        $this->load->model(['admin/brand']);
        $data = $this->brand->get_all();
        print_r($data);
    }
}