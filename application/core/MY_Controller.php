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
    public $viewData;

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


        $this->viewData['meta_title']       = 'Wektorek.pl';
        $this->viewData['meta_description'] = '';
        $this->viewData['meta_keywords']    = '';
        $this->viewData['title']            = 'Wektorek.pl';
        $this->viewData['module_name']      = ''; // Nazwa modulu z pliku konfiguracyjnego
        $this->viewData['module_css']       = ''; // Załączony CSS: nazwa_modulu.css
        $this->viewData['module_js']        = ''; // Załączony JS: nazwa_modulu.js
        $this->viewData['module_path']      = ''; // Ścieżka do modułu
        $this->viewData['assets_path']      = dirname(__FILE__, 3) . '/assets/'; // Ścieżka do assets

        // Load helpers //
        $this->load->helper('Functions');
        $this->load->helper('url');
        $this->load->config('ci_my_admin');

        // Dev - tryb developerski (wyswietla dodatkowe info w szablonach). Prod - tryb produkcyjny
        $this->env = 'dev';

        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_public') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        log_message('debug', 'CI My Admin : MY_Controller class loaded');
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
