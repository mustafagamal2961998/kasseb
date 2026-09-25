<?php

namespace App\Http\Controllers\User\Api\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Banner\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $firstRow = Banner::whereOrder('1')->latest()->get();
        $SecondRow = Banner::whereOrder('2')->latest()->get();
        $ThreedRow = Banner::whereOrder('3')->latest()->get();

        return response()->json([
            'firstRow'=>BannerResource::collection($firstRow),
            'SecondRow'=>BannerResource::collection($SecondRow),
            'ThreedRow'=>BannerResource::collection($ThreedRow),
            'statusCode'=>200,
        ]); 
    }
}
