<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthModule extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
                'unique' => true,
            ],
            'module_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'updated_at'       => [
                'type' => 'datetime',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('auth_module', true);
    }

    public function down()
    {
        $this->forge->dropTable('auth_module');
    }
}
