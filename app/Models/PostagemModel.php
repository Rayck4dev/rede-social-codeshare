<?php

namespace App\Models;

use CodeIgniter\Model;

class PostagemModel extends Model
{
    protected $table = 'postagens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'titulo', 'conteudo', 'imagem', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Callbacks 
    protected $beforeInsert = ['sanitizeTexto'];
    protected $beforeUpdate = ['sanitizeTexto'];

    protected function sanitizeTexto(array $data)
    {
        if (isset($data['data']['titulo'])) {
            $data['data']['titulo'] = htmlspecialchars($data['data']['titulo']);
        }
        if (isset($data['data']['conteudo'])) {
            $data['data']['conteudo'] = htmlspecialchars($data['data']['conteudo']);
        }
        return $data;
    }
}
