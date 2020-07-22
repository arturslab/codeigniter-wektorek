<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Joke
 *
 * @property Joke $joke Joke module
 */
class Joke extends MY_Controller
{

    private $top_category = 2;


    public function __construct()
    {
        parent::__construct();

        $this->load->model(['blog/post']);
        $this->load->model(['blog/category']);
        $this->load->model(['blog/post_category']);

        $this->logsAttr = [
            'module' => $this->config->item('module_name'),
            'class'  => __CLASS__,
        ];


        // Domyslna strona do przekierowan
        $this->defaultPageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name') . '/';

        // Default view data
        $this->view_data['meta_title']       = 'Humor i dowcipy dla każdego';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_keywords']    = '';
        $this->view_data['title']            = 'Humor';
        $this->view_data['module_css']       = $this->config->item('module_name') . '.css';
        $this->view_data['module_js']        = $this->config->item('module_name') . '.js';
        $this->view_data['module_name']      = $this->config->item('module_name');
        $this->view_data['module_path']      = '/application/modules/' . $this->config->item('module_name');
        $this->view_data['module_url']       = 'http://' . $_SERVER['HTTP_HOST'] . '/'
                                               . $this->config->item('module_name') . '/';
    }


    public function index()
    {
//        $this->load->helper('url');
        $this->load->library('pagination');



        $categories       = $this->category->get_all();
        $categories_names = [];
        foreach ($categories as $v) {
            $categories_names[$v['id']] = $v['name'];
        }

        $allowed_categories   = $this->category->get_sub_categories($this->top_category, true);
        $allowed_categories[] = $this->top_category;

        $posts = $this->post->posts_from_categories_active($allowed_categories, true);

        foreach ($posts as $id => $v) {
            if ($v['content']) {
                $posts[$id]['content'] = nl2br($v['content']);
            }
        }


        /* Pagination */
        //$config['base_url'] = 'http://example.com/index.php/test/page/';
        $config['base_url'] = site_url('humor/page/');
        $config['total_rows'] = 200;
        $config['per_page'] = 20;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $this->view_data['pagination'] = $this->pagination->create_links();



        $this->view_data['module_description'] = '';
        $this->view_data['posts']              = $posts;
        $this->view_data['categories_names']   = $categories_names;

        $this->view_data['css_name'] = $this->config->item('module_name') . '.css';
        $this->view_data['js_name']  = $this->config->item('module_name') . '.js';
        //$this->view_data['error']    = $this->session->get_userdata()['error'] ?? '';

        $this->view_data['page']      = $this->config->item('ci_my_admin_template_dir_public') . "jokes";
        $this->view_data['module']    = $this->config->item('module_name');
        $this->view_data['title']     = 'Humor';
        $this->view_data['page_slug'] = 'humor-list';

        $this->load->view($this->_container, $this->view_data);

    }

    public function page($category_slug = false, $page = 1)
    {
        $cat_id = $this->top_category;
        if(isset($category_slug) && $category_slug != 'all') {
            $cat_id = $this->category->get_id_by_field($category_slug);
        }

        $this->view_data['categories_names'] = $this->category->get_all_categories_selector($cat_id, true);

        print_r($this->view_data['categories_names']);

        echo $category_slug;

        die($page);
    }


    private function count_posts()
    {

    }




}
