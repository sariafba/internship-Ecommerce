<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'amount',
        'total_price'
    ];


//    public function productVariant()
//    {
//        return $this->belongsTo(ProductVariant::class);
//    }

//    public function product()
//    {
//        return $this->hasOneThrough(
//            Product::class,   // The final model you want (Product)
//            ProductVariant::class,  // The intermediary model (ProductVariant)
//            'id',             // Foreign key on the ProductVariant table (Item's `product_variant_id`)
//            'id',             // Foreign key on the Product table (ProductVariant's `product_id`)
//            'product_variant_id',  // Local key on the Item table (the key linking to ProductVariant)
//            'product_id'      // Local key on the ProductVariant table (the key linking to Product)
//        );
//    }



}
