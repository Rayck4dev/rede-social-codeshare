<?php

namespace App\Controllers;

use App\Models\PostagemModel;

class PostController extends BaseController
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostagemModel();
    }

    public function index()
    {
        $data['postagens'] = $this->postModel
            ->select('postagens.*, usuarios.nome as nome_usuario')
            ->join('usuarios', 'usuarios.id = postagens.usuario_id')
            ->orderBy('postagens.created_at', 'DESC')
            ->findAll();

        return view('postagens/index', $data);
    }

    public function store()
    {
        $this->postModel->save([
            'usuario_id' => session()->get('usuario_id'),
            'titulo' => 'Nova Postagem',
            'conteudo' => $this->request->getPost('conteudo'),
        ]);

        return redirect()->to('/feed');
    }

    // 1. Abre o formulário de edição
    public function edit($id)
    {
        $model = new \App\Models\PostagemModel();
        $postagem = $model->find($id);

        // Segurança: só o dono pode editar
        if ($postagem['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('erro', 'Acesso negado!');
        }

        return view('postagens/edit', ['postagem' => $postagem]);
    }
    public function update($id)
    {
        $model = new \App\Models\PostagemModel();
        $postagem = $model->find($id);

        if ($postagem['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('erro', 'Ação não permitida!');
        }

        $model->update($id, [
            'conteudo' => $this->request->getPost('conteudo') 
        ]);

        return redirect()->to('/feed')->with('sucesso', 'Post atualizado com sucesso (Hotfix aplicado)!');
    }
    public function delete($id)
    {
        $post = $this->postModel->find($id);

        if ($post && $post['usuario_id'] == session()->get('usuario_id')) {
            $this->postModel->delete($id);
            return redirect()->to('/feed')->with('sucesso', 'Postagem excluída com sucesso!');
        }

        return redirect()->to('/feed')->with('erro', 'Não foi possível excluir a postagem.');
    }

}