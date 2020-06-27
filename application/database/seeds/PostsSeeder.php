<?php 
        class PostsSeeder extends Seeder 
        { 
            private $table = 'posts';
             
            public function run() 
            { 
            
                $this->db->truncate($this->table); 
                
                // Seed records manually 
                $records = [
                    [
                        'id' => 1,
                        'title' => 'Title 1',
                        'slug' => 'title_1',
                        'content' => 'Lorem ipsum 1',
                        'created_from_ip' => '127.0.0.1',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Title 2',
                        'slug' => 'title_2',
                        'content' => 'Lorem ipsum 2',
                        'created_from_ip' => '127.0.0.1',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Title 3',
                        'slug' => 'title_3',
                        'content' => 'Lorem ipsum 3',
                        'created_from_ip' => '127.0.0.1',
                    ],
                ];
                
                echo 'Seeding ' . count($records) . ' records for ' . $this->table . ' table.';
                
                foreach ($records as $data) {
                    if(isset($data['title']) && !empty($data['title'])) {
                        echo ".";
                        $this->db->insert($this->table, $data);
                    }
                }

                echo PHP_EOL;
            }
        }