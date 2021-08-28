<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Post extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
//        $this->output->enable_profiler(true);

    }

    public function posts_from_categories (array $categories, $only_accepted = false, $only_active = false) {

        //$data = [];
//        die('join post-categories');
        //https://gist.github.com/dimak57/3979511
//        https://stackoverflow.com/questions/39955166/codeigniter-where-in-or-where-in/39955784
        $this->db->select('p.id, p.title, p.slug, p.picture, p.picture_id, p.content, p.short_content, p.created_at, p.is_active, c.id AS category_id, c.name AS category_name');
        $this->db->from('posts p');
        $this->db->join('post_category pc', 'p.id = pc.post_id', 'inner');
        $this->db->join('categories c', 'pc.category_id = c.id', 'inner');
        if ($only_accepted) {
            $this->db->where(['p.is_pending' => 0]);
        }
        if ($only_active) {

            $this->db->where(['p.is_active' => 1]);
            $this->db->where(['c.is_active' => 1]);
        }

        if(!empty($categories)) {
            $this->db->where_in('pc.category_id', $categories);
        }


        $query = $this->db->get(); // GET RESULT
        $res = $query->result_array();
        //echo $this->db->last_query();
//print_r($res);
        return $res;
    }

    /**
     * return only active posts
     *
     * @param array $categories
     * @param bool  $only_active
     *
     * @return mixed
     */
    public function posts_from_categories_active (array $categories, $only_accepted = true)
    {
        return $this->posts_from_categories($categories,$only_accepted, true);
    }

    public function create($data)
    {
        $category_id = (int) $data['category_id'];

        $post_data = [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'user_id' => 123,
        ];
        $post_data['created_at'] = $post_data['updated_at'] = date('Y-m-d H:i:s');
        $post_data['created_from_ip'] = $post_data['updated_from_ip'] = $this->input->ip_address();

        $post_id = $this->insert($post_data);

        if($post_id) {
            $pc_data = [
                'category_id' => $category_id,
                'post_id' => (int) $post_id,
            ];
            $pc_data['created_at'] = $pc_data['updated_at'] = date('Y-m-d H:i:s');
            $pc_data['created_from_ip'] = $pc_data['updated_from_ip'] = $this->input->ip_address();

            $pc_id = $this->db->insert('post_category', $pc_data);
            if($pc_id) {
                return $post_id;
            }
            else {
                // error inserting post category relation
                return false;
            }
        }
        else {
            // error inserting post data....
            return false;
        }
    }

    public function update_post ($data, $old_categories, int $id)
    {

        // Prepare data to update
        $post_id = $id;
        $pc_id = (int) $old_categories->id;

        $post_data = [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'user_id' => 123,
        ];

        $p_res = $this->update($post_data, $post_id);

        $categories_data = [
            'category_id' => (int) $data['category_id'],
        ];
        $categories_data['updated_at']    = date('Y-m-d H:i:s');
        $categories_data['updated_from_ip'] = $this->input->ip_address();

        if($p_res) {
            // update relations
            $this->load->model(['blog/post_category']);
            $pc_res = $this->post_category->update($categories_data, $pc_id);

            return $pc_res;
        }
    }

}