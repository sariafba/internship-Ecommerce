<?php

namespace App\Services\User;

use App\Models\Brand;
use App\Services\BaseService;

class BrandService extends BaseService
{
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }
}
