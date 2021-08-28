<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table_name = '';
    protected $primary_key = 'id';

    /* Datatables configuration */
    protected $column_order;
    protected $column_search;
    protected $order;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('inflector');
        if ( ! $this->table_name) {
            $this->table_name = strtolower(plural(get_class($this)));
        }

        // Set orderable column fields
        $this->column_order = [null, 'name','title','ext','size','created_at','is_active'];
        // Set searchable column fields
        $this->column_search = ['name','title','ext','name_hash','created','is_active'];
        // Set default order
        $this->order = ['name' => 'asc'];
    }

    public function get($id)
    {
        return $this->db->get_where($this->table_name, [$this->primary_key => $id])->row();
    }

    public function get_id_by_field(string $val, $field = 'slug')
    {
        // Check if field name is allowed
        if(!in_array($field, ['slug', 'name'])) {
            $field = 'slug';
        }
        return $this->db->get_where($this->table_name, [$field => $val])->row();
    }

    public function get_all($fields = '', $where = [], $table = '', $limit = '', $order_by = '', $group_by = '', $only_active = false)
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

    /**
     * Return only active records (is_active flag = TRUE)
     *
     * @param string $fields
     * @param array  $where
     * @param string $table
     * @param string $limit
     * @param string $order_by
     * @param string $group_by
     *
     * @return array
     */
    public function get_all_active($fields = '', $where = [], $table = '', $limit = '', $order_by = '', $group_by = '')
    {
        return $this->get_all($fields, $where, $table, $limit, $order_by, $group_by,true);
    }


    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){

        $this->db->from($this->table_name);

        $i = 0;
        // loop searchable columns
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
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