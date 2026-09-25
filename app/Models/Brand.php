<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model  implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'name',
        // 'name_en',
    ];


    // Relationships
    public function products(){
        return $this->hasMany(Product::class,'brand_id','id');
    }

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
        $this->addMediaCollection('brand');        
    }
}
