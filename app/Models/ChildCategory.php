<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ChildCategory extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'bg_color',
        'status',
    ];


    // Relations
        public function category()
        {
            return $this->belongsTo(Category::class);
        }   
        public function products(){
            return $this->hasMany(Product::class,'child_category_id','id');
        }
    // Relations

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('category');        
    }
}
