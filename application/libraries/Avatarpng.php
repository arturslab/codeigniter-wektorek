<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// http://test3.melma.pl/avatars/avatar_png.php?hair=2&hair_color=ff0000&blouse=2&blouse_color=10aa44&beard=0&background=1&background_color=111&mouth=1&mouth_color=111&eye=1&eye_color=111&head=1&head_color=111
/*
$errors = [];
$avatars = [];
$cache_folder = '';

require_once 'avatars_config.php';
// Avatar maker class
require_once 'avatar2.php';

$avatar = new Avatar($avatars_data);

if(isset($_GET)){

    $data = $_GET;

    $data['mouth'] = 1;
    $data['head'] = 1;
    $data['background'] = 1;
    $data['mouth_color'] = '111';
    $data['head_color'] = '111';
    $data['background_color'] = '111';
    $avatar->setUserPreferences($data);
}

// Cache
$avatar_hash = $avatar->getAvatarHash();
$avatar_filename = 'avatar_' . $avatar_hash . '.png';
$cached_file_path = $cache_folder . $avatar_filename;



if(file_exists($cached_file_path)) {
    echo $cached_file_path;
}
else {

    $custom_styles = $avatar->getCssStyle();
    $svg_data_string = $avatar->showSvg();

    $image = new Image();
    $image->init();
    $image->setCacheDir($cache_folder);
    $image->setFilename($avatar_filename);
    $image->setCustomStyles($custom_styles);
    $image->setSvgData($svg_data_string);

    $image->displayImage(true);

//    $image->dd();

}

*/


class Avatarpng
{

    private $errors;
    private $image;
    private $cache_folder_path;
    private $avatars_data;
    private $avatar_hash;
    private $avatar_prefix;
    private $avatar_filename;
    private $custom_styles;
    private $svg_data_string;

    public function __construct()
    {
        $this->avatar_prefix = 'avatar_';

        $this->setCacheDir(dirname(__FILE__, 3) . '/images/avatars/');
    }

    public function setCacheDir($cache_folder_path)
    {
        if (is_dir($cache_folder_path)) {
            $this->cache_folder_path = $cache_folder_path;
        } else {
            $this->addError('Folder cache nie istnieje.');

            return false;
        }
    }

    public function setFilename($avatar_filename)
    {
        $this->avatar_filename = $avatar_filename;
    }

    public function setSvgData($svg_data_string)
    {
        if ($this->custom_styles) {
            $this->svg_data_string = str_replace("<custom_styles></custom_styles>", $this->custom_styles,
                $svg_data_string);
        } else {
            $this->addError('Brak custom styles...');
        }

    }

    public function setCustomStyles($custom_styles)
    {

        $this->custom_styles = $custom_styles;
    }


    public function init()
    {
        $this->image = new IMagick();
        $this->image->setBackgroundColor(new ImagickPixel('transparent'));
    }

    public function displayImage($return_url = false)
    {
        // sprawdz cache, zwroc obrazek (lub link)

        $this->image->readImageBlob($this->svg_data_string);
        $this->image->setImageFormat("png");

        $this->writeAvatarImage();

        if ($return_url) {
            return $this->avatar_filename;
        } else {
//            header("Content-type: image/png");
            $im = $this->image->getImageBlob();
            $this->image->clear();

            return $im;
        }
    }

    private function writeAvatarImage($override = false)
    {
        if (is_dir($this->cache_folder_path)) {
            if (file_exists($this->cache_folder_path . $this->avatar_filename)) {
                // jesli istnieje i $override==true, usun wczesniej utworzony obrazek
            } else {

                $this->image->writeImage($this->cache_folder_path . $this->avatar_filename);
            }
        }
    }

    public function getRandomPng() {
        if (is_dir($this->cache_folder_path)) {
            $files = glob(realpath($this->cache_folder_path) . '/*.png');
            if(!empty($files)){
                $file = array_rand($files);
                return basename($files[$file]);
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    private function addError(string $message)
    {
        $this->errors[] = $message;
    }

    /**
     * Nice var_dump
     *
     * @param string|null $variable_name
     * @param bool        $highlight - Czy kolorować składnię
     */
    public function dd(string $variable_name = null, bool $highlight = false)
    {

        if ( ! $variable_name) {
            $array_data = $this;
        } else {
            $array_data = $this->{$variable_name};
        }

        self::dump($array_data, $highlight);

    }

    public static function dump($array_data, bool $highlight = false)
    {
        if ($highlight) {
            highlight_string("<?php\n\$array_data =\n" . var_export($array_data, true) . ";\n?>");
        } else {
            print("<pre>" . print_r($array_data, true) . "</pre>");
        }
    }
}

