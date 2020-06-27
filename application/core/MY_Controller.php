<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends MX_Controller
{

    /** Logged-in user role @var int $currentUserRole */
    public $currentUserRole;

    // Database logs table configuration
    public $logsAttr;

    /** @var array $viewData */
    public $view_data;

    /** @var array $pageMetaSection */
    public $pageMetaSection;

    /** Current date @var string $date */
    public $date = null;


    var $_container;
    var $_modules;

    /** Srodowisko produkcyjne (Prod) lub developerskie (Dev).
     Do wyświetlania zmiennych pomocniczych dla developerow */
    var $env;

    public function __construct()
    {
        parent::__construct();

        // Load helpers //
        $this->load->helper('Functions');
        $this->load->helper('url');
        $this->load->config('ci_my_admin');

        // Dev - tryb developerski (wyswietla dodatkowe info w szablonach). Prod - tryb produkcyjny
        $this->env = 'prod';

        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_public') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        log_message('debug', 'CI My Admin : MY_Controller class loaded');

        $this->view_data['meta_title']       = 'Wektorek.pl';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_keywords']    = '';
        $this->view_data['title']            = 'Wektorek.pl';
        $this->view_data['module_name']      = ''; // Nazwa modulu z pliku konfiguracyjnego
        $this->view_data['module_css']       = ''; // Załączony CSS: nazwa_modulu.css
        $this->view_data['module_js']        = ''; // Załączony JS: nazwa_modulu.js
        // TODO: Artur dane konfiguracyjne pobierać z bazy
        $this->view_data['config'] = [];
        $this->view_data['module_path'] = null; // Ścieżka do modułu
        $this->view_data['module_url']  = null;
        $this->view_data['module_description']  = '';
        $this->view_data['assets_path']      = dirname(__FILE__, 3) . '/assets/'; // Ścieżka do assets
        $this->view_data['env'] = $this->env;
        $this->view_data['error'] = null;
        $this->view_data['page_slug'] = null;

        /*
        // Załadowanie zmiennych konfiguracyjnych
        $this->load->config('module_config');

        // Załadowanie modelu //
        $this->load->model('MY_Model');
        */

//        $this->load->model('MY_Model');
    }

    /**
     * Zapisuje zdarzenie w tabeli z logami
     */
    public function addLog(
        string $logsDbTable = 'logs',
        string $level,
        string $name,
        $description,
        $browserDetails = false,
        $exception = false
    ): bool {

        $this->load->model('MY_Model');
        $this->load->library('Logs', null, 'logs');

        // Tabela z logami
        $dbTableName = $logsDbTable ? $logsDbTable : 'logs';

        // Dostępne typy zdarzen
        $levels = ['debug', 'error', 'info', 'other'];

        // Domyślne
        $data = [
            'browser'         => null,
            'browser_version' => null,
            'os'              => null,
            'ip_address'      => null,
        ];

        $data['level']       = $level && in_array($level, $levels, true) ? $level : 'other';
        $data['name']        = $name;
        $data['description'] = $description;
        $data['module']      = '';
        $data['class']       = $this->logsAttr['class'];

        if ($browserDetails) {
            $browserData = $this->getBrowser();

            $data['browser']         = isset($browserData['browser']) ? $browserData['browser'] : null;
            $data['browser_version'] = isset($browserData['browser_version']) ? $browserData['browser_version'] : null;
            $data['os']              = isset($browserData['os']) ? $browserData['os'] : null;
            $data['ip_address']      = isset($browserData['ip_address']) ? $browserData['ip_address'] : null;

        }

        return $this->logs->addLog($data, $dbTableName, $exception);

    }

    private function getBrowser()
    {
        $this->load->library('user_agent');
        $data['browser']         = $this->agent->browser();
        $data['browser_version'] = $this->agent->version();
        $data['os']              = $this->agent->platform();
        $data['ip_address']      = $this->input->ip_address();

        return $data;

    }


}
