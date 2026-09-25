<?php

namespace App\Http\Controllers\Dashboard\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Slider\SliderRequest;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::with('media')->latest()->paginate(10);
        return view('Dashboard.Slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slider = new Slider();
        $categories = Category::where('category_id','<>',null)->latest()->get();
        return view('Dashboard.Slider.create',compact('slider','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $store = Slider::create($request->all());
        if($request->hasFile('slider')){
            $store->addMedia($request->file('slider'))
                  ->toMediaCollection('slider');
        }
        return redirect()->route('dashboard.sliders.index')->with('success','تم إضافة السلايد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = Slider::with('media','category')->find($id);
        return view('Dashboard.Slider.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::with('media')->find($id);
        $categories = Category::latest()->get();
        return view('Dashboard.Slider.edit',compact('slider','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Slider::find($id);
        $update->update($request->all());
        if($request->hasFile('slider')){
            $update->clearMediaCollection('slider');
            $update->addMedia($request->file('slider'))
                  ->toMediaCollection('slider');
        }
        return redirect()->route('dashboard.sliders.index')->with('success','تم تعديل السلايد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Slider::find($id);
        $delete->clearMediaCollection('slider');
        $delete->delete();
        return redirect()->route('dashboard.sliders.index')->with('success','تم حذف السلايد بنجاح');

    }
}
