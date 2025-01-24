<?php

namespace App\Http\Resources\User\Product;

use App\Http\Resources\User\BrandResource;
use App\Http\Resources\User\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') ?: '';

        $user = auth('users')->user();

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
            'description' => $this->getTranslation('description', $lang),
            'images' => $this->relationLoaded('images') ? $this->images->pluck('url') : null,
            'rating' => $this->relationLoaded('reviews') ? (float) $this->reviews()->avg('rate') : null,
            'my_rate' => $user?->reviews()->where('product_id', $this->id)->first()?->rate,
            'discounts' => $this->relationLoaded('activeDiscounts')
                ? new DiscountResource($this->activeDiscounts->first())
                : null,            'product_variants' => $this->relationLoaded('productVariants')
                ? ProductVariantResource::collection($this->productVariants)
                : null,
            'brand' => $this->relationLoaded('brand')
                ? new BrandResource($this->brand)
                : null,
            'category' => $this->relationLoaded('category')
                ? new ProductCategoryResource($this->category)
                : null,
            'comment' => $this->relationLoaded('comments')
                ? CommentResource::collection($this->comments)
                : null,
        ];
    }
}
