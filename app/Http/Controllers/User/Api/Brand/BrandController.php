<?php

namespace App\Http\Controllers\User\Api\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Brand\BrandResource;
use App\Http\Resources\User\Brand\ShowBrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest()->get();
        return response()->json(BrandResource::collection($brands));
    }

    public function show($id){
        $brand = Brand::with(['products'=>fn($q)=>$q->where('status','active')])->find($id);
        return response()->json(new ShowBrandResource($brand));
    }
}
