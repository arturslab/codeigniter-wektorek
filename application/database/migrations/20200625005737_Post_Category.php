<?php 
            class Migration_Post_Category extends CI_Migration 
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
                        'category_id' => [
                            'type' => 'INT', 
                            'constraint' => 11,
                            'unsigned' => TRUE,
                            'default' => 1,
                        ],
                        'post_id' => [
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => TRUE,
                            'default' => 1,
                        ],
                        'is_active' => [
                            'type' => 'INT',
                            'constraint' => 1,
                            'default' => 1,
                            'comment' => '1=Active | 0=Inactive'
                        ],
                        'created_from_ip' => [
                            'type' => 'VARCHAR', 
                            'constraint' => 100,
                            'comment' => 'Log user IP on create record'
                        ],
                        'updated_from_ip' => [
                            'type' => 'VARCHAR', 
                            'constraint' => 100,
                            'comment' => 'Log user IP on update record'
                        ],
                        'created_at DATETIME DEFAULT current_timestamp',
                        'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp',
                    ]); 
                    $this->dbforge->add_key('id', TRUE); 
                    $attributes = ['ENGINE' => 'InnoDB'];
                    $this->dbforge->create_table('post_category', FALSE, $attributes); 
                } 
                
                public function down() 
                { 
                    $this->dbforge->drop_table('post_category'); 
                }
             }