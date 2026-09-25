<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'full_name',
        'username',
        'password',
        'status'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('avatar');        
    }
}
