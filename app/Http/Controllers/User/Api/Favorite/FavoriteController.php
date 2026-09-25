<?php

namespace App\Http\Controllers\User\Api\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Favorite\FavoriteRequest;
use App\Http\Resources\User\Favorite\FavoriteResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userFavorites = User::with('favorites')->find(Auth::guard('sanctum')->id());
        return response()->json([
            'data'=>FavoriteResource::collection($userFavorites->favorites),
            'statusCode'=>200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoriteRequest $request)
    {
        $checkIfExist = Favorite::where('product_id',$request->product_id)->where('user_id',Auth::guard('sanctum')->id())->first();
        if($checkIfExist){
            $checkIfExist->delete();
            return response()->json([
                'message'=>'تم حذف المنتج من المفضلة بنجاح',
                'statusCode'=>200,
            ]);
        }else{
            Favorite::create([
                'product_id'=>$request->product_id,
                'user_id'=>Auth::id(),
            ]);
            return response()->json([
                'message'=>'تم إضافة المنتج الي المفضلة بنجاح',
                'statusCode'=>200,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FavoriteRequest $request, string $id)
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
