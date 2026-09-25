<?php

namespace App\Http\Resources\User\Favorite;

use App\Http\Resources\User\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'product_id'=>$this->product_id,
            'product'=>new ProductResource($this->product),
        ];
    }
}
