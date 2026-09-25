<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'coupon',
        'discount_percentage',
        'start_date_time',
        'end_date_time',
        'status',
    ];



    protected $casts = [
        'start_date_time'=>'datetime',
        'end_date_time'=>'datetime',
    ];
}
