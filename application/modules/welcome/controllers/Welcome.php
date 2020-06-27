<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Welcome
 *
 * @property Welcome $welcome Welcome module
 */
class Welcome extends MY_Controller
{

    /** Atrybuty zapisu do logow @var array $logsAttr */
    // private $logsAttr;

    public function __construct()
    {
        parent::__construct();

        // Load default module model
        $this->load->model(__CLASS__ . 'Model');

        $this->module = 'welcome';

        $this->logsAttr = [
            'module' => $this->module,
            'class'  => __CLASS__,
        ];

        // Domyslna strona do przekierowan
        $this->defaultPageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->module;

    }


    /**
     *  Widok domyślny
     */
    public function index()
    {

        // Odnotuj zdarzenie
        $this->addLog('logs', 'info', 'Dashboard', 'Test Welcome', true);

        // Default view data
        $this->view_data['meta_title']       = 'Wektorek.pl';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_keywords']    = '';
        $this->view_data['title']            = 'Wektorek.pl';
        $this->view_data['module_css']       = $this->module . '.css';
        $this->view_data['module_js']        = $this->module . '.js';
        $this->view_data['module_name']      = $this->module;
        $this->view_data['module_path']      = '/application/modules/' . $this->module;
        $this->view_data['module_url']       = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->module . '/';
        $this->view_data['page']             = $this->config->item('ci_my_admin_template_dir_public') . "welcome";
        $this->view_data['module']           = $this->module;
        $this->view_data['page_slug']        = $this->module;

        $this->load->view($this->_container, $this->view_data);

    }

}
