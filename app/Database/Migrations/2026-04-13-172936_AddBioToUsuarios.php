<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBioToUsuarios extends Migration
{
    public function up()
    {
        $fields = [
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'senha'
            ],
        ];
        $this->forge->addColumn('usuarios', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'bio');
    }
}
