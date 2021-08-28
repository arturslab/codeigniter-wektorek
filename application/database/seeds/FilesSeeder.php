<?php 
        class FilesSeeder extends Seeder 
        { 
            private $table = 'files';
             
            public function run() 
            { 

                $this->db->truncate($this->table);

                //seed records manually 
                $records = [
                    [
                        'id' => 1,
                        'name' => 'sample_1.pdf',
                        'name_hash' => sha1('sample_1.pdf'),
                        'ext' => 'pdf',
                        'size' => 128000,
                        'title' => 'Sample PDF file',
                    ],
                    [
                        'id' => 2,
                        'name' => 'sample_2.zip',
                        'name_hash' => sha1('sample_2.zip'),
                        'ext' => 'zip',
                        'size' => 933232640,
                        'title' => 'Sample ZIP file',
                    ],
                    [
                        'id' => 3,
                        'name' => 'sample_3.doc',
                        'name_hash' => sha1('sample_3.doc'),
                        'ext' => 'doc',
                        'size' => 1222283,
                        'title' => 'Sample DOC file',
                    ],
                    [
                        'id' => 4,
                        'name' => 'sample_4.png',
                        'name_hash' => sha1('sample_4.png'),
                        'ext' => 'png',
                        'is_image' => 1,
                        'image_width' => 150,
                        'image_height' => 150,
                        'image_type' => 'png',
                        'size' => 259072,
                        'title' => 'Sample PNG file',
                    ],
                    [
                        'id' => 5,
                        'name' => 'sample_5.jpg',
                        'name_hash' => sha1('sample_5.jpg'),
                        'ext' => 'jpg',
                        'is_image' => 1,
                        'image_width' => 1200,
                        'image_height' => 400,
                        'image_type' => 'jpeg',
                        'size' => 1268775,
                        'title' => 'Sample JPG file',
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