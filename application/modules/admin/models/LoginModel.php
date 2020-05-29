<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends MY_Model
{
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Metoda autoryzujaca uzytkownika w bazie
     * @param string $username
     * @param string $password
     * @return array|null
     */
    public function login (string $username, string $password) : ?array
    {
        $this->db->select('id, login, role');
        $query = $this->db
            ->get_where('users', [
                'login' => $username,
                'password' => md5($password),
                'is_active' => true
            ]);
        
        return $query->row_array();
    }
    
    public function insertLog(int $userId) : ?bool
    {
        $insertData = [
            'user' => $userId
        ];
        
        return $this->db->insert('users_logs', $insertData);
	}
	

	public function register($data)
	{
		$this->db->insert('admins', $data);

		return $this->db->insert_id();
	}
}
