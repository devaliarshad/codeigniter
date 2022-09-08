<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCake extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
            'type' => 'BIGINT',
            'constraint' => 255,
            'unsigned' => true,
            'auto_increment' => true
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'recipe' => [
            'type' => 'TEXT',
            'constraint' => '255',
        ],
        'price' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            ],
        'created_at' => [
            'type' => 'TIMESTAMP',
            'null' => true
        ],
        'updated_at' => [
            'type' => 'TIMESTAMP',
            'null' => true
        ],
    ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cakes');
    }

    public function down()
    {
        $this->forge->dropTable('cakes');
    }
}
