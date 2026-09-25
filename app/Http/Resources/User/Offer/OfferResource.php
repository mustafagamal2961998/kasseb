<?php

namespace App\Http\Resources\User\Offer;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'product'=>new ProductResource($this->product),
            
            'base_unit_price'=>$this->base_unit_price,
            'base_box_price'=>$this->base_box_price,
            'offer_unit_price'=>$this->offer_unit_price,
            'offer_box_price'=>$this->offer_box_price,

            'start_offer_date'=>$this->start_offer_date->format('Y-m-d'),
            'end_offer_date'=>$this->end_offer_date->format('Y-m-d'),
            'description'=>$this->description,
            'maximum'=>$this->maximum,
            // 'description_en'=>$this->description_en,
            'status'=>$this->status,
        ];
    }
}
