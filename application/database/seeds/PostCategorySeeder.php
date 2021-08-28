<?php 
        class PostCategorySeeder extends Seeder 
        { 
            private $table = 'post_category';
             
            public function run() 
            { 
            
                $this->db->truncate($this->table); 
                
                // Seed records manually 
                $records = [
                    [ 
                        'category_id' => 1,
                        'post_id' => 1,
                        'created_from_ip' => '127.0.0.1',
                    ],
                    [
                        'category_id' => 1,
                        'post_id' => 2,
                        'created_from_ip' => '127.0.0.1',
                    ],
                    [
                        'category_id' => 1,
                        'post_id' => 3,
                        'created_from_ip' => '127.0.0.1',
                    ],
                ];
                
                echo 'Seeding ' . count($records) . ' records for ' . $this->table . ' table.';
                
                foreach ($records as $data) {
                    if(isset($data['post_id']) && !empty($data['post_id'])) {
                        echo ".";
                        $this->db->insert($this->table, $data);
                    }
                }
                
                echo PHP_EOL;
            }
        }