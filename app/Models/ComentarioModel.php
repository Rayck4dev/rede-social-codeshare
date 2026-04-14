<?php

namespace App\Models;

use CodeIgniter\Model;

class ComentarioModel extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'postagem_id',
        'conteudo',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'conteudo' => 'required|min_length[1]'
    ];
}