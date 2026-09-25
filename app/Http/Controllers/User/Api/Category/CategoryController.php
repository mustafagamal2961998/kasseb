<?php

namespace App\Http\Controllers\User\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Category\CategoryResource;
use App\Http\Resources\User\Category\ShowCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::whereStatus('active')
                               ->whereNull('category_id')
                               ->with('media')
                               ->with([
                                    'children'=>fn($q)=>$q->whereStatus('active')
                                    ->with(['media','products'=>fn($q)=>$q->whereStatus('active')->with('media')
                                    ])
                               ])->latest()
                               ->get();
        return response()->json([
            'data'=>CategoryResource::collection($categories),
            'statusCode'=>200,
        ]);
    }

    public function show($id){
        $category = Category::with('media')
                 ->with(['children'=>fn($q)=>$q->whereStatus('active')
                    ->with([
                        'media','products'=>fn($q)=>$q->whereStatus('active')->with('media')
                    ])
                 ])
                ->find($id);
        return response()->json([
            'data'=>new CategoryResource($category),
            'statusCode'=>200,
        ]);
    }
}
