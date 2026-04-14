<?php

namespace App\Controllers;

use App\Models\LikeModel;
use CodeIgniter\API\ResponseTrait;

class LikeController extends BaseController
{
    use ResponseTrait;

    public function toggle($postId)
    {
        $model = new LikeModel();
        $userId = session()->get('usuario_id');

        if (!$userId) {
            return $this->failUnauthorized('Você precisa estar logado.');
        }

        $like = $model->where([
            'postagem_id' => $postId,
            'usuario_id' => $userId
        ])->first();

        if ($like) {
            $model->delete($like['id']);
            $action = 'unliked';
        } else {
            $model->save([
                'postagem_id' => $postId,
                'usuario_id' => $userId
            ]);
            $action = 'liked';
        }

        $total = $model->where('postagem_id', $postId)->countAllResults();

        return $this->respond([
            'status' => 'success',
            'action' => $action,
            'total' => $total
        ]);
    }
}