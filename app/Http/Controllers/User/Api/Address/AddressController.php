<?php

namespace App\Http\Controllers\User\Api\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\AddressRequest;
use App\Http\Resources\User\User\Address\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = User::with('addresses')->find(Auth::guard('sanctum')->id());
        return response()->json([
            'data'=>AddressResource::collection($addresses->addresses),
            'statusCode'=>200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        Address::create($request->all());
        return response()->json([
            'message'=>'تم حفظ العنوان الجديد بنجاح',
            'statusCode'=>200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::find($id);
        if(!$address){
            return response()->json([
                'message'=>'عفوا لا يوجد بيانات',
                'statusCode'=>422,
            ]);
        }
        return response()->json([
            'data'=>new AddressResource($address),
            'statusCode'=>200,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $update = Address::find($id);
        $update->update($request->all());
        return response()->json([
            'message'=>'تم تعديل العنوان بنجاح',
            'statusCode'=>200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Address::find($id);
        $delete->delete();
        return response()->json([
            'message'=>'تم حذف العنوان بنجاح',
            'statusCode'=>200,
        ]);
    }
}
