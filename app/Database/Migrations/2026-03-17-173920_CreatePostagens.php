<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostagens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'usuario_id' => ['type' => 'INT'],
            'texto'      => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('postagens');
    }

    public function down()
    {
        $this->forge->dropTable('postagens');
    }
}
