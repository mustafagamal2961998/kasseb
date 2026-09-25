<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'description_ar',
        'description_en',
        'status',
    ];

    // start relationship
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->withDefault([
            'name_' . config('app.locale')=>'-',
        ]);
    }
    // end relationship
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('slider');        
    }
  
}
