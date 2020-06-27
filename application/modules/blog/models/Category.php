<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Category extends MY_Model
{

//    public $CategoryID;         //:int
    //public $ParentCategoryID;     //:int
//    public $Category;             //:str
//    public $Active;             //:bool

    public $select_array;         //:array


    public function __construct()
    {
        parent::__construct();
//        $this->output->enable_profiler(true);

//        $this->CategoryID = 0;
//        $this->ParentCategoryID = 0;
//        $this->Category = '';
//        $this->Active = true;
    }
/*
    public function get_categories()
    {

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parent_id', 0);

        $parent = $this->db->get();

        $categories = $parent->result();
        $i          = 0;
        foreach ($categories as $p_cat) {

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }

        return $categories;
    }

    public function sub_categories($id)
    {

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parent_id', $id);

        $child      = $this->db->get();
        $categories = $child->result();
        $i          = 0;
        foreach ($categories as $p_cat) {

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }

        return $categories;
    }

    public function get_category_tree($level = 0, $prefix = '') {
        $rows = $this->db
            ->select('id,parent_id,name')
            ->where('parent_id', $level)
            ->order_by('id','asc')
            ->get('categories')
            ->result();

        $category = '';
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $category .= $prefix . $row->name . "\n";
                // Append subcategories
                $category .= $this->get_category_tree($row->id, $prefix . '-');
            }
        }
        return $category;
    }
*/
    /**
     * This function gets all the active parent and child categories and returns an array ready for a select menu.
     * @return array
     */
    public function get_all_categories_selector($parent_id = 0, $first_option = 'Wybierz...') {

        $sql = "SELECT "
               ."* "
               ."FROM ".$this->db->dbprefix."categories "
               ."WHERE "
               //."is_active = ? "
               ."  parent_id = " . ( (int) $parent_id) . " "
               ."ORDER BY name";

        $params = [
            true,
            0
        ];

        $query = $this->db->query($sql, $params);

        if ( $first_option != '' ) {

            $this->select_array[ '' ] = $first_option;

        }

        // Top level
        $this->select_array[0] = '- Brak -';

        foreach ($query->result_array() as $row) {

            $this->select_array[ $row['id'] ] = $row['name'];

            $this->get_all_child_categories_selector($row['id']);

        }

        return $this->select_array;
    }

    /**
     * This function gets all the active child categories and adds to the array.
     * @return void
     */
    public function get_all_child_categories_selector($parent_id) {

        $sql = "SELECT "
               ."* "
               ."FROM ".$this->db->dbprefix."categories "
               ."WHERE "
               ."is_active = ? "
               ." AND parent_id = ? "
               ."ORDER BY name";

        $params = array(
            true,
            $parent_id
        );

        $query = $this->db->query($sql, $params);

        foreach ($query->result_array() as $row) {

            $this->select_array[ $row['id'] ] = '&nbsp;&nbsp;&nbsp;'.$row['name'];

        }


    }

    // Zwraca wielowymiarowa tablice z podkategoriami rodzica
    public function get_sub_categories(int $id, $only_active = false, &$categories=[])
    {

        $this->db->select('id');
        $this->db->from('categories');
        if ($only_active) {
            $this->db->where(['is_active' => 1]);
        }
        $this->db->where('parent_id', $id);

        $child      = $this->db->get();
        $res = $child->result();

        $cat[] = $id;
        foreach ($res as $p_cat) {
            $categories[] = $p_cat->id;
            $_cat = $this->get_sub_categories($p_cat->id, $only_active, $categories);
        }

        return $categories;
    }



}