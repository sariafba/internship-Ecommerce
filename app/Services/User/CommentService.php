<?php

namespace App\Services\User;

use App\Exceptions\CustomExceptionWithMessage;
use App\Http\Resources\User\Comment\CommentResource;
use App\Models\Comment;
use App\Services\BaseService;

class CommentService extends BaseService
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $user = auth('users')->user();

        $data['user_id'] = $user->id;

        return new CommentResource(parent::create($data));
    }

    public function update($id, $data)
    {
        $user = auth('users')->user();

        $comment = $user->comments()->where('id', $id)->first();

        if (!$comment)
            throw new CustomExceptionWithMessage('not your comment');

        else
        {
            $comment->update($data);
            return new CommentResource($comment);
        }
    }

    public function delete($id)
    {
        $user = auth('users')->user();

        $comment = $user->comments()->where('id', $id)->first();

        if(!$comment)
            throw new CustomExceptionWithMessage('not your comment');

        else
        {
            $comment->delete();

            return true;
        }
    }


}
