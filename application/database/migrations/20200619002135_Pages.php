<?php 
            class Migration_Pages extends CI_Migration 
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
                            'default' => 1
                        ],
                        'name' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            'unique' => TRUE,
                        ],
                        'title' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                        ],
                        'thumbnail_id' => [
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => TRUE,
                            'null' => TRUE,
                        ],
                        'description' => [
                            'type' => 'TEXT',
                            'null' => TRUE,
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
                    $this->dbforge->create_table('pages', FALSE, $attributes); 
                } 
                
                public function down() 
                { 
                    $this->dbforge->drop_table('pages'); 
                }
             }