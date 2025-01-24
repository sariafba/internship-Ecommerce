<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Requests\User\Review\ReviewStoreRequest;
use App\Models\Review;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends BaseCRUDController
{
    public function __construct(ReviewService $service)
    {
        $this->service = $service;

        $this->createRequest = ReviewStoreRequest::class;
    }
}
