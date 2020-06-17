<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_Controller extends MX_Controller
{

    var $_container;
    var $_modules;

    /* Custmo variables for views (i.e. Meta title, view configurations, etc.) */
    var $view_data;

    /** Srodowisko produkcyjne (Prod) lub developerskie (Dev).
    Do wyświetlania zmiennych pomocniczych dla developerow */
    var $env;

    public function construct_OLD()
    {
        parent::__construct();

        // Load helpers //
        $this->load->helper('Functions');
        $this->load->helper('url');
        $this->load->config('ci_my_admin');

        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_public') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        log_message('debug', 'CI My Admin : Admin_Controller class loaded');

    }

    function __construct()
    {
        parent::__construct();

        // Load helpers //
        $this->load->helper('Functions');
        $this->load->helper('url');
        $this->load->config('ci_my_admin');

        // Dev - tryb developerski (wyswietla dodatkowe info w szablonach). Prod - tryb produkcyjny
        $this->env = 'prod';

        $this->view_data['meta_title'] = '';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_tags'] = '';
        $this->view_data['website_name'] = '';
        // TODO: Artur dane konfiguracyjne pobierać z bazy
        $this->view_data['config'] = [];

        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_admin') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');
        $this->load->library(['ion_auth']);
        if ( ! $this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        $this->is_admin       = $this->ion_auth->is_admin();
        $user                 = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;

        $this->view_data['user'] = $user;

        log_message('debug', 'CI My Admin : Admin_Controller class loaded');
    }



}
