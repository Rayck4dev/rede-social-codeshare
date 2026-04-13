<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'email', 'senha', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $beforeInsert = ['normalizeEmail', 'hashPassword'];
    protected $beforeUpdate = ['normalizeEmail', 'hashPassword'];

    public function normalizeEmail(array $data)
    {
        if (isset($data['data']['email'])) {
            $data['data']['email'] = strtolower(trim($data['data']['email']));
        }
        return $data;
    }

    public function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $senhaPura = trim($data['data']['senha']);

            if (!empty($senhaPura)) {
                $data['data']['senha'] = password_hash($senhaPura, PASSWORD_DEFAULT);
            }
        }
        return $data;
    }
}