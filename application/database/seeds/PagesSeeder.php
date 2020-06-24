<?php 
        class PagesSeeder extends Seeder 
        { 
            private $table = 'pages';
             
            public function run() 
            { 
                // initiate faker
//                $this->faker = Faker\Factory::create();
            
                $this->db->truncate($this->table); 
                
                //seed records manually 
                $records = [
                    [
                        'id' => 1,
                        'name' => 'kontakt',
                        'title' => 'Kontakt',
                        'description' => 'Masz jakieś pytania? Zapraszamy do kontaktu z nami.',
                    ],
                    [
                        'id' => 2,
                        'name' => 'galeria',
                        'title' => 'Galeria zdjęć',
                        'description' => '',
                    ],
                    [
                        'id' => 3,
                        'name' => 'filmy',
                        'title' => 'Filmy',
                        'description' => '',
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
                
                //seed many records using faker
                /*
                $limit = 33; 
                echo "seeding $limit user accounts"; 
                for ($i = 0; $i < $limit; $i++) { 
                    echo "."; 
                    $data = [ 
                        'user_name' => $this->faker->unique()->userName, 
                        'password' => '1234', 
                        'name' => $this->faker->unique()->word,
                        'title' => $this->faker->unique()->word,
                        'created_from_ip'    => $this->faker->ipv4,
                        'updated_from_ip'    => $this->faker->ipv4,
                        'created_at'    => $this->faker->date($format = 'Y-m-d'),
                        'updated_at'    => $this->faker->date($format = 'Y-m-d'),
                        'email'    => $this->faker->unique()->email,
                    ];
                    $this->db->insert($this->table, $data); 
                }
                */

                echo PHP_EOL;
            }
        }