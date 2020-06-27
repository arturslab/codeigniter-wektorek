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

        //print_r($posts); die();
        /*
        $categories_names = [];
        foreach($categories as $v) {
            $categories_names[$v['id']] = $v['name'];
        }
        */
        $this->view_data['module_description'] = '';
        $this->view_data['posts']              = $posts;
        $this->view_data['categories_names']   = $categories_names;
//        print_r($allowed_categories);
//        $this->view_data['categories'] = $categories;
//        $this->view_data['categories_names'] = $categories_names;

//        $this->load->view($this->_container, $this->view_data);


        $this->view_data['css_name'] = $this->config->item('module_name') . '.css';
        $this->view_data['js_name']  = $this->config->item('module_name') . '.js';
        $this->view_data['error']    = $this->session->get_userdata()['error'] ?? '';

        $this->view_data['page']      = $this->config->item('ci_my_admin_template_dir_public') . "jokes";
        $this->view_data['module']    = $this->config->item('module_name');
        $this->view_data['title']     = 'Humor';
        $this->view_data['page_slug'] = 'humor-list';

        $this->load->view($this->_container, $this->view_data);

    }


    /**
     * Zwraca adres URL do losowego pliku PNG
     * Uwaga - musi być zapisany przynajmniej 1 plik PNG z zwatarem
     */
    public function get_random()
    {

        $this->avatarpng->init();
        $url = $this->avatarpng->getRandomPng();
        if ($url) {
            echo $url;
        } else {
            // TODO: Pokaż zaślepkę
            echo 'default_avatar.png';
        }

    }


}
