<?php

namespace App\Http\Controllers\User\Api\Slider;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Slider\SliderResource;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::where('status','active')->latest()->get();
        return response()->json([
            'data'=>SliderResource::collection($sliders),
            'statusCode'=>200,
        ]);
    }
}
