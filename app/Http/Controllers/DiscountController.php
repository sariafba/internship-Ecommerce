<?php

namespace App\Http\Controllers;

use App\Services\User\DiscountService;

class DiscountController extends BaseIndexController
{
    public function __construct(DiscountService $service)
    {
        $this->service = $service;
    }
}
