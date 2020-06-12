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

        // Load default module model
        $this->load->model(__CLASS__ . 'Model');


        $this->logsAttr = [
            'module' => $this->config->item('module_name'),
            'class'  => __CLASS__,
        ];

        // Dane z pliku SVG - zakresy identyfikatorów warstw poszczególnych elementów
        $avatars_data = [
            'background' => ['min' => 1, 'max' => 1],
            'head'       => ['min' => 1, 'max' => 1],
            'mouth'      => ['min' => 1, 'max' => 1],
            'hair'       => ['min' => 1, 'max' => 14],
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

        $this->colors_palette = $this->config->item('custom_colors');

//        $this->load->helper('url');
        $this->load->library('avatarcore', $this->avatar_config);
        $this->load->library('avatarpng', $this->avatar_config);

        // Domyslna strona do przekierowan
        $this->defaultPageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name') . '/';

        // Default view data
        $this->viewData['meta_title']       = 'Stwórz własnego awatara';
        $this->viewData['meta_description'] = '';
        $this->viewData['meta_keywords']    = '';
	    $this->viewData['title'] = 'Wyczaruj swojego awatarka';
	    $this->viewData['custom_colors'] = $this->colors_palette;
        $this->viewData['module_css']  = $this->config->item('module_name') . '.css';
        $this->viewData['module_js']   = $this->config->item('module_name') . '.js';
        $this->viewData['module_name'] = $this->config->item('module_name');
        $this->viewData['module_path'] = '/application/modules/' . $this->config->item('module_name');
        $this->viewData['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->config->item('module_name')
                                         . '/';
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

        $this->viewData['svg_image_data'] = $this->avatarcore->showSvg();

        // Odnotuj zdarzenie
        //$this->addLog('logs', 'info', 'Crossword', 'Test Avatar', true);

        $this->viewData['css_name'] = $this->config->item('module_name') . '.css';
        $this->viewData['js_name']  = $this->config->item('module_name') . '.js';
        $this->viewData['error']    = $this->session->get_userdata()['error'] ?? '';
        //$this->viewData['title'] = 'Avatar';
        //$this->viewData['form_action'] = '/admin_panel/login/verify';

        $this->load->view('page_head.phtml', $this->viewData);
        $this->load->view('avatar.phtml', $this->viewData);
        $this->load->view('page_footer.phtml', $this->viewData);
        //$this->session->set_userdata('error', '');


    }

    /**
     * Zwraca wartość koloru z konfiguracji kolorów.
     * Opcjonalnie zwraca losowy kolor z tablicy lub pierwszą wartość tablicy kolorów, jeśli podano błędny index
     *
     * @param      $color_id - ID koloru z pliku konfiguracyjnego
     * @param bool $allow_random - Zezwalaj na losowy element, w przypadku błędnego indeksu koloru
     *
     * @return mixed
     */
    private function getColorValue($color_id, $allow_random=false) {
        if(isset($this->colors_palette[$color_id])) {
            $color = $this->colors_palette[$color_id];
        }
        elseif($allow_random) {
            $rand_key = array_rand($this->colors_palette);
            $color = $this->colors_palette[$rand_key];
        }
        else {
            $colors = $this->colors_palette;
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
    public function draw(string $ext = 'png')
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
        $this->form_validation->set_rules('eyeglasses_color', 'eyeglasses_color', 'callback_item_check');
        $this->form_validation->set_rules('hair_color', 'hair_color', 'callback_item_check');
        $this->form_validation->set_rules('blouse_color', 'blouse_color', 'callback_item_check');
        $this->form_validation->set_message('item_check', 'Nieprawidłowa wartość dla pola {field}');








        if ($this->form_validation->run($this) == false) {
            //$this->load->view('myform');
            echo validation_errors();
        } else {

            $hair_color = $this->getColorValue($this->input->post('hair_color'), true);
            $eyeglasses_color = $this->getColorValue($this->input->post('eyeglasses_color'), true);
            $blouse_color = $this->getColorValue($this->input->post('blouse_color'), true);





            //echo 'fsdfs';
            //$data['eyeglasses']             = $this->input->post('eyeglasses');
            $data['eyeglasses_color']             = $eyeglasses_color;
            $data['hair']             = $this->input->post('hair');
            $data['hair_color']      = $hair_color;
            $data['blouse']           = $this->input->post('blouse');
            $data['blouse_color']      = $blouse_color;
            $data['eye']              = $this->input->post('eye');
            $data['eye_color']      = '#111';
            $data['mouth']            = 1;
            $data['mouth_color']      = '#111';
            $data['nose']             = 1;
            $data['nose_color']      = '#111';
            $data['head']             = 1;
            $data['head_color']       = '#111';
            $data['background']       = 1;
            $data['background_color'] = '#212121';// gdy bledna wartosc - random color...

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
            $cached_file_path = $cache_folder . $avatar_filename;

            //$this->avatarcore->dd();
            if (file_exists($cached_file_path)) {
                echo $cached_file_path;
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
                    if ($res = $this->avatarpng->displayImage(true)) {
                        echo $res;
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
    public function getRandom() {
        $this->avatarpng->init();
        $url = $this->avatarpng->getRandomPng();
        if($url) {
            echo $url;
        }
        else {
            // TODO: Pokaż zaślepkę
        }

    }


}
