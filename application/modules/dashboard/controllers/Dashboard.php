<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Dashboard
 * @property Dashboard $dashboard Dashboard module
 */
class Dashboard extends MY_Controller
{

	/** Atrybuty zapisu do logow @var array $logsAttr */
	// private $logsAttr;

    public function __construct ()
    {
        parent::__construct();

        // Load default module model
		$this->load->model(__CLASS__ . 'Model');

		$this->logsAttr = [
			'module' => $this->config->item('module_name'),
			'class' => __CLASS__
		];

		// Domyslna strona do przekierowan
		$this->defaultPageUrl =  'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name');

	}
	

    /**
     *  Widok logowania
     */
    public function index ()
    {

		// Odnotuj zdarzenie
		$this->addLog('logs', 'info', 'Dashboard', 'Test Dashboard', true);

        // Default view data
        $this->view_data['meta_title']       = 'Wektorek.pl';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_keywords']    = '';
        $this->view_data['title'] = 'Dashboard';
        $this->view_data['module_css']  = $this->config->item('module_name') . '.css';
        $this->view_data['module_js']   = $this->config->item('module_name') . '.js';
        $this->view_data['module_name'] = $this->config->item('module_name');
        $this->view_data['module_path'] = '/application/modules/' . $this->config->item('module_name');
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name') . '/';
        $this->view_data['page']   = $this->config->item('ci_my_admin_template_dir_public') . "dashboard";
        $this->view_data['module'] = $this->config->item('module_name');
        $this->view_data['page_slug'] = 'dashboard';

        $this->load->view($this->_container, $this->view_data);

	}



	function validation() {
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		// Walidacja formularza
		$this->form_validation->set_rules('login', 'Nazwa użytkownika', 'required|trim|is_unique[admins.login]');
		$this->form_validation->set_rules('password', 'Hasło użytkownika', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}
		else {

			$verification_key = md5(rand());
			$encrypted_password = $this->encrypt->encode($this->input->post('password'));

			$data = [
				'login' => $this->input->post('login'),
				'password' => $encrypted_password,
				'verification_key' => $verification_key,
			];
		}

	}

    /**
     *  Autoryzuje uzytkownika na podstawie danych logowania
     */
    private function login () : void
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        [ 'id' => $userId, 'login' => $login, 'role' => $role ] = $this->LoginModel->login($username, $password);
        if (!$login && !$role) {
            $this->session->set_userdata('error', 'Błędny login lub hasło');
        }
        else {
            $this->session->set_userdata('error', '');
            $this->session->set_userdata('id', $userId);
            $this->session->set_userdata('username', $login);
            $this->session->set_userdata('role', $role);
            
            //$this->LoginModel->insertLog($userId);
            
			redirect("{$this->defaultPageUrl}/dashboard");
        }
    }


}
