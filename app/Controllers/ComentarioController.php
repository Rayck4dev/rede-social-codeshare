<?php

namespace App\Controllers;

use App\Models\ComentarioModel;
use CodeIgniter\API\ResponseTrait;

class ComentarioController extends BaseController
{
    use ResponseTrait;

    public function store()
    {
        $model = new ComentarioModel();

        $postagem_id = $this->request->getPost('postagem_id');
        $conteudo = $this->request->getPost('conteudo');
        $usuario_id = session()->get('usuario_id');

        if (empty($conteudo)) {
            return $this->fail('O comentário não pode estar vazio.');
        }

        $data = [
            'postagem_id' => $postagem_id,
            'usuario_id' => $usuario_id,
            'conteudo' => $conteudo
        ];

        if ($model->save($data)) {
            $total = $model->where('postagem_id', $postagem_id)->countAllResults();

            return $this->respond([
                'status' => 'success',
                'nome' => session()->get('usuario_nome'),
                'conteudo' => esc($conteudo),
                'data' => date('d/m H:i'),
                'total' => $total
            ]);
        }

        return $this->fail('Erro ao salvar comentário.');
    }

    public function delete($id)
    {
        $model = new ComentarioModel();
        $comentario = $model->find($id);

        if ($comentario && $comentario['usuario_id'] == session()->get('usuario_id')) {
            $model->delete($id);
            return $this->respond(['status' => 'success']);
        }

        return $this->failForbidden('Ação não permitida.');
    }
}