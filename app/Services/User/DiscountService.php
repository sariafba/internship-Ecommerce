<?php

namespace App\Services\User;

use App\Models\Discount;
use App\Services\BaseService;

class DiscountService extends BaseService
{
    public function __construct(Discount $model)
    {
        $this->model = $model;
    }



}
