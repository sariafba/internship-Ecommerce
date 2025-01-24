<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseIndexController;
use App\Http\Requests\User\Product\ProductFilterRequest;
use App\Http\Requests\User\Product\ProductSearchFilterRequest;
use App\Services\User\ProductService;

class ProductController extends BaseIndexController
{
    public function __construct(ProductService $service)
    {
        $this->service = $service;

        $this->filterRequest = ProductFilterRequest::class;
    }

    public function search(ProductSearchFilterRequest $request)
    {
        $filter = $request->validated();

        $data = $this->service->search($filter);

        return $this->sendResponse(message:'search result', data:$data);
    }




}
