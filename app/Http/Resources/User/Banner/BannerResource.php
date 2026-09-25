<?php

namespace App\Http\Resources\User\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'brand_id'=>$this->brand_id,
            'order'=>$this->order,
            'media'=>$this->getFirstMediaUrl('banner'),
        ];
    }
}
