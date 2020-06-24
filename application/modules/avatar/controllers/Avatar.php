<?php if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Avatar
 *
 * @property Avatar $avatar Avatar module
 */
class Avatar extends MY_Controller
{

    /** Atrybuty zapisu do logow @var array $logsAttr */
    // private $logsAttr;

    private $colors_palette;

    private $avatar_config;

    public function __construct()
    {
        parent::__construct();

        $this->logsAttr = [
            'module' => $this->config->item('module_name'),
            'class'  => __CLASS__,
        ];

        // Dane z pliku SVG - zakresy identyfikatorów warstw poszczególnych elementów
        $avatars_data = [
            'background' => ['min' => 1, 'max' => 1],
            'head'       => ['min' => 1, 'max' => 1],
            'mouth'      => ['min' => 1, 'max' => 1],
            'hair'       => ['min' => 1, 'max' => 20],
            'eye'        => ['min' => 1, 'max' => 6],
            'nose'       => ['min' => 1, 'max' => 1],
            'beard'      => ['min' => 1, 'max' => 4],
            'blouse'     => ['min' => 1, 'max' => 8],
            'eyeglasses'     => ['min' => 1, 'max' => 4],
        ];

        $this->avatar_config = [
            'cache_dir'    => '/images/avatars/',
            'svg_path'     => dirname(__FILE__, 2) . '/assets/images/svg/',
            'svg_filename' => 'faces_all_in_one_optimized.svg',
            'avatars_data' => $avatars_data,
        ];


// Paleta predefiniowanych kolorów
        $config['custom_colors'] = [
            1 => '#f8c09d',
            2 => '#ef937e',
            3 => '#ea676c',
            4 => '#fff79c',
            5 => '#fed883',
            6 => '#fdbe3f',
            7 => '#ec7523',
            8 => '#e3482c',
            9 => '#dc1c4b',
            10 => '#b31e48',
            11 => '#ee8eb4',
            12 => '#dd527c',
            13 => '#dc166d',
            14 => '#9b1d5a',
            15 => '#6f1e49',
            16 => '#dd94c1',
            17 => '#b557a1',
            18 => '#612d82',
            19 => '#432355',
            20 => '#5e79bc',
            21 => '#87d1ee',
            22 => '#2bb3cd',
            23 => '#2276bc',
            24 => '#1d5c87',
            25 => '#7ecdca',
            26 => '#30b1ad',
            27 => '#1f8b95',
            28 => '#50b86b',
            29 => '#c9db53',
            30 => '#8fc23f',
            31 => '#d0ad9a',
            32 => '#9a605c',
            33 => '#66342d',
            34 => '#311a12',
            35 => '#d0e2ee',
            36 => '#aabfd0',
            37 => '#7d8e9e',
            38 => '#5b6571',
            39 => '#3a4d5c',
            40 => '#143441',
            41 => '#0f2437',
            42 => '#000000',
            43 => '#333333',
            44 => '#808080',
            45 => '#cccccc',
            46 => '#ececec',
            47 => '#f5f6e8',
            48 => '#ffffff',
        ];

        $config['eye_colors'] = [
            1 => '#808080',
            2 => '#1a1a1a',
            3 => '#3366cc',
            4 => '#99cc33',
            5 => '#cc0000',
            6 => '#804d00',
        ];

        $config['hair_colors'] = [
            1 => '#fbfbfb',
            2 => '#bfbfbf',
            3 => '#808080',
            4 => '#404040',
            5 => '#1a1a1a',
            6 => '#19aeff',
            7 => '#6699ff',
            8 => '#3366cc',
            9 => '#003399',
            10 => '#d76cff',
            11 => '#ba00ff',
            12 => '#99cc33',
            13 => '#00cc00',
            14 => '#669900',
            15 => '#804d00',
            16 => '#ffff3e',
            17 => '#ffcc00',
            18 => '#ff9900',
            19 => '#ff6600',
            20 => '#cc0000',
            21 => '#ff4141',
            22 => '#ff5599',
        ];

        $config['eyeglasses_colors'] = [
            1 => '#fbfbfb',
            2 => '#bfbfbf',
            3 => '#808080',
            4 => '#404040',
            5 => '#1a1a1a',
            6 => '#19aeff',
            7 => '#6699ff',
            8 => '#3366cc',
            9 => '#003399',
            10 => '#d76cff',
            11 => '#ba00ff',
            12 => '#99cc33',
            13 => '#00cc00',
            14 => '#669900',
            15 => '#804d00',
            16 => '#ffff3e',
            17 => '#ffcc00',
            18 => '#ff9900',
            19 => '#ff6600',
            20 => '#cc0000',
            21 => '#ff4141',
            22 => '#ff5599',
        ];

        $config['blouse_colors'] = [
            1 => '#fbfbfb',
            2 => '#bfbfbf',
            3 => '#808080',
            4 => '#404040',
            5 => '#1a1a1a',
            6 => '#19aeff',
            7 => '#6699ff',
            8 => '#3366cc',
            9 => '#003399',
            10 => '#d76cff',
            11 => '#ba00ff',
            12 => '#99cc33',
            13 => '#00cc00',
            14 => '#669900',
            15 => '#804d00',
            16 => '#ffff3e',
            17 => '#ffcc00',
            18 => '#ff9900',
            19 => '#ff6600',
            20 => '#cc0000',
            21 => '#ff4141',
            22 => '#ff5599',
        ];

        $this->colors_palette['custom'] = $config['custom_colors'];
        $this->colors_palette['hair'] = $config['hair_colors'];
        $this->colors_palette['eye'] = $config['eye_colors'];
        $this->colors_palette['eyeglasses'] = $config['eyeglasses_colors'];
        $this->colors_palette['blouse'] = $config['blouse_colors'];

//        $this->load->helper('url');
        $this->load->library('avatarcore', $this->avatar_config);
        $this->load->library('avatarpng', $this->avatar_config);

        // Domyslna strona do przekierowan
        $this->defaultPageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name') . '/';

        // Default view data
        $this->view_data['meta_title']       = 'Stwórz własnego awatara';
        $this->view_data['meta_description'] = '';
        $this->view_data['meta_keywords']    = '';
	    $this->view_data['title'] = 'Wyczaruj swojego awatarka';
	    $this->view_data['custom_colors'] = $this->colors_palette;
        $this->view_data['module_css']  = $this->config->item('module_name') . '.css';
        $this->view_data['module_js']   = 'avatar.js';
        $this->view_data['module_name'] = $this->config->item('module_name');
        $this->view_data['module_path'] = '/application/modules/' . $this->config->item('module_name');
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/avatar/';
    }


