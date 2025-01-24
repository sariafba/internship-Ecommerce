<?php

namespace App\Services\User;

use App\Http\Resources\User\CityResource;
use App\Models\City;
use App\Services\BaseService;

class CityService extends BaseService
{

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [])
    {
        $cities = parent::getAll($filters);

        return CityResource::collection($cities);
    }


}
