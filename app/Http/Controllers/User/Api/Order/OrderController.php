<?php

namespace App\Http\Controllers\User\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Order\OrderRefundResource;
use App\Http\Resources\User\Order\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUserOrders = User::with(['orders'=>fn($q)=>$q->latest()->with('orderitems')])->find(Auth::guard('sanctum')->id());
        return response()->json([
            'data'=>OrderResource::collection($authUserOrders->orders),
            'statusCode'=>200,
        ]);
    }

    public function getAll(){
        
        $getAll = Order::with('orderitems','user')->latest()->get();
           return response()->json([
            'data'=>OrderResource::collection($getAll),
            'statusCode'=>200,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $getOrder = Order::find($id);
        $getOrder->status = $request->status;
        $getOrder->orderitems()
               ->update(['status' => $request->status]);

        $getOrder->save();
        return response()->json([
            'message'=>'تم تعديل حالة الطلب بنجاح',
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
