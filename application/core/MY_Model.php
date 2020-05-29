<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @category	Model
 * @author		Bartłomiej Zatorski <bartlomiej.zatorski@asdirect.pl>
 * @copyright	2016 ASDIRECT Sp. z o.o.
 * @license		All right reserved ASDIRECT Sp. z o.o.
 */

class MY_Model extends CI_Model
{	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
	    parent::__construct();
	    
	    $this->db = $this->load->database('default', true);
	}

	/**
	 * Return users data
	 *
	 * @param int $status
	 * @return array
	 * @author Artur Słaboszewski
	 */
    function getUsers(int $status = 1)
    {
        $sql = "SELECT * FROM users WHERE status = " . $status;
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }
    	
}
