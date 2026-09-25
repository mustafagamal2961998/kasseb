<?php

namespace App\Http\Resources\User\Coupon;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'coupon'=>$this->coupon,
            'discount_percentage'=>$this->discount_percentage,
            'start_date_time'=>$this->start_date_time->format('Y-m-d H:i a'),
            'end_date_time'=>$this->end_date_time->format('Y-m-d H:i a')
        ];
    }
}
