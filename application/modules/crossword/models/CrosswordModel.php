<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CrosswordModel extends MY_Model
{
    public function __construct ()
    {
        parent::__construct();
    }

	public function getCategories(int $page=1, int $limit=2, bool $only_active=true)
	{
        $this->db->select('id, status, name');
        if($only_active) {
            $this->db->where('status', 1);
        }
        $query = $this->db->get('crossword_categories');

        return $query->result_array();

	}

	public function getWords(int $page=1, int $limit=2, $category_id=null, bool $random=true, bool $only_active=true, string $order_by='id')
    {
        $limit = isset($limit)? (int) $limit : 2;
        $page = isset($page)? (int) $page : 1;

        $this->db->limit($limit, $page);

        if($category_id) {
            $this->db->where('category_id', (int)$category_id);
        }
        if($only_active) {
            $this->db->where('status', 1);
        }
        if($random) {
            $this->db->order_by('id', 'RANDOM');
        }
        $query = $this->db->get('crossword_words');

        return $query->result_array();
    }



}
