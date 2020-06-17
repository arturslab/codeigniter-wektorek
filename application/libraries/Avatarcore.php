<?php defined('BASEPATH') or exit('No direct script access allowed');

class Avatarcore
{

    private $errors;

    private $avatar_customization;
    private $colors;
    private $avatars_config;
    private $items;
    private $avatar_hash;
    private $svg_path;
    private $svg_filename;
//    private $width=380;
//    private $height=380;

    public function __construct($avatars_config)
    {

        $this->init($avatars_config);
        //$this->svg_filename = 'faces_all_in_one_optimized.svg';

        $this->items = [];

        //$this->avatars_config = isset($avatars_config['avatars_data']) ? $avatars_config['avatars_data'] : null;

    }

    // Przypisz dane z tablicy konfiguracyjnej do odpowiednich zmiennych
    public function init(array $avatars_config)
    {

        if (isset($avatars_config['avatars_data'])) {
            $this->avatars_config = $avatars_config['avatars_data'];
        }

        if (isset($avatars_config['svg_path'])) {
            $this->svg_path = $avatars_config['svg_path'];
        }

        if (isset($avatars_config['svg_filename'])) {
            $this->svg_filename = $avatars_config['svg_filename'];
        }

        // Załaduj tablicę dostępnych kolorów
        $this->prepareColors();

        // Tablica elementów możliwych do parameetryzacji przez użytkownika
        $this->avatar_customization['gender']   = 'female';
        $this->avatar_customization['elements'] = [
            'hair'       => [
                'gender' => 'female',
            ],
            'head'       => [
                'gender' => 'male',
            ],
            'eye'        => [
                'gender' => 'male',
            ],
            'mouth'      => [
                'gender' => 'male',
            ],
            'nose'      => [
                'gender' => 'male',
            ],
            'blouse'     => [
                'gender' => 'male',
            ],
            'beard'      => [
                'gender' => 'male',
            ],
            'eyeglasses'      => [
                'gender' => 'male',
            ],
            'background' => [
                'gender' => 'male',
            ],

        ];

        $this->buildAvatar();
    }

    private function buildAvatar()
    {

        foreach ($this->avatar_customization['elements'] as $element_name => $v) {
            $gender = isset($this->avatar_customization['gender']) ? $this->avatar_customization['gender'] : null;

            if ($n = $this->prepareDefaultItemStructure($element_name, $gender)) {
                $this->items[$element_name] = $n;
            } else {
                $this->addError('Nieprawidłowa nazwa ' . $element_name);
            }
        }
    }


    /**
     * Buduje strukturę elementu (np. hair)
     *
     * @param string $name
     *
     * @return array
     */
    private function prepareDefaultItemStructure(string $name, $gender = null)
    {

        if ( ! $this->isValidName($name)) {
            $this->addError('Nieprawidłowa nazwa ' . $name);

            return false;
        }

        // Wyklucz elementy nie należące do wybranej płci...
        if ($gender === 'female' && in_array($name, ['beard'])) {
            return false;
        }

        $id = $this->getItemId($name);
        if ($gender && in_array($gender, ['male', 'female'])) {

        } else {
            $gender = null;
        }

        // print_r($id); die('aaaa');

        $item = [
            'id'                 => $id,
            'gender'             => $gender,
            'editable_items'     => $this->prepareDefaultItem($name, $id, true),
            'not_editable_items' => $this->prepareDefaultItem($name, $id, false),
        ];

        return $item;
    }

    /**
     * Buduje strukture cech elementu.
     * (warstwy elementu edytowalne, nieedytowalne - np Hair)
     *
     * @param string      $name     - Nazwa elementu, np hair
     * @param int         $id       - ID elementu (np. ID fryzury)
     * @param bool        $editable - Czy element jest edytowalny (możliwa zmiana koloru na kolor użytkownika)
     * @param string|null $color    - Opcjonalna wartość koloru
     *
     * @return array
     */
    private function prepareDefaultItem(string $name, int $id, bool $editable = false, string $color = null)
    {

        // Uwaga, jeśli ilość nieedytowalnych warstw danego elementu (np hair) jest większa od ilości edytowalnych warstw, to zwiększ wartość $amount do tej ilości.
        $amount         = 8;
        $item_data      = [];
        $id_name_prefix = '';

        if ($id) {
            $visible = 'y';
            if ($editable) {
                // kolor użytkownika lub losowy element z tablicy kolorów
                $fill = isset($color) && self::isValidColor($color) ?  $color : $this->getRandomColor();
//                $fill = isset($color) ?  $color : $this->getRandomColor();
            } else {
                $fill           = null;
                $id_name_prefix = 'locked_';
            }
        } else {
            $id      = 1;
            $visible = 'n';
            $fill    = '#FFF';
        }

        for ($i = 0; $i < $amount; $i++) {
            $n             = $i + 1;
            $item_data[$i] = [
                'id_item' => $n,
                'id_name' => $id_name_prefix . $name . '_' . $id . '_' . $n,
                'visible' => $visible,
            ];
            if ($fill) {
                $item_data[$i]['fill'] = $fill;
            }
        }

        return $item_data;
    }

