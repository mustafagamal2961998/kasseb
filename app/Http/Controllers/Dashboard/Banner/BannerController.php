<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Banner\BannerRequest;
use App\Models\Banner;
use App\Models\Brand;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('Dashboard.Banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banner = new Banner();
        $brands = Brand::latest()->get();
        return view('Dashboard.Banner.create',compact('banner','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $banner = Banner::create([
            'brand_id'=>$request->brand_id,
            'order'=>$request->order,
        ]);
        if($request->hasFile('banner')){
            $banner->addMedia($request->file('banner'))
                    ->toMediaCollection('banner');
        }
        return redirect()->route('dashboard.banners.index')->with('success','تم إضافة بانر بنجاح');
        
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
        $banner = Banner::with('media')->findOrFail($id);
        $brands = Brand::latest()->get();
        return view('Dashboard.Banner.edit',compact('banner','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'brand_id'=>$request->brand_id,
            'order'=>$request->order
        ]);
        if($request->hasFile('banner')){
            $banner->clearMediaCollection('banner');
            $banner->addMedia($request->file('banner'))
                    ->toMediaCollection('banner');
        }
        return redirect()->route('dashboard.banners.index')->with('success','تم تعديل البانر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->clearMediaCollection('banner');
        $banner->delete();
        return redirect()->route('dashboard.banners.index')->with('success','تم حذف البانر بنجاح');
    }
}
