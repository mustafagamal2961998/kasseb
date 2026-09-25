<?php

namespace App\Http\Resources\User\Category;

use App\Http\Resources\User\ChildCategory\ChildCategoryResource;
use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
            'name'=>$this->name,
            // 'name_en'=>$this->name_en,
            'description'=>$this->description,
            // 'description_en'=>$this->description_en,
            'status'=>$this->status,
            'media'=>$this->getFirstMediaUrl('category'),
            'products'=>ProductResource::collection($this->products),
            // 'childcategories'=>ChildCategoryResource::collection($this->childcategories),
        ];
    }
}
