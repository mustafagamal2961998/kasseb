<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'brand_id',

        'name',
        // 'name_en',

        'slug',
        // 'slug_en',

        'description',
        // 'description_en',

        'unit_price',
        'box_price',
        
        'discount_rate',

        'unit_stock',
        'box_stock',

        'minimum_stock',
        'maximum_order',

        // 'package_type',
        'best_seller',
        'status',
    ];
    // Start global scope
        public function scopeSearch(Builder $builder,$query){
            $keyword = array_merge([
                'query' => null,
            ], $query);
        
            // Mapping Arabic statuses to English
            $statuses = [
                'مفعل' => 'active',
                'مؤرشف' => 'archived',
                'غير مفعل' => 'archived',
            ];
        
            $builder->when($keyword['query'], function (Builder $builder, $value) use ($statuses) {
                $translatedStatus = $statuses[$value] ?? $value; // Translate if exists
        
                $builder->where(function (Builder $query) use ($value, $translatedStatus) {
                    // Search in related 'category' name in current locale
                    $query->whereHas('category', function ($subQuery) use ($value) {
                        $subQuery->where('name', 'like', '%' . $value . '%');
                    });
        
                    // Search in 'name' field in current locale
                    $query->orWhere('name', 'like', '%' . $value . '%');
        
                    // Search in 'status' (with translated value)
                    $query->orWhere('status', 'like', '%' . $translatedStatus . '%');
                });
            });
        }
    // end global scope


    // start relationship
        public function category(){
            return $this->belongsTo(Category::class,'category_id','id')->withDefault();
        }
        public function carts(){
            return $this->hasMany(Cart::class,'product_id','id');
        }
        public function orderitems(){
            return $this->hasMany(Orderitem::class,'product_id','id');
        }
        public function brand(){
            return $this->belongsTo(Brand::class,'brand_id','id')->withDefault();
        }
        public function products(){
            return $this->hasMany(Product::class,'category_id','id');
        }
    // end relationship
    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('product');        
    }
  
}
