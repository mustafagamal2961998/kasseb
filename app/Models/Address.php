<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address',
        'lat',
        'lng',
        // 'first_name',
        // 'last_name',
        // 'mobile',
        // 'other_mobile',
        // 'country_code',
        // 'city',
        // 'street',
        // 'build',
        // 'floor',
        // 'apartment',
        'status'
        // 'details'
    ];
}
