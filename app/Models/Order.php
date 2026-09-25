<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Order extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'user_id',
        'coupon_id',
        'address_id',
        'number',
        'total',
        'subtotal',
        'note',
        'date_of_receipt',
        'from_balance',
        // 'type',
        'status',
    ];



    // Start global scope
        protected static function booted()
        {
            static::creating(function(Order $order){
                $order->number = Order::getNextOrderNumber();
            }); 
        }
        public function scopeSearch(Builder $builder,$query){
            $keyword = array_merge([
                'query'=>null,
                'statuses' => [], // Expecting an array of selected statuses
            ],$query);
            $statuses = [
                'قيد المراجعة' => 'pending',
                'في التعباءه' => 'packed',
                'تم الشحن' => 'shipped',
                'في التوصيل' => 'in_delivery',
                'تم الاستلام' => 'received',
                'ملغي' => 'cancelled',
                'ملغي بالكامل' => 'cancelled',
                'مرتجع' => 'refunded',
                'مرتجع بالكامل' => 'refunded',
                'مكتمل' => 'completed',
            ];
            // Filter by multiple statuses
            $builder->when(!empty($keyword['status']), function (Builder $builder) use ($keyword, $statuses) {
                $translatedStatuses = collect($keyword['status'])->map(function ($status) use ($statuses) {
                    return $statuses[$status] ?? $status; // Map Arabic status to English if it exists
                })->toArray();

                $builder->whereIn('status', $translatedStatuses); // Filter orders by multiple statuses
            });

            $builder->when($keyword['query'], function (Builder $builder, $value)  use ($statuses) {
                $translatedStatus = $statuses[$value] ?? $value; // Translate if exists

                $builder->where(function (Builder $query) use ($value,$translatedStatus) {
                    // Search in related user profile full name
                    $query->whereHas('user.profile', function ($subQuery) use ($value) {
                        $subQuery->where('full_name', 'like', '%' . $value . '%');
                    });
        
                    // Search in "number" field of the main model
                    $query->orWhere('number', 'like', '%' . $value . '%');
        
                    // Additional search fields (optional)
                    $query->orWhere('status', 'like', '%' . $translatedStatus . '%');
                });
            });
        }
        
    // end global scope


   // start relationships
        public function user(){
            return $this->belongsTo(User::class,'user_id','id')->withDefault();
        }
        public function coupon(){
            return $this->belongsTo(Coupon::class,'coupon_id','id')->withDefault([
                'coupon'=>'فارغ',
            ]);
        }
        public function address(){
            return $this->belongsTo(Address::class,'address_id','id');
        }
        public function orderitems(){
            return $this->hasMany(Orderitem::class,'order_id','id');
        }
        public function orderitemscancelled(){
            return $this->hasMany(Orderitem::class,'order_id','id')->where('status','cancelled');
        }
        public function orderitemscompleted(){
            return $this->hasMany(Orderitem::class,'order_id','id')->where('status','completed');
        }
        public function orderitemsrefunded(){
            return $this->hasMany(Orderitem::class,'order_id','id')->where('status','refunded');
        }

        // // for get user refund order item
        // public function orderitemsrefund(){
        //     return $this->hasMany(Orderitem::class,'order_id','id')->whereIn('status',['refunded','refund']);
        // }
    // end relationships

    public static function getNextOrderNumber(){
        $year = Carbon::now()->year; //2024

        $number = Order::whereYear('created_at', $year)->max('number');
        if($number){
            return $number +1;
        }   
        
        return $year . '0001';
    }

    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('qr_code');        
    }
}
