<?php

namespace App\Http\Resources\User\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'website_name_ar'=>$this->website_name_ar,
            'website_name_en'=>$this->website_name_en,
            'website_bio_ar'=>$this->website_bio_ar,
            'website_bio_en'=>$this->website_bio_en,
            'delivery_status'=>$this->delivery_status,
            'refund_day'=>$this->refund_day,
            'minimum_order_price'=>$this->minimum_order_price,
            'shipping_amount'=>$this->shipping_amount,
            'logo'=>$this->getFirstMediaUrl('logo')
        ];
    }
}
