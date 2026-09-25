<?php

namespace App\Http\Resources\User\Order;

use App\Http\Resources\User\User\Address\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'coupon'=>$this->coupon->coupon,
            'address'=>new AddressResource($this->address),
            'number'=>$this->number,
            'payment_method'=>$this->payment_method,
            'status'=>$this->status,
            'created_at'=>$this->created_at->format('Y-m-d h:i a'),
            'updated_at'=>$this->updated_at->format('Y-m-d h:i a'),
            'total'=>$this->total,
            'note'=>$this->note,
            'user_full_name'=>$this->user->profile->full_name,
            'orderitems'=>OrderitemResource::collection($this->orderitems),
            // 'qr_code'=>$this->getFirstMediaUrl('qr_code'),

        ];
    }
}
