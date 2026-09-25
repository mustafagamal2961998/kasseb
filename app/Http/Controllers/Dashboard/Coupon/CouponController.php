<?php

namespace App\Http\Controllers\Dashboard\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Coupon\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('Dashboard.Coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon();
        return view('Dashboard.Coupon.create',compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        Coupon::create($request->all());
        return redirect()->route('dashboard.coupons.index')->with('success','تم إضافة قسيمة الخصم');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('Dashboard.Coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Coupon::find($id);
        $update->update($request->all());
        return redirect()->route('dashboard.coupons.index')->with('success','تم تعديل قسيمة الخصم');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Coupon::find($id);
        $delete->delete();
        return redirect()->route('dashboard.coupons.index')->with('success','تم حذف قسيمة الخصم');
    }
}
