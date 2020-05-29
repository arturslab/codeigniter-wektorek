<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Crossword
 * @property Crossword $crossword Crossword module
 */
class Crossword extends MY_Controller
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

	    // Default view data
	    $this->viewData['meta_title'] = '';
	    $this->viewData['meta_description'] = '';
	    $this->viewData['meta_keywords'] = '';
	    $this->viewData['title'] = '';
	}
	

    /**
     *  Widok logowania
     */
    public function index ()
    {

		// Zalogowano
        if (isset($this->session->get_userdata()['username'])) {
            redirect("http://{$_SERVER['HTTP_HOST']}/panel/users");
		}

        //set_flash('message', 'danger', 'lorem ipsum...');


		// Odnotuj zdarzenie
		$this->addLog('logs', 'info', 'Crossword', 'Test Crossword', true);

		$this->viewData['css_name'] = $this->config->item('module_name') . '.css';
		$this->viewData['js_name'] = $this->config->item('module_name') . '.js';
		$this->viewData['error'] = $this->session->get_userdata()['error'] ?? '';
		$this->viewData['title'] = 'Crossword';
		$this->viewData['form_action'] = '/admin_panel/login/verify';
		
		$this->load->view('page_head.phtml', $this->viewData);
		$this->load->view('crossword.phtml', $this->viewData);
		$this->load->view('page_footer.phtml');
		$this->session->set_userdata('error', '');


		
		

/*
		if ($this->form_validation->run() == FALSE)
		{
			if ($this->input->get('logout')) {
				$this->logout();
			}

			
		}
		else {
			$this->login();
		}
		*/

        
	}

	function verify()
	{

	}

	function register() {
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

			$id = $this->LoginModel->register($data);
			if($id > 0) {
				die('zarejestrowano');
			}
		}
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

    /**
     *  Logout from admin page
     */
    private function logout () : void
    {
        $this->session->sess_destroy();
        redirect("{$this->defaultPageUrl}/login");
	}
	
}
