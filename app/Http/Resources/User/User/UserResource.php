<?php

namespace App\Http\Resources\User\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone'=>$this->phone,
            'balance'=>$this->balance,
            'full_name'=>$this->profile->full_name,
            'role'=>$this->role,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'updated_at'=>$this->updated_at->format('Y-m-d'),
            'status'=>$this->status,    
            'avatar'=>$this->getFirstMediaUrl('avatar'),  
        ];

    }
}
