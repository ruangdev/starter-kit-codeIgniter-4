<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserProfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'primary' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'fullName' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'imageName' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'pathImage' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'numberPhone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'TeleID' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_profile');
    }

    public function down()
    {
        $this->forge->dropTable('user_profile');
    }
}
