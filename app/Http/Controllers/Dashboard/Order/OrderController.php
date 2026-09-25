<?php

namespace App\Http\Controllers\Dashboard\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Order\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
 
        $orders = Order::with('coupon','media')
                            ->search($request->query())
                            ->withCount('orderitems')
                            // ->withCount('orderitemscancelled')
                            // ->withCount('orderitemscompleted')
                            ->withCount('orderitemsrefunded')
                            ->with('user.profile')
                            ->latest()
                            ->paginate(10);

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('Dashboard.Order.Partials.orders', compact('orders'))->render(),
                ]);
            }

        return view('Dashboard.Order.index',compact('orders'));
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
        $order = Order::with('orderitems.product.category')->find($id);
        return view('Dashboard.Order.show',compact('order'));
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
    public function update(OrderRequest $request, string $id)
    {
        $update = Order::with('orderitems')->find($id);
        $update->update([
            'status'=>$request->status
        ]);
        $update->orderitems()
               ->whereNotIn('status', ['refund', 'refunded'])
               ->update(['status' => $request->status]);
        return redirect()->back()->with('success','تم تعديل حالة الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
