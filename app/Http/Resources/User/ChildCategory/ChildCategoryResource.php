<?php

namespace App\Http\Resources\User\ChildCategory;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildCategoryResource extends JsonResource
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
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'description_ar'=>$this->description_ar,
            'description_en'=>$this->description_en,
            'status'=>$this->status,
            'media'=>$this->getFirstMediaUrl('category'),
            'products'=>ProductResource::collection($this->products),
        ];
    }
}
