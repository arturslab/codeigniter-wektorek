<?php 
        class SettingsSeeder extends Seeder 
        { 
            private $table = 'settings';
             
            public function run() 
            { 

                $this->db->truncate($this->table); 
                
                // Records for configuration table
                $records = [
                    [
                        'name' => 'portal_name',
                        'title' => 'Nazwa serwisu',
                        'description' => '',
                        'value' => '',
                        'section' => 'portal',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'portal_logo',
                        'title' => 'Logo serwisu',
                        'description' => '',
                        'value' => '',
                        'section' => 'portal',
                        'field_type' => 'image',
                    ],
                    [
                        'name' => 'admin_email',
                        'title' => 'E-mail administratora',
                        'description' => '',
                        'value' => '',
                        'section' => 'smtp',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'facebook_link',
                        'title' => 'Facebook URL',
                        'description' => 'Adres URL do Facebooka',
                        'value' => '',
                        'section' => 'social',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'twitter_link',
                        'title' => 'Twitter URL',
                        'description' => 'Adres URL do Twittera',
                        'value' => '',
                        'section' => 'social',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'linkedin_link',
                        'title' => 'LinkedIn URL',
                        'description' => 'Adres URL do LinkedIn',
                        'value' => '',
                        'section' => 'social',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'portal_theme',
                        'title' => 'Motyw panelu administratora',
                        'description' => 'Motyw kolorystyczny panelu administracyjnego',
                        'value' => '',
                        'section' => 'panel',
                        'field_type' => 'text',
                    ],
                    [
                        'name' => 'portal_accent',
                        'title' => 'Kolor wyróżnienia panelu administratora',
                        'description' => 'Kolor wyróżnienia w panelu administracyjnego',
                        'value' => '',
                        'section' => 'panel',
                        'field_type' => 'color',
                    ],
                    [
                        'name' => '',
                        'title' => '',
                        'description' => '',
                        'value' => '',
                        'section' => '',
                        'field_type' => 'text',
                    ],


                ];

                echo 'Seeding ' . count($records) . ' records for ' . $this->table . ' table.';

                foreach ($records as $data) {
                    if(isset($data['name']) && !empty($data['name'])) {
                        echo ".";
                        $this->db->insert($this->table, $data);
                    }
                }
                echo PHP_EOL;

            }
        }