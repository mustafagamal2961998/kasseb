<?php

namespace App\Http\Resources\User\Slider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'category_id'=>$this->category_id,
            'description_ar'=>$this->description_ar,
            'description_en'=>$this->description_en,
            'status'=>$this->status,
            'media'=>$this->getFirstMediaUrl('slider'),
        ];

    }
}
