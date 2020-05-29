<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 * @property Login $login user module
 */
class Login extends MY_Controller
{

	public function __construct ()
	{
		parent::__construct();

//		$this->load->config('module_config');
		$this->load->library('form_validation');
		$this->load->model('LoginModel');

		$this->logsAttr = [
			'module' => '',
			'class' => __CLASS__
		];

		// Default view data
		$this->viewData['css_name'] = 'login.css';
		$this->viewData['js_name'] = 'login.js';
		$this->viewData['meta_title'] = 'Logowanie';
		$this->viewData['meta_description'] = '';
		$this->viewData['meta_keywords'] = '';
		$this->viewData['title'] = 'Logowanie';

		// Check user role (if logged in)
		if($this->session->has_userdata('id_session')) {
			$idSession = $this->session->userdata('id_session');
			$userData = $this->LoginModel->getLoggedUserDetails($idSession);
			if(isset($userData['role']) && isset($userData['id'])) {
				$this->viewData['role'] = (int) $userData['role'];
			}
		}
	}

	public function index()
	{
		//print_r($this->session->userdata());

		if($this->session->has_userdata('id_session')) {
			$idSession = $this->session->userdata('id_session');
			$userData = $this->LoginModel->getLoggedUserDetails($idSession);
			if(isset($userData['role']) && isset($userData['id'])) {

				redirect(base_url() . 'dashboard');
			}
		}
		else {
			//echo 'nie jestes zalogowany ';
		}

		// Add event into database
		$this->addLog('logs', 'info', 'Logowanie', 'Test logowania', true);

		$this->viewData['error'] = $this->session->get_userdata()['error'] ?? '';

		$this->load->view('page_head.phtml', $this->viewData);
		$this->load->view('page_nav.phtml', $this->viewData);
		$this->load->view('content/login.phtml', $this->viewData);
		$this->load->view('page_footer.phtml', $this->viewData);
		$this->session->set_userdata('error', '');

	}

	public function validation()
	{

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

		// Form validation
		$this->form_validation->set_rules('login', 'Login', 'required|trim');
		$this->form_validation->set_rules('password', 'Hasło', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}
		else {
			$login = $this->input->post('login', TRUE);
			$salt = $this->config->item('auth_salt');
			$password = $this->input->post('password', TRUE) . $salt;

			$userData = $this->LoginModel->canLogin($login, $password);

			if($userData && isset($userData['id'])) {

				$sessionData = [
					'id' => $userData['id'],
					'login' => $userData['login'],
					'email' => $userData['email'],
					'first_name' => $userData['first_name'],
					'last_name' => $userData['last_name'],
					'role' => $userData['role'],
					'created_at' => $userData['created_at'],
				];
				$this->session->set_userdata($sessionData);

				// Create session ID and update id_session in users table
				$this->regenerateSessionId($userData['id']);

				$this->addLog('logs', 'info', 'Logowanie', "Zalogowano użytkownika {$userData['id']}", true);
				set_flash('message', 'info', "Witaj {$userData['first_name']}, zostałeś poprawnie zalogowany.");
				redirect(base_url() . 'login');
			}
			else {
				set_flash('message', 'warning', "Błędny login lub hasło.");
				redirect(base_url() . 'login');
			}

		}
	}

	private function regenerateSessionId(int $id) {
		$session_salt = $this->config->item('session_salt');
		$sessionId = $id . $session_salt . rand();

		$hashedSessionId = password_hash($sessionId, PASSWORD_DEFAULT);

		$data = [
			'id_session' => $hashedSessionId
		];

		if($this->LoginModel->updateItem($data, $id)) {
			$this->session->set_userdata(['id_session' => $hashedSessionId]);

			return true;
		}
		else {
			return false;
		}

	}


	public function logout()
	{
		$this->session->unset_userdata(['id', 'id_session', 'login', 'email', 'first_name', 'last_name', 'role', 'created_at']);

		redirect(base_url() . 'login');
	}

	// Check if user is logged in
	public function isLoggedIn()
	{

	}

	// Check account type of logged in user
	public function checkRoleId($id)
	{

	}


}
