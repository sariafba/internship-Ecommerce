<?php

namespace App\Services\User;

use App\Exceptions\NotFoundException;
use App\Http\Resources\User\Product\ProductCollection;
use App\Http\Resources\User\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\BaseService;

class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAll($filters = [])
    {
        if(isset($filters['category_id']))
            $filters['category_id'] =
                Category::descendantsOf($filters['category_id'])->pluck('id')->toArray();

        if(isset($filters['brand_id']))
            $filters['brand_id'] = [$filters['brand_id']];

        $data = $this->model::query();

        foreach ($filters as $key => $value)
            $data = $data->whereIn($key, $value);

        $data = $data->with(['productVariants.product.activeDiscounts', 'activeDiscounts', 'reviews', 'images'])->get();

        return new ProductCollection($data);
    }

    public function search($filters)
    {
        $data = $this->model::query()->with(['productVariants.product.activeDiscounts', 'activeDiscounts', 'images'])
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.*')) LIKE ?", ["%{$filters['q']}%"])
//            ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.*')) LIKE ?", ["%{$filters['q']}%"])
            ->get();

        return new ProductCollection($data);
    }

    public function getOne($id)
    {
        $object = $this->model::query()
            ->with(['productVariants.product.activeDiscounts', 'activeDiscounts', 'images', 'comments', 'reviews'])
            ->find($id);
        if (!$object) {
            throw new NotFoundException();
        }

        (new ProductVariantService())->configProductVariants($object->productVariants);

        return new ProductResource($object);
    }
}
