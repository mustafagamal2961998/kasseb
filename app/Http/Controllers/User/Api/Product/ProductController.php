<?php

namespace App\Http\Controllers\User\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::whereStatus('active')->with('media')->latest()->get();
        return response()->json([
            'data'=>ProductResource::collection($products),
            'statusCode'=>200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('media')->find($id);
        if(!$product){
            return response()->json([
                'message'=>'عفوا لا يوجد بيانات',
                'statusCode'=>422,
            ]);
        }
        return response()->json([
            'data'=>new ProductResource($product),
            'statusCode'=>200,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
