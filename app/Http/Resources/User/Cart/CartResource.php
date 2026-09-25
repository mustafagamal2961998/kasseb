<?php

namespace App\Http\Resources\User\Cart;

use App\Http\Resources\User\Coupon\CouponResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'coupon'=>new CouponResource($this->coupon),
            'total'=>$this->total,
            'cartitems'=>CartItemResource::collection($this->cartitems),
            'created_at'=>$this->created_at->format('Y-m-d H:i a'),
            'updated_at'=>$this->updated_at->format('Y-m-d H:i a')
        ];
    }
}
