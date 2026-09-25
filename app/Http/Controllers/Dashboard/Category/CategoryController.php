<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('category_id')->with('media')->latest()->paginate(50);
        return view('Dashboard.Category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('Dashboard.Category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $store = Category::create($request->all());
        if($request->hasFile('image')){
            $store->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.categories.index')->with('success','تم إضافة التصنيف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        // Get the products of this category with pagination
        // $products = $category->products()->paginate(10); // 10 products per page

        return view('Dashboard.Category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $category = Category::find($id);
        $parents = Category::whereNull('category_id')->where('id','<>',$id)->latest()->get();

        return view('Dashboard.Category.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        
        $update = Category::find($id);
        $update->update($request->all());
        if($request->hasFile('image')){
            $update->clearMediaCollection('category');
            $update->addMedia($request->file('image'))
                  ->toMediaCollection('category');
        }
        return redirect()->route('dashboard.categories.index')->with('success','تم تعديل التصنيف بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Category::find($id);
        $delete->clearMediaCollection('category');
        $delete->delete();
        return redirect()->route('dashboard.categories.index')->with('success','تم حذف التصنيف بنجاح');
    }
}
