<?php

namespace App\Services\User;

use App\Models\Attribute;
use App\Services\BaseService;

class AttributeService
{
    public function __construct()
    {
        $this->model = new Attribute();
    }

    public function getByIDs($ids)
    {
        return $this->model::query()->whereIn('id', $ids)->get()->keyBy('id');
    }
}
