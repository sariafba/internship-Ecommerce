<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'type',
        'end_at'
    ];
}
