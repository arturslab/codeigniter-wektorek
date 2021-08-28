<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class User extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users_with_groups()
    {

        $sql = "users.id AS user_id, username, email, first_name, last_name, From_UnixTime(last_login, '%Y %d-%b  %r') last_login, active, Group_Concat(groups.name ORDER BY groups.name SEPARATOR ',') as belongs_to";

        $query = $this->db->select($sql)
                          ->from('users')
                          ->join('users_groups', 'users_groups.user_id = users.id', 'inner')
                          ->join('groups', 'users_groups.group_id = groups.id', 'inner')->group_by('users_groups.user_id')
                          ->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
//        $query->free_result();
//        print_r($this->db->last_query());
        return $data;
    }
}