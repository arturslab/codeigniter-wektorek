<?php
class Migration_Settings extends CI_Migration
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
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'field_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'text',
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
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'created_from_ip' => ['type' => 'VARCHAR', 'constraint' => 100],
            'updated_from_ip' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at DATETIME DEFAULT current_timestamp',
            'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp',
        ]);
        $this->dbforge->add_key('id', TRUE);
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->dbforge->create_table('settings', FALSE, $attributes);
    }

    public function down()
    {
        $this->dbforge->drop_table('settings');
    }
}