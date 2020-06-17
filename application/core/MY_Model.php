<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table_name = '';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('inflector');
        if ( ! $this->table_name) {
            $this->table_name = strtolower(plural(get_class($this)));
        }
    }

    public function get($id)
    {
        return $this->db->get_where($this->table_name, [$this->primary_key => $id])->row();
    }

    public function get_all($fields = '', $where = [], $table = '', $limit = '', $order_by = '', $group_by = '', $only_active = true)
    {
        $data = [];
        if ($fields != '') {
            $this->db->select($fields);
        }
        if (count($where)) {
            $this->db->where($where);
        }
        if ($only_active) {
            $this->db->where(['is_active' => 1]);
        }
        if ($table != '') {
            $this->table_name = $table;
        }
        if ($limit != '') {
            $this->db->limit($limit);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by);
        }
        if ($group_by != '') {
            $this->db->group_by($group_by);
        }
        $Q = $this->db->get($this->table_name);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        return $data;
    }

    public function insert($data)
    {
        $data['created_at']    = $data['updated_at'] = date('Y-m-d H:i:s');
        $data['created_from_ip'] = $data['updated_from_ip'] = $this->input->ip_address();
        $success                 = $this->db->insert($this->table_name, $data);
        if ($success) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $data['updated_at']    = date('Y-m-d H:i:s');
        $data['updated_from_ip'] = $this->input->ip_address();
        $this->db->where($this->primary_key, $id);

        return $this->db->update($this->table_name, $data);
    }

    public function delete($id, $hard=false)
    {
        $this->db->where($this->primary_key, $id);

        if($hard === true) {
            $res = $this->db->delete($this->table_name);
        }
        else {
            $data['is_active']  = 0;
            $res = $this->db->update($this->table_name, $data);
        }

        return $res;
    }
}