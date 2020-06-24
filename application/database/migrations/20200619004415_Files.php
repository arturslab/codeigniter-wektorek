<?php 
            class Migration_Files extends CI_Migration 
            { 
                public function up() 
                { 
                    $this->dbforge->add_field([
                        'id' => [
                            'type' => 'INT', 
                            'constraint' => 11,
                            'unsigned' => TRUE, 
                            'auto_increment' => TRUE 
                        ],
                        'is_active' => [
                            'type' => 'INT', 
                            'constraint' => 1, 
                            'default' => 1,
                            'comment' => '1=Active | 0=Inactive'
                        ],
                        'name' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            'unique' => TRUE
                        ],
                        'name_hash' => [
                            'type' => 'VARCHAR',
                            'constraint' => '40',
                            'unique' => TRUE,
                            'comment' => 'SHA1 filename hash'
                        ],
                        'title' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            'null' => TRUE
                        ],
                        'type' => [
                            'type' => 'VARCHAR',
                            'constraint' => '20',
                            'null' => TRUE
                        ],

                        'is_image' => [
                            'type' => 'INT',
                            'constraint' => '1',
                            'null' => TRUE,
                            'default' => 0,
                            'comment' => '1=File is image | 0=File is not image'
                        ],

                        'image_width' => [
                            'type' => 'INT',
                            'constraint' => '1',
                            'null' => TRUE,
                            'default' => NULL,
                            'comment' => 'Image width in pixels'
                        ],

                        'image_height' => [
                            'type' => 'INT',
                            'constraint' => '1',
                            'null' => TRUE,
                            'default' => NULL,
                            'comment' => 'Image height in pixels'
                        ],

                        'image_type' => [
                            'type' => 'VARCHAR',
                            'constraint' => '10',
                            'null' => TRUE,
                            'default' => NULL
                        ],

                        'ext' => [
                            'type' => 'VARCHAR',
                            'constraint' => '10',
                            'null' => TRUE,
                            'comment' => 'File extension without dot'
                        ],
                        'size' => [
                            'type' => 'BIGINT',
                            'null' => TRUE,
                            'comment' => 'File size in bytes'
                        ],
                        'created_from_ip' => [
                            'type' => 'VARCHAR',
                            'constraint' => 100
                        ],
                        'updated_from_ip' => [
                            'type' => 'VARCHAR', 
                            'constraint' => 100
                        ],
                        'created_at DATETIME DEFAULT current_timestamp',
                        'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp',
                    ]); 
                    $this->dbforge->add_key('id', TRUE); 
                    $attributes = ['ENGINE' => 'InnoDB'];
                    $this->dbforge->create_table('files', FALSE, $attributes); 
                } 
                
                public function down() 
                { 
                    $this->dbforge->drop_table('files'); 
                }
             }