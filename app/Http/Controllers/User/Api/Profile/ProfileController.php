<?php

namespace App\Http\Controllers\User\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\ProfileRequest;
use App\Http\Resources\User\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('media')->find(Auth::guard('sanctum')->id());
        return response()->json([
            'data'=>new UserResource($user),
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $user = User::find(Auth::guard('sanctum')->id());
        if(!Hash::check($request->password,$user->password)){
            return response()->json([
                'message'=>'عفوا كلمة المرور خطأ',
                'statusCode'=>422,
            ]);
        }
        if($request->hasFile('avatar')){
            $user->clearMediaCollection('avatar');
            $user->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }
        
        $user->update($request->all());
        $user->profile->update($request->all());
        return response()->json([
            'message'=>'تم تعديل بياناتك بنجاح',
            'statusCode'=>200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
