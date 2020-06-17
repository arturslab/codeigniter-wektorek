<?php 
        class SettingsSeeder extends Seeder 
        { 
            private $table = 'settings';
             
            public function run() 
            { 
                // initiate faker
                //$this->faker = Faker\Factory::create();
            
                $this->db->truncate($this->table); 
                
                // Records for configuration table

                $records[] = [
                    'name' => 'portal_name',
                    'title' => 'Nazwa serwisu',
                    'description' => '',
                    'value' => '',
                    'section' => 'portal',
                    'field_type' => 'text',
                ];

                $records[] = [
                    'name' => 'portal_logo',
                    'title' => 'Logo serwisu',
                    'description' => '',
                    'value' => '',
                    'section' => 'portal',
                    'field_type' => 'image',
                ];

                $records[] = [
                    'name' => 'admin_email',
                    'title' => 'E-mail administratora',
                    'description' => '',
                    'value' => '',
                    'section' => 'smtp',
                    'field_type' => 'text',
                ];

                $records[] = [
                    'name' => 'facebook_link',
                    'title' => 'Facebook URL',
                    'description' => 'Adres URL do Facebooka',
                    'value' => '',
                    'section' => 'social',
                    'field_type' => 'text',
                ];

                $records[] = [
                    'name' => 'twitter_link',
                    'title' => 'Twitter URL',
                    'description' => 'Adres URL do Twittera',
                    'value' => '',
                    'section' => 'social',
                    'field_type' => 'text',
                ];

                $records[] = [
                    'name' => 'linkedin_link',
                    'title' => 'LinkedIn URL',
                    'description' => 'Adres URL do LinkedIn',
                    'value' => '',
                    'section' => 'social',
                    'field_type' => 'text',
                ];

                $records[] = [
                    'name' => '',
                    'title' => '',
                    'description' => '',
                    'value' => '',
                    'section' => '',
                    'field_type' => 'text',
                ];

                echo 'Seeding ' . count($records) . ' records for settings table.';

                foreach ($records as $data) {
                    if(isset($data['name']) && !empty($data['name'])) {
                        echo ".";
                        $this->db->insert($this->table, $data);
                    }
                }
                echo PHP_EOL;


            }
        }