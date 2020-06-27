<?php 
            class Migration_Posts extends CI_Migration 
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
                        'is_pending' => [
                            'type' => 'INT',
                            'constraint' => 1,
                            'default' => 0,
                            'comment' => '1=Pending article | 0=Allow publish'
                        ],
                        'is_public' => [
                            'type' => 'INT',
                            'constraint' => 1,
                            'default' => 1,
                            'comment' => '1=For all | 0=For authorized users'
                        ],
                        'user_id' => [
                            'type' => 'INT',
                            'constraint' => 11,
                            'unsigned' => TRUE,
                            'null' => TRUE,
                            'default' => NULL,
                            'comment' => 'ID of article author (if used)'
                        ],
                        'title' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                        ],
                        'slug' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            'unique' => TRUE,
                            'comment' => 'SEO friendly name for URL'
                        ],
                        'picture' => [
                            'type' => 'VARCHAR',
                            'constraint' => '128',
                            'null' => TRUE,
                            'default' => NULL,
                            'comment' => 'Path to blog article image file'
                        ],
                        'picture_id' => [
                            'type' => 'INT',
                            'constraint' => 11,
                            'default' => 0,
                            'comment' => 'ID of blog article image file'
                        ],
                        'allow_comment' => [
                            'type' => 'INT',
                            'constraint' => 1,
                            'default' => 0,
                            'comment' => '1-Allow comments|0-Disable comments'
                        ],
                        'short_content' => [
                            'type' => 'TEXT',
                            'null' => TRUE,
                            'comment' => 'Short content of blog article'
                        ],
                        'content' => [
                            'type' => 'TEXT',
                            'null' => TRUE,
                            'comment' => 'Full content of blog article'
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
                    $this->dbforge->create_table('posts', FALSE, $attributes); 
                } 
                
                public function down() 
                { 
                    $this->dbforge->drop_table('posts'); 
                }
             }