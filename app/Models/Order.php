<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'name',
        'phone',
        'address',
        'total_price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = [

    ];

    /**
     * relations
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
