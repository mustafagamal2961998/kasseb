<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        // 'product_name_en',
        'price',
        'discount_rate',
        'quantity',
        'need_type',
        'total',
        'status',
    ];


    // start relationships
        public function order(){
            return $this->belongsTo(Order::class,'order_id','id');
        }
        public function product(){
            return $this->belongsTo(Product::class,'product_id','id');
        }
    // end relationships
}
