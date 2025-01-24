<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseIndexController;
use App\Services\User\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseIndexController
{
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }


}
