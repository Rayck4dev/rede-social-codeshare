<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'usuario_id' => 1,
                'postagem_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 1,
                'postagem_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 2,
                'postagem_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 2,
                'postagem_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('likes')->insertBatch($data);
    }
}
