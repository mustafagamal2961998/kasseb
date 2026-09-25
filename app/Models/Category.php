<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    
    protected $fillable = [
        'category_id',
        'name',
        // 'name_en',
        'description',
        // 'description_en',
        'bg_color',
        'status',
    ];

    // start relationship
        public function children(){
            return $this->hasMany(Category::class,'category_id','id');
        }
        public function parent(){
            return $this->belongsTo(Category::class,'category_id','id')->withDefault([
                'name'=>'-',
                // 'name_en'=>'-'
            ]);
        }
        public function products(){
            return $this->hasMany(Product::class,'category_id','id');
        }
        // public function childcategories(){
        //     return $this->hasMany(ChildCategory::class,'category_id','id');
        // }
    // end relationship

    
     // Start global scope
        public function scopeSearch(Builder $builder,$query){
            $keyword = array_merge([
                'query' => null,
            ], $query);
        
            $builder->when($keyword['query'], function (Builder $builder, $value){
                $builder->where('name', 'like', '%' . $value . '%');
            });
        }
    // end global scope


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('category');        
    }
}
