<?php

namespace App\Services\User;

use App\Http\Resources\User\Category\CategoryCollection;
use App\Http\Resources\User\Category\CategoryResource;
use App\Models\Category;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [])
    {
        $mainCategories = Category::withDepth()->having('depth', '=', 0)->get();

        return new CategoryCollection($mainCategories);
    }

    public function getOne($id)
    {
        $object = parent::getOne($id);

        return new CategoryResource($object);
    }
}
