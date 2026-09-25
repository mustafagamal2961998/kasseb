<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'coupon_id',
        'subtotal',
        'total',
    ];


    // start relationships
        public function user(){
            return $this->belongsTo(User::class,'user_id','id');
        }
        public function cartitems(){
            return $this->hasMany(Cartitem::class,'cart_id','id');
        }
        public function coupon(){
            return $this->belongsTo(Coupon::class,'coupon_id','id');
        }
    // end relationships
}
