<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Files extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->table = 'files';

        // Set orderable column fields
        $this->column_order = [null, 'name','title','ext','size','created_at','is_active'];
        // Set searchable column fields
        $this->column_search = ['name','title','ext','name_hash','created','is_active'];
        // Set default order
        $this->order = ['name' => 'asc'];
    }
}