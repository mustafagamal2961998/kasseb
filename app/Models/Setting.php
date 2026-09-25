<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $fillable = [
        'website_name_ar',
        'website_name_en',
        'website_bio_ar',
        'website_bio_en',
        'delivery_status',
        'refund_day',
        'minimum_order_price',
        'shipping_amount',
        // 'main_bg_color',
        // 'main_color_text',
        // 'main_bg_color_on_hover',
        // 'main_color_text_on_hover',
        // 'main_color_text_without_bg',
        // 'main_link_color_text',
        // 'main_link_color_text_on_hover',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('logo');        
    }

}
