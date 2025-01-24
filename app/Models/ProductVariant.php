<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute()
    {
        $discount = $this->product->activeDiscounts->first();

        if($discount)
        {
            if($discount->type === 'percent')
                return [
                    'original_price' => $this->attributes['price'],
                    'price_after_discount' =>
                        $this->attributes['price'] - (($this->attributes['price'] * $discount->value) / 100),
                ];
            else if($discount->type === 'subtraction')
                return [
                    'original_price' => $this->attributes['price'],
                    'price_after_discount' =>
                        $this->attributes['price'] - $discount->value,
                ];
        }

        return $this->attributes['price'];
//        return number_format($this->attributes['price'], 2, '.', ',');
    }

    public function getPriceInItem($discount, $item)
    {
        $price_after_discount = $item->total_price / $item->amount;

        if($discount->type === 'percent')
            return [
                'original_price' => $price_after_discount / (1 - ($discount->value / 100)),
                'price_after_discount' => $price_after_discount,
            ];
        else if($discount->type === 'subtraction')
            return [
                'original_price' => $price_after_discount + $discount->value,
                'price_after_discount' => $price_after_discount
            ];
    }
}
