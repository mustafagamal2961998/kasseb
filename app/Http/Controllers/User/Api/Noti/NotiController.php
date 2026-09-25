<?php

namespace App\Http\Controllers\User\Api\Noti;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Favorite\FavoriteRequest;
use App\Http\Resources\User\Noti\NotiResource;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userFavorites = Notification::latest()->get();
        return response()->json([
            'data'=>NotiResource::collection($userFavorites),
            'statusCode'=>200,
        ]);
    }

    
}
