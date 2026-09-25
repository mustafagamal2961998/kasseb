<?php

namespace App\Http\Resources\User\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'sub_categories'=>SubCategoryResource::collection($this->children),
        ];
    }
}
