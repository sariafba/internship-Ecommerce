<?php

namespace App\Services\User;

use App\Models\AttributeValue;

class AttributeValueService
{
    public function __construct()
    {
        $this->model = new AttributeValue();
    }

    public function getByIDs($ids)
    {
        return $this->model::query()->whereIn('id', $ids)->get()->keyBy('id');
    }
}
