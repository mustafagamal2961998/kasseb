<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Banner extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'order',
        'brand_id',
    ];
    
    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault([
            'name'=>'-']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('banner');        
    }
    
}
