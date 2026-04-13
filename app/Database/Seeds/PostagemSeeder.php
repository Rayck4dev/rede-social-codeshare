<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostagemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'usuario_id' => 1,
                'titulo' => 'Primeira Postagem',
                'conteudo' => 'Primeira postagem de teste!',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 1,
                'titulo' => 'Aprendendo CodeIgniter',
                'conteudo' => 'Curtindo aprender CodeIgniter 4 🚀',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 2,
                'titulo' => 'Olá Mundo',
                'conteudo' => 'Olá, mundo! Esta é minha primeira postagem.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario_id' => 2,
                'titulo' => 'Projeto Top',
                'conteudo' => 'Esse projeto de feed está ficando top!',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('postagens')->insertBatch($data);
    }
}
