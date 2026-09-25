<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('media')
                    ->search($request->query())
                    ->latest()
                    ->paginate(50);
                    // ->appends([
                    //     'query' => $request->query()
                    // ]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.Product.Partials.products', compact('products'))->render(),
            ]);
        }
        return view('Dashboard.Product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::whereNotNull('category_id')->latest()->get();
        $brands = Brand::with('media')->latest()->get();
        return view('Dashboard.Product.create',compact('product','categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // return $request->all();
        $store = Product::create($request->all());
        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $key=> $image){
                
                $store->addMedia($image)
                    //   ->withCustomProperties(['order' => $key+1])
                      ->toMediaCollection('product');
            }
        }else {
            $store->copyMedia(public_path('assets/media/dashboard/product.png'))->toMediaCollection('product');
        }
        return redirect()->route('dashboard.products.index')->with('success','تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('media','category')->find($id);
        return view('Dashboard.Product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('media','category')->find($id);
        $categories = Category::whereNotNull('category_id')->latest()->get();
        $brands = Brand::with('media')->latest()->get();
        return view('Dashboard.Product.edit',compact('product','categories','brands'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $update = Product::find($id);
        $update->update($request->all());
        if($request->hasFile('images')){
            $update->clearMediaCollection('product');
            $images = $request->file('images');
            foreach($images as $image){
                $update->addMedia($image)
                       ->toMediaCollection('product');
            }
        }
        // return redirect()->route('dashboard.products.index')->with('success','تم تعديل المنتج بنجاح');
        return redirect()
    ->route('dashboard.subcategories.show', ['subcategory' => $update->category_id])
    ->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Product::find($id);
        $delete->clearMediaCollection('product');
        $delete->delete();
        return redirect()->route('dashboard.products.index')->with('success','تم حذف المنتج بنجاح');
    }


    public function productSearch(Request $request){
        $searchTerm = $request->get('query');
        $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
        ->get()
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->getFirstMediaUrl('product'), // Assuming the media collection is named 'images'
                'unit_price'=>$product->unit_price,
                'box_price'=>$product->box_price,
            ];
        });
        return response()->json($products);
    }

    public function productSwitchStatus($id){
        $product = Product::findOrFail($id);
        $product->status = $product->status == 'active' ? 'archived' : 'active';
        $product->save();
        return response()->json( 'تم تغيير حالة المنتج بنجاح');
    }

    public function outOfStock(Request $request){
        $products = Product::where('unit_stock',0)
                    ->search($request->query())
                    ->paginate(50)
                    ->appends([
                        'query' => $request->query()
                    ]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.Product.Partials.products', compact('products'))->render(),
            ]);
        }
        return view('Dashboard.Product.out_of_stock',compact('products'));
    }
    public function archived(Request $request){
        $products = Product::where('status','archived')
                    ->search($request->query())
                    ->paginate(50)
                    ->appends([
                        'query' => $request->query()
                    ]);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.Product.Partials.products', compact('products'))->render(),
            ]);
        }
        return view('Dashboard.Product.archived',compact('products'));
    }
    
    
    public function updateStockAndPrice(Request $request,$id){
        $getProduct = Product::find($id);
        $getProduct->update([
                'unit_price'=>$request->unit_price,
                'unit_stock'=>$request->unit_stock,
                'box_price'=>$request->box_price,
                'box_stock'=>$request->box_stock,
        ]);
            
        // return redirect()->back()->with('success','تم تعديل السعر والكمية للمنتج');    
        return redirect()
        ->route('dashboard.products.index', ['page' => $request->page])
        ->with('success', 'تم تعديل السعر والكمية للمنتج');
    }
    public function updateInline(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:products,id',
            'field' => 'required|in:unit_price,box_price,unit_stock,box_stock',
            'value' => 'required|numeric|min:0',
        ]);
    
        $product = Product::findOrFail($request->id);
        $product->{$request->field} = $request->value;
        $product->save();
    
        return response()->json(['success' => true]);
    }
}
