<?php

namespace App\Http\Resources\User\Cart;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'quantity'=>$this->quantity,
            'discount_rate'=>$this->discount_rate,
            'price'=>$this->price,
            'need_type'=>$this->need_type,
            'total'=>$this->total,
            'products'=>new ProductResource($this->product),
        ];
    }
}
