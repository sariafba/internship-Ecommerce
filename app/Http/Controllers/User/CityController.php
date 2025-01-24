<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseCRUDController;
use App\Services\User\CityService;

class CityController extends BaseCRUDController
{
    protected $service;

    public function __construct(CityService $service)
    {
        $this->service = $service;
    }

}
