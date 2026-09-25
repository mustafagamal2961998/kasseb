<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'orderitem_id',
        'note',
        'payment_method',
        'status',
    ];


      // Start global scope
        public function scopeSearch(Builder $builder, $query)
        {
            // Set default 'query' value to null if it's not passed in the $query array
            $keyword = array_merge([
                'query' => null,
            ], $query);
        
            // Apply filtering if 'query' is provided
            $builder->when($keyword['query'], function (Builder $builder, $value) {
                // Use a single whereHas with a nested orWhere condition to filter by 'order.number' or 'user.profile.full_name'
                $builder->where(function (Builder $query) use ($value) {
                    $query->whereHas('order', function ($subQuery) use ($value) {
                        $subQuery->where('number', 'like', '%' . $value . '%');
                    })
                    ->orWhereHas('order.user.profile', function ($subQuery) use ($value) {
                        $subQuery->where('full_name', 'like', '%' . $value . '%');
                    });
                });
            });
        }
        // end global scope


      // start relationships
        public function user(){
            return $this->belongsTo(User::class,'user_id','id');
        }
        public function order(){
            return $this->belongsTo(Order::class,'order_id','id');
        }
        public function orderitem(){
            return $this->belongsTo(Orderitem::class,'orderitem_id','id');
        }
     // end relationships
}
