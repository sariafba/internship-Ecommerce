<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseIndexController extends Controller
{
    protected $service;
    protected $filterRequest;

    protected function index(Request $request)
    {
        $filters = $this->filterRequest ? app($this->filterRequest)->validated() : [];
        $res = $this->service->getAll($filters);
        return $this->sendResponse(data: $res, message: __('custom.Success'));
    }

    protected function get_one($id)
    {
        $res = $this->service->getOne($id);
        return $this->sendResponse(data: $res, message: __('custom.Success'));
    }
}
