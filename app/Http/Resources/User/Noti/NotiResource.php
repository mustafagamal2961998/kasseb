<?php

namespace App\Http\Resources\User\Noti;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotiResource extends JsonResource
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
            'message'=>$this->message,
            'media'=>$this->getFirstMediaUrl('notification'),
            'created_at'=>$this->created_at->format('Y-m-d'),
        ];
    }
}
