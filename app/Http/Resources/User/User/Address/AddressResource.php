<?php

namespace App\Http\Resources\User\User\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address'=>$this->address,

            // 'first_name'=>$this->first_name,
            // 'last_name'=>$this->last_name,
            // 'mobile'=>$this->mobile,
            // 'other_mobile'=>$this->other_mobile,
            // 'country_code'=>$this->country_code,
            // 'city'=>$this->city,
            // 'street'=>$this->street,
            // 'build'=>$this->build,
            // 'floor'=>$this->floor,
            // 'apartment'=>$this->apartment,

            'status'=>$this->status,
        ];
    }
}
