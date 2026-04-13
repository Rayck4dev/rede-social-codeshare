<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logado')) {
            return redirect()->to('/feed');
        }

        return view('auth/login');
    }

    public function cadastro()
    {
        if (session()->get('logado')) {
            return redirect()->to('/feed');
        }

        return view('auth/cadastro');
    }

    public function autenticar()
    {
        $usuarioModel = new UsuarioModel();

        $email = strtolower(trim($this->request->getPost('email')));
        $senha = $this->request->getPost('senha');

        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario) {
            return redirect()->back()->with('erro', "Email '$email' não encontrado");
        }

        if (!password_verify(trim($senha), $usuario['senha'])) {
            return redirect()->back()->with('erro', "Senha incorreta para email '$email'");
        }

        session()->set([
            'usuario_id' => $usuario['id'],
            'usuario_nome' => $usuario['nome'],
            'logado' => true
        ]);

        return redirect()->to('/feed');
    }

    public function registrar()
{
    $usuarioModel = new UsuarioModel();

    $data = [
        'nome'  => $this->request->getPost('nome'),
        'email' => $this->request->getPost('email'),
        'senha' => $this->request->getPost('senha'),
    ];

    $usuarioModel->insert($data);
    return redirect()->to('/login');
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
