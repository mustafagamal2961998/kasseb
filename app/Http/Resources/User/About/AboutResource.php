<?php

namespace App\Http\Resources\User\About;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
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
            'content_ar'=>$this->content_ar,
            'content_en'=>$this->content_en,
            'created_at'=>$this->created_at->format('Y-m-d H:i a'),
            'updated_at'=>$this->updated_at->format('Y-m-d H:i a')
        ];
    }
}
