<?php

class Migration_Brands extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(['id'              => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                                   'description'     => ['type' => 'VARCHAR', 'constraint' => 100],
                                   'created_from_ip' => ['type' => 'VARCHAR', 'constraint' => 100],
                                   'updated_from_ip' => ['type' => 'VARCHAR', 'constraint' => 100],
                                   'date_created'    => ['type' => 'DATETIME'],
                                   'date_updated'    => ['type' => 'DATETIME'],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('brands');
    }

    public function down()
    {
        $this->dbforge->drop_table('brands');
    }
}