<?php

namespace App\Http\Controllers\User\Api\ChildCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ChildCategory\ChildCategoryResource;
use App\Models\ChildCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    
    public function show($id){
        $category = ChildCategory::with('products')->find($id);
        if(!$category){
            return response()->json(['message' => 'ChildCategory not found'], 404);
        }
        return response()->json(new ChildCategoryResource($category));
    }
}
