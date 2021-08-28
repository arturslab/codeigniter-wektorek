<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Post_category extends MY_Model
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

        $this->table_name = 'post_category';

//        $this->CategoryID = 0;
//        $this->ParentCategoryID = 0;
//        $this->Category = '';
//        $this->Active = true;
    }

    // Return all categories related to post ID
    public function get_post_categories(int $post_id)
    {
        return $this->get($post_id);
    }

}