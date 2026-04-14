<?php

namespace App\Controllers;

use App\Models\PostagemModel;
use App\Models\ComentarioModel;
use CodeIgniter\Controller;

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

    public function create()
    {
        return view('postagens/create');
    }

    /**
     * Salva a Postagem (Feed ou Página Create)
     */
    public function store()
    {
        $regras = [
            'conteudo' => 'required|min_length[3]',
            'imagem' => 'permit_empty|is_image[imagem]|max_size[imagem,2048]' // Máximo 2MB
        ];

        if (!$this->validate($regras)) {
            return redirect()->back()->withInput()->with('erro', 'Dados inválidos ou imagem muito pesada.');
        }

        $data = [
            'usuario_id' => session()->get('usuario_id'),
            'conteudo' => $this->request->getPost('conteudo'),
        ];

        $file = $this->request->getFile('imagem');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $caminhoDestino = FCPATH . 'uploads/posts';

            if (!is_dir($caminhoDestino)) {
                mkdir($caminhoDestino, 0777, true);
            }

            $newName = $file->getRandomName();
            $file->move($caminhoDestino, $newName);

            $data['imagem'] = $newName;
        }

        if ($this->postModel->save($data)) {
            return redirect()->to('/feed')->with('sucesso', 'Deploy realizado com sucesso!');
        }

        return redirect()->back()->with('erro', 'Falha crítica ao salvar no banco.');
    }

    public function show($id)
    {
        $postagem = $this->postModel
            ->select('postagens.*, usuarios.nome as nome_usuario')
            ->join('usuarios', 'usuarios.id = postagens.usuario_id')
            ->find($id);

        if (!$postagem) {
            return redirect()->to('/feed')->with('erro', 'Objeto não encontrado no servidor.');
        }

        $comentarioModel = new ComentarioModel();
        $comentarios = $comentarioModel
            ->select('comentarios.*, usuarios.nome as nome_usuario')
            ->join('usuarios', 'usuarios.id = comentarios.usuario_id')
            ->where('postagem_id', $id)
            ->orderBy('comentarios.created_at', 'ASC')
            ->findAll();

        return view('postagens/show', [
            'postagem' => $postagem,
            'comentarios' => $comentarios
        ]);
    }

    public function edit($id)
    {
        $postagem = $this->postModel->find($id);

        if (!$postagem || $postagem['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('erro', 'Acesso negado ao código fonte!');
        }

        return view('postagens/edit', ['postagem' => $postagem]);
    }

    public function update($id)
    {
        $postagem = $this->postModel->find($id);

        if (!$postagem || $postagem['usuario_id'] != session()->get('usuario_id')) {
            return redirect()->to('/feed')->with('erro', 'Ação não permitida!');
        }

        $this->postModel->update($id, [
            'conteudo' => $this->request->getPost('conteudo')
        ]);

        return redirect()->to('/feed')->with('sucesso', 'Hotfix aplicado com sucesso!');
    }

    public function delete($id)
    {
        $postagem = $this->postModel->find($id);

        if ($postagem && $postagem['usuario_id'] == session()->get('usuario_id')) {

            if (!empty($postagem['imagem'])) {
                $caminhoArquivo = FCPATH . 'uploads/posts/' . $postagem['imagem'];
                if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
                }
            }

            $this->postModel->delete($id);
            return redirect()->to('/feed')->with('sucesso', 'Rollback concluído: postagem removida.');
        }

        return redirect()->to('/feed')->with('erro', 'Falha ao remover objeto.');
    }
}