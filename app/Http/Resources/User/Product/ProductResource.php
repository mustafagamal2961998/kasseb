<?php

namespace App\Http\Resources\User\Product;

use App\Http\Resources\User\Brand\BrandResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        

        return[
            'id'=>$this->id,
            'name'=>$this->name,
            // 'name_en'=>$this->name_en,
            'description'=>$this->description,
            // 'description_en'=>$this->description_en,
            'category_name'=>$this->category->name,
            // [
            //     'name_ar'=>$this->category->name_ar,
            //     'name_en'=>$this->category->name_en
            // ],
            'unit_price'=>$this->unit_price,
            'box_price'=>$this->box_price,
            'unit_stock'=>$this->unit_stock,
            'box_stock'=>$this->box_stock,
            'maximum_order'=>$this->maximum_order,

            'discount_rate'=>$this->discount_rate,
            // 'package_type'=>$this->package_type,
            'best_seller'=>$this->best_seller,
            'brand'=>new BrandResource($this->brand),
            'images' => $this->getMedia('product')->map(function ($media) {
                return $media->getUrl(); // Return image URL
            }),
        ];
    }
}
