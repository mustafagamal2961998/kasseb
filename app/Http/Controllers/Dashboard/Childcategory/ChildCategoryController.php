<?php

namespace App\Http\Controllers\Dashboard\Childcategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChildCategory\ChildCategoryRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ChildCategory::with('media')->withCount('products')->latest()->paginate(10);
        return view('Dashboard.ChildCategory.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new ChildCategory();
        $parents = Category::whereNotNull('category_id')->latest()->get();
        return view('Dashboard.ChildCategory.create',compact('category','parents'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChildCategoryRequest $request)
    {
        $store = ChildCategory::create($request->all());
        if($request->hasFile('image')){
            $store->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.childcategories.index')->with('success','تم إضافة التصنيف الدنيا بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = ChildCategory::with('products')->find($id);
        $products = $category->products()->paginate(10);
        return view('Dashboard.ChildCategory.show',compact('category','products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ChildCategory::find($id);
        $parents = Category::whereNotNull('category_id')->latest()->get();
        return view('Dashboard.ChildCategory.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryRequest $request, string $id)
    {
        $update = ChildCategory::find($id);
        $update->update($request->all());
        if($request->hasFile('image')){
            $update->clearMediaCollection('category');
            $update->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.childcategories.index')->with('success','تم تعديل التصنيف الدنيا بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = ChildCategory::find($id);
        $delete->clearMediaCollection('category');
        $delete->delete();
        return redirect()->route('dashboard.childcategories.index')->with('success','تم حذف التصنيف الدنيا بنجاح');
    }
}