    /**
     *  Widok logowania
     */
    public function index()
    {
        // Zalogowano
        //if (isset($this->session->get_userdata()['username'])) {
            //redirect("http://{$_SERVER['HTTP_HOST']}/panel/users");
        //}

        //set_flash('message', 'danger', 'lorem ipsum...');

        $this->view_data['svg_image_data'] = $this->avatarcore->showSvg();

        // Odnotuj zdarzenie
        //$this->addLog('logs', 'info', 'Crossword', 'Test Avatar', true);

        $this->view_data['css_name'] = $this->config->item('module_name') . '.css';
        $this->view_data['js_name']  = $this->config->item('module_name') . '.js';
        $this->view_data['error']    = $this->session->get_userdata()['error'] ?? '';
        //$this->view_data['title'] = 'Avatar';
        //$this->view_data['form_action'] = '/admin_panel/login/verify';

        $this->load->view('page_head.phtml', $this->view_data);
        $this->load->view('avatar.phtml', $this->view_data);
        $this->load->view('page_footer.phtml', $this->view_data);
        //$this->session->set_userdata('error', '');


    }

    /**
     * Zwraca wartość koloru z konfiguracji kolorów.
     * Opcjonalnie zwraca losowy kolor z tablicy lub pierwszą wartość tablicy kolorów, jeśli podano błędny index
     *
     * @param      $color_id - ID koloru z pliku konfiguracyjnego
     * @param      $palette - Paleta koloró z pliku konfiguracyjnego (custom, eye, eyeglass)
     * @param bool $allow_random - Zezwalaj na losowy element, w przypadku błędnego indeksu koloru
     *
     * @return mixed
     */
    private function getColorValue($color_id, $allow_random=false, $palette='custom') {

        if(!in_array($palette, ['custom', 'eye', 'eyeglasses', 'hair', 'blouse'])) {
            $palette = 'custom';
        }

        if(isset($this->colors_palette[$palette][$color_id])) {
            $color = $this->colors_palette[$palette][$color_id];
        }
        elseif($allow_random) {
            $rand_key = array_rand($this->colors_palette[$palette]);
            $color = $this->colors_palette[$palette][$rand_key];
        }
        else {
            $colors = $this->colors_palette[$palette];
            $color = reset($colors);
        }

        return $color;
    }

