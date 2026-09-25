<?php

namespace App\Http\Controllers\User\Api\Offer;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Offer\OfferResource;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index(){
        $offers = Offer::where('status','active')->with('product')->latest()->get();
        return response()->json([
            'data'=>OfferResource::collection($offers),
            'statusCode'=>200,
        ]);
    }


}
