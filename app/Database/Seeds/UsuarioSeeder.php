<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Raycka',
                'email' => 'ray@example.com',
                'senha' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nome' => 'Maria',
                'email' => 'maria@example.com',
                'senha' => password_hash('654321', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}
