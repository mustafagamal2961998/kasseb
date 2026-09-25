<?php

namespace App\Http\Controllers\Dashboard\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Offer\OfferRequest;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::latest()->paginate(50);
        return view('Dashboard.Offer.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $offer = new Offer();
        return view('Dashboard.Offer.create',compact('offer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        // إنشاء العرض
        $offer = Offer::create($request->validated());

        // تحديث سعر المنتج بعد نجاح الفاليديشن
        $product = Product::findOrFail($request->product_id);
        $product->update([
            'user_price' => $request->offer_user_price,
        ]);

        return redirect()
            ->route('dashboard.offers.index')
            ->with('success', 'تم إضافة العرض بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::with('product')->find($id);
        return view('Dashboard.Offer.show',compact('offer'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offer = Offer::with('product')->find($id);
        return view('Dashboard.Offer.edit',compact('offer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, string $id)
    {
        $update = Offer::find($id);
        $update->update($request->all());
        return redirect()->route('dashboard.offers.index')->with('success','تم تعديل العرض بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Offer::find($id);
        $delete->product->update([
            'unit_price' => $delete->base_unit_price,
            'box_price' => $delete->base_box_price,
         ]);
        $delete->delete();
        return redirect()->route('dashboard.offers.index')->with('success','تم حذف العرض بنجاح');

    }

    public function cancel($id){
         $offer = Offer::find($id);
         $offer->product->update([
            'unit_price' => $offer->base_unit_price,
            'box_price' => $offer->base_box_price,
         ]);
         $offer->update(['status' => 'archived']);
         return redirect()->route('dashboard.offers.index')->with('success','تم الغاء العرض بنجاح');
    }
}