    // Pobierz losowy ID elementu z tablicy konfiguracyjnej
    private function getRandomElement($elementName) {
        if(isset($elementName) && array_key_exists($elementName, $this->avatar_config['avatars_data'])) {
            $min = (int) $this->avatar_config['avatars_data'][$elementName]['min'];
            $max = (int) $this->avatar_config['avatars_data'][$elementName]['max'];

            $rand_id = rand($min, $max);

            return $rand_id;
        }
        else {
            return false;
        }
    }

    /**
     * Główna metoda generują plik PNG z awatarem
     *
     * @param string $ext
     */
    public function draw_avatar(string $ext = 'png')
    {

        // Ustal dozwolony rodzaj wygenerowanego pliku z awatarem
        if(!in_array($ext, ['png', 'svg'])) {
            $ext = 'png';
        }
        //https://stackoverflow.com/questions/37185883/do-form-validation-with-jquery-ajax-in-codeigniter
//        print_r($_REQUEST);
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');

//        $this->load->library(array('my_form_validation'));//load my library here $this->form_validation->run($this);
//        $this->form_validation->run($this);

        //var_dump($this->input->post('hair'));die();
        $this->form_validation->set_error_delimiters('', '');

        /*
        echo "\n <<< REQUEST_METHOD >>> \n";
        print_r($_SERVER['REQUEST_METHOD']);
        echo "\n <<< REQUEST >>> \n";
        print_r($_REQUEST);
        echo "\n <<< POST >>> \n";
        print_r($_POST);
        echo "\n <<< INPUT >>> \n";
        print_r($this->input->post('eyeglasses'));
        die('zzzzzzz');
        */

       // $this->form_validation->set_rules('eyeglasses', 'eyeglasses', 'callback_item_check', ['item_check' => 'Nieprawidłowa wartość dla wyboru okularów.'] );
        $this->form_validation->set_rules('eyeglasses', 'eyeglasses', 'callback_item_check' );
        $this->form_validation->set_rules('hair', 'hair', 'callback_item_check');
        $this->form_validation->set_rules('blouse', 'blouse', 'callback_item_check');
        $this->form_validation->set_rules('eye', 'eye', 'callback_item_check');
        $this->form_validation->set_rules('eye_color', 'eye_color', 'callback_item_check');
        $this->form_validation->set_rules('eyeglasses_color', 'eyeglasses_color', 'callback_item_check');
        $this->form_validation->set_rules('hair_color', 'hair_color', 'callback_item_check');
        $this->form_validation->set_rules('blouse_color', 'blouse_color', 'callback_item_check');
        $this->form_validation->set_message('item_check', 'Nieprawidłowa wartość dla pola {field}');








        if ($this->form_validation->run($this) == false) {
            //$this->load->view('myform');
            echo validation_errors();
        } else {

            $hair_color = $this->getColorValue($this->input->post('hair_color'), true, 'hair');
            $eyeglasses_color = $this->getColorValue($this->input->post('eyeglasses_color'), true, 'eyeglasses');
            $blouse_color = $this->getColorValue($this->input->post('blouse_color'), true, 'blouse');
            $eye_color = $this->getColorValue($this->input->post('eye_color'), true, 'eye');





            //echo 'fsdfs';
            //$data['eyeglasses']             = $this->input->post('eyeglasses');
            $data['eyeglasses_color']             = $eyeglasses_color;
            $data['hair']             = $this->input->post('hair');
            $data['hair_color']      = $hair_color;
            $data['blouse']           = $this->input->post('blouse');
            $data['blouse_color']      = $blouse_color;
            $data['eye']              = $this->input->post('eye');
            $data['eye_color']      = $eye_color;
            $data['mouth']            = 1;
            $data['mouth_color']      = '#111';
            $data['nose']             = 1;
            $data['nose_color']      = '#111';
            $data['head']             = 1;
            $data['head_color']       = '#111';
            $data['background']       = 1;
            $data['background_color'] = '#ffffff';// gdy bledna wartosc - random color...

            foreach($this->avatar_config['avatars_data'] as $name => $v) {
                $input = $this->input->post($name);

                // Czy element ma wybraną opcję "losowy", "nie pokazuj", lub numeryczną
                if($input == 'random'){
                    $data[$name]  = $this->getRandomElement($name);
                }
                else {
                    $data[$name] = $input;
                }
            }

/*
            // Czy wybrano opcję "ukryj element" lub "losowy"
            $input['eyeglasses'] = $this->input->post('eyeglasses');
            if($input['eyeglasses']=='random'){

                $data['eyeglasses']  = $this->getRandomElement('eyeglasses');
            }
            else {
                $data['eyeglasses'] = $input['eyeglasses'];
            }
            */

            $this->avatarcore->setUserPreferences($data);
            //$this->avatarcore->dd();

            // Cache
            $cache_folder     = '/images/avatars/';
            $avatar_hash      = $this->avatarcore->getAvatarHash();
            $avatar_filename  = 'avatar_' . $avatar_hash . '.png';
            $output_image = $cache_folder . $avatar_filename;

            //$this->avatarcore->dd();
            if (file_exists($output_image)) {
                echo $output_image;
            } else {

                $custom_styles   = $this->avatarcore->getCssStyle();
                $svg_data_string = $this->avatarcore->showSvg();

                //$image = new Image();
                $this->avatarpng->init();
                //$this->avatarpng->setCacheDir($cache_folder);
                $this->avatarpng->setFilename($avatar_filename);
                $this->avatarpng->setCustomStyles($custom_styles);
                $this->avatarpng->setSvgData($svg_data_string);
//                 $this->avatarpng->dd();

                if($ext === 'png') {
                    if ($output_image = $this->avatarpng->displayImage(true)) {
                        echo $output_image;
                    }
                }
                elseif($ext === 'svg') {

                }


            }

        }


    }


    /**
     * Walidacja elementów kreatora. Dozwolene indeksy elementów, losowy element lub brak
     *
     * @param $str Id elementu (np. okularów), random (np. losowe okulary), none (brak okularów)
     *
     * @return bool
     */
    public function item_check($str) {

        if(is_numeric($str) || in_array($str, ['none', 'random'])){
            return true;
        }
        else {
           // $this->form_validation->set_message('custom_validation', "Come on, don't act like spammer!");
            return FALSE;
        }
    }

    /**
     * Zwraca adres URL do losowego pliku PNG
     * Uwaga - musi być zapisany przynajmniej 1 plik PNG z zwatarem
     */
    public function get_random() {

        $this->avatarpng->init();
        $url = $this->avatarpng->getRandomPng();
        if($url) {
            echo $url;
        }
        else {
            // TODO: Pokaż zaślepkę
            echo 'default_avatar.png';
        }

    }


}