    /**
     * Tablica domyślnych kolorów
     */
    private function prepareColors()
    {
        $this->colors = [
            '#ff2a2a',
            '#ffdd55',
            '#2a7fff',
            '#ff00cc',
            '#ff2a7f',
            '#7fff2a',
            '#333333',
            '#b3b3b3',
            '#ff7f2a',
            '#ff5555',
            '#916f6f',
            '#d35f5f',
            '#ff9955',
            '#ff6600',
            '#c87137',
            '#ffcc00',
            '#ffe680',
            '#aad400',
            '#ddff55',
            '#bcd35f',
            '#99ff55',
            '#8dd35f',
            '#5fd35f',
            '#55ff99',
            '#55ffdd',
            '#00d4aa',
            '#00aad4',
            '#55ddff',
            '#87cdde',
            '#3771c8',
            '#7f2aff',
            '#aa87de',
            '#d42aff',
            '#e580ff',
            '#cd87de',
            '#ff55dd',
            '#ff0066',
        ];
    }

    /**
     * Zwraca ID elementu znajdującego się w konfiguracji
     * Np. id hair - ID danej fryzury
     *
     * @param string   $name
     * @param int|null $id
     *
     * @return int|null
     */
    private function getItemId(string $name, int $id = null)
    {

        // Zwróć ID jeśli istnieje w konfiguracji
        if (isset($this->avatars_config[$name])) {

            $range = range($this->avatars_config[$name]['min'], $this->avatars_config[$name]['max']);

            if ($id) {
                $id = (int)$id;

                // ID poza zakresem - losuj z zakresu
                if ( ! in_array($id, $range)) {
                    shuffle($range);
                    $id = $range[0];
                }

            } else {
                // Brak ID - pobierz losowy dla danego elementu

                shuffle($range);
                $id = $range[0];

            }
        } else {
            // Brak konfiguracji dla elementu o podanej nazwie
            $this->addError('Brak konfiguracji dla elementu ' . $name);
            $id = null;
        }

        return $id;

    }


    /**
     * Zwraca wartość losowego koloru
     *
     * @return mixed
     */
    private function getRandomColor()
    {

        $colors = $this->colors;

        shuffle($colors);

        return $colors[0];
    }

    private function addError(string $message)
    {
        $this->errors[] = $message;
    }

    /*** KREATOR ***/

    // Ustaw konfigurację użytkownika, jeśli przekazono
    public function setUserPreferences(array $data)
    {
        //self::dump($data);

        if (isset($data) && ! empty($data)) {

            if (isset($this->avatar_customization['elements']) && ! empty($this->avatar_customization['elements'])) {

                foreach ($this->avatar_customization['elements'] as $element_name => $v) {
                    if (isset($data[$element_name]) && ! empty($data[$element_name])) {

                        // Jeśli user wybrał opcję "nie pokazuj elementu"
                        if($data[$element_name]=='none') {
                            $this->hideCustomItem($element_name);
                        }
                        else {
                            $color = isset($data[$element_name . '_color']) ? $data[$element_name . '_color'] : null;
                            $this->setCustomItem($element_name, $data[$element_name], $color);
                        }
                    }
                }
            }

            //return false;
        }

        $this->avatar_hash = md5(serialize($this->items));

        return false;
    }

    private function setCustomItem($element_name, $id, $color = null)
    {

        if (isset($element_name) && ! empty($element_name) && self::isValidName($element_name)) {
            $this->items[$element_name]['id']                 = $id;
            $this->items[$element_name]['editable_items']     = $this->prepareDefaultItem($element_name, $id, true,
                $color);
            $this->items[$element_name]['not_editable_items'] = $this->prepareDefaultItem($element_name, $id, false);
        }

    }

    // Ukryj wybrany element (np. okulary) - do użycia w kontrolerze
    public function hideCustomItem($element_name) {
        if(isset($this->items[$element_name])) {
            unset($this->items[$element_name]);
        }
    }


    /*** RYSOWANIE ***/

    // Zwraca kod CSS wybranego avatara
    public function getCssStyle()
    {

        $css = '<style>';
        foreach ($this->items as $data) {

            foreach ($data['editable_items'] as $v) {
                if ($v['visible'] == 'y') {
                    $css .= '#' . $v['id_name'] . ' {display:inline !important; fill: ' . $v['fill'] . ' !important}';
                } else {
                    $css .= '#' . $v['id_name'] . ' {display:none !important;}';
                }
            }
            foreach ($data['not_editable_items'] as $v) {
                if ($v['visible'] != 'y') {
                    $css .= '#' . $v['id_name'] . ' {display:none !important;}';
                } else {
                    $css .= '#' . $v['id_name'] . ' {display:inline !important;}';
                }
            }
        }
        $css .= '</style>';
        return $css;
    }

    public function showSvg()
    {

        $svg_file = $this->svg_path . $this->svg_filename;
        $output   = '';

        if (file_exists($svg_file)) {
            $svg_file_data = file_get_contents($svg_file);

            $output .= '';
            //$output .= '<svg width="' . $this->width . '" height="' . $this->height . '">';
            $output .= str_replace('<path ', '<path class="avatar" ', $svg_file_data);
            //$output .= 'Sorry, your browser does not support inline SVG.</svg>';
        }

        return $output;

    }

    public function getAvatarHash()
    {
        return $this->avatar_hash;
    }

    /*** HELPERS ***/

    private static function isValidName(string $string)
    {

        if (preg_match('/^[a-z\d_]{3,30}$/i', $string)) {
            return true;
        } else {
            return false;
        }
    }

    private static function isValidColor(string $string)
    {

        /*
         if (preg_match('/(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))/i', $string)) {
        */
        if (preg_match('/^[#abcdef\0-9]{3,7}$/i', $string)) {
            return true;
        } else {
            return false;
        }
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