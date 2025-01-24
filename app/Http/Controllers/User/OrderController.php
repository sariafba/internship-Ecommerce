<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Requests\User\Order\OrderStoreRequest;
use App\Services\User\OrderService;

class OrderController extends BaseCRUDController
{
    public function __construct(OrderService $service)
    {
        $this->service = $service;
        $this->createRequest = OrderStoreRequest::class;
    }

}
