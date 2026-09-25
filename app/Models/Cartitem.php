<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'discount_rate',
        'price',
        'need_type',
        'total',
    ];

    
    // start relationships
        public function cart(){
            return $this->belongsTo(Cart::class,'cart_id','id');
        }
        public function product(){
            return $this->belongsTo(Product::class,'product_id','id');
        }
    // end relationships
}
