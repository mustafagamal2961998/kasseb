<?php

namespace App\Http\Resources\User\Order;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRefundResource extends JsonResource
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
            // "product_name"=>$this->product_name,
            // "product_name_en"=>$this->product_name_en,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'total'=>$this->total,
            'status'=>$this->status,
            'redund_orderitems'=>OrderRefundOrderitemResource::collection($this->orderitems),
        ];
    }
}
