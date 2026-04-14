<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeguidoresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'seguidor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'seguido_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('seguidor_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('seguido_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('seguidores');
    }

    public function down()
    {
        $this->forge->dropTable('seguidores');
    }
}