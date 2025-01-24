<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'name',
        'description'
    ];

    protected $with = [

    ];

    /**
     * relations
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'products_has_attributes');
    }

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)
            ->orderBy('price', 'asc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'images', 'imageable_type', 'imageable_id');
    }

    /**
     * Discount
     */
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'products_has_discounts');
    }
    public function activeDiscounts()
    {
        return $this->belongsToMany(Discount::class, 'products_has_discounts')
            ->whereDate('start_at', '<=', now())
            ->whereDate('end_at', '>', now());
    }

    public function discountInTime($time)
    {
        return $this
            ->discounts()
            ->whereDate('start_at', '<=', $time)
            ->whereDate('end_at', '>=', $time)
            ->first();
    }
}
