<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\comment\CommentStoreRequest;
use App\Http\Requests\User\comment\CommentUpdateRequest;
use App\Services\User\CommentService;

class CommentController extends BaseCRUDController
{
    public function __construct(CommentService $service)
    {
        $this->service = $service;

        $this->createRequest = CommentStoreRequest::class;
        $this->updateRequest = CommentUpdateRequest::class;
    }

}
