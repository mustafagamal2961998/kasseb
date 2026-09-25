<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'base_unit_price',
        'offer_unit_price',
        'base_box_price',
        'offer_box_price',
        'start_offer_date',
        'end_offer_date',
        'description',
        'maximum',
        // 'description_en',
        'status'
    ];

    // start relationships
        public function product(){
            return $this->belongsTo(Product::class,'product_id','id')->withDefault();
        }
    // end relationships
    protected $casts = [
        'start_offer_date'=>'datetime',
        'end_offer_date'=>'datetime',
    ];
}
