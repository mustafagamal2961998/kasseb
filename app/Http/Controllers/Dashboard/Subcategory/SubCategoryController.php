<?php

namespace App\Http\Controllers\Dashboard\Subcategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SubCategory\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::whereNotNull('category_id')
                                ->search($request->query())
                                ->with('media')
                                ->latest()
                                ->paginate(50);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.SubCategory.Partials.subcategory', compact('categories'))->render(),
            ]);
        }
        return view('Dashboard.SubCategory.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $parents = Category::whereNull('category_id')->latest()->get();
        return view('Dashboard.SubCategory.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $store = Category::create($request->all());
        if($request->hasFile('image')){
            $store->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.subcategories.index')->with('success','تم إضافة التصنيف الفرعي بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        $products = $category->products()->paginate(50); // $category
        return view('Dashboard.SubCategory.show',compact('category','products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $parents = Category::whereNull('category_id')->where('id','<>',$id)->latest()->get();
        return view('Dashboard.SubCategory.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id)
    {
        $update = Category::find($id);
        $update->update($request->all());
        if($request->hasFile('image')){
            $update->clearMediaCollection('category');
            $update->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.subcategories.index')->with('success','تم تعديل التصنيف الفرعي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Category::find($id);
        $delete->clearMediaCollection('category');
        $delete->delete();
        return redirect()->route('dashboard.subcategories.index')->with('success','تم حذف التصنيف الفرعي بنجاح');
    }
}
