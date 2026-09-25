<?php

namespace App\Http\Controllers\User\Api\About;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\About\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $about = About::query()->first();
        return response()->json([
            'data'=>new AboutResource($about),
            'statusCode'=>200,
        ]);
    }
}
