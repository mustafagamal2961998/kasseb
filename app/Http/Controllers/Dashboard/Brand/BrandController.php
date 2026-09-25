<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Brand\BrandRequesat;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::latest()->search($request->query())->paginate(50);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.Brand.Partials.brand', compact('brands'))->render(),
            ]);
        }
        return view('Dashboard.Brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand();
        return view('Dashboard.Brand.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequesat $request)
    {
        $store = Brand::create($request->all());
        if($request->hasFile('image')){
            $store->addMedia($request->file('image'))
                  ->toMediaCollection('brand');
        }
        return redirect()->route('dashboard.brands.index')->with('success','تم إضافة الماركة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::with('products')->find($id);
        $products = $brand->products()->paginate(10);
        return view('Dashboard.Brand.show',compact('brand','products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        return view('Dashboard.Brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Brand::find($id);
        $update->update($request->all());
        if($request->hasFile('image')){
            $update->clearMediaCollection('brand');
            $update->addMedia($request->file('image'))
                  ->toMediaCollection('brand');
        }
         return redirect()->route('dashboard.brands.index')->with('success','تم تعديل الماركة بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()
        ->route('dashboard.brands.index')->with('success','تم حذف الماركة بنجاح');
    }
}
