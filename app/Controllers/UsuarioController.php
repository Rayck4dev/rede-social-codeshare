<?php

namespace App\Controllers;

use App\Models\PostagemModel;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function perfil($id)
    {
        $usuarioModel = new UsuarioModel();
        $postagemModel = new PostagemModel();

        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/feed')->with('error', 'Usuário não encontrado.');
        }

        $postagens = $postagemModel->select('postagens.*, usuarios.nome as nome_usuario')
            ->join('usuarios', 'usuarios.id = postagens.usuario_id')
            ->where('postagens.usuario_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('perfil/index', [
            'usuario' => $usuario,
            'postagens' => $postagens
        ]);
    }

    public function settings()
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find(session()->get('usuario_id'));

        return view('settings/index', ['usuario' => $usuario]);
    }

    public function toggleFollow($idSeguido)
    {
        $db = \Config\Database::connect();
        $seguidorId = session()->get('usuario_id');

        $check = $db->table('seguidores')->where([
            'seguidor_id' => $seguidorId,
            'seguido_id' => $idSeguido
        ])->get()->getRow();

        if ($check) {
            $db->table('seguidores')->where('id', $check->id)->delete();
            $status = 'unfollowed';
        } else {
            $db->table('seguidores')->insert([
                'seguidor_id' => $seguidorId,
                'seguido_id' => $idSeguido
            ]);
            $status = 'followed';
        }

        return $this->response->setJSON(['status' => $status]);
    }
    public function update()
    {
        $usuarioModel = new UsuarioModel();
        $id = session()->get('usuario_id');

        $dados = [
            'nome' => $this->request->getPost('nome'),
            'bio' => $this->request->getPost('bio') // Adicione esta linha
        ];

        if (!empty($dados['nome'])) {
            $usuarioModel->update($id, $dados);
            session()->set('usuario_nome', $dados['nome']);
            return redirect()->back()->with('success', 'Profile updated!');
        }
        return redirect()->back()->with('error', 'Failed to update.');
    }
}