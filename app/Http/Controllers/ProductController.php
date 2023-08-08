<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        return view('admin.pages.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'string|required',
            'short_description' => 'string|required',
            'description' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'ptype' => 'nullable|in:default,hot,new',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'is_featured' => 'required|in:1,0',
            'brand' => 'nullable|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'sub_cat' => 'nullable|exists:categories,id',
            'image' => 'string|required',
        ]);
        // dd($request->all());
        $data = $request->all();
        $slug = Str::slug($request->product_name);
        $exists = Product::where('slug', $slug)->count();
        if ($exists) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 9999);
        }
        $data['slug'] = $slug;
        $data['name'] = $data['product_name'];
        $data['type'] = $data['ptype'];
        $data['cat_id'] = $data['category'];
        $data['sub_cat_id'] = $data['sub_cat'];
        $data['brand_id'] = $data['brand'];
        // dd($data);
        $status = Product::create($data);
        if ($status) {
            notify()->success('Product Successfully Created');
        } else {
            notify()->error('Something Wend Wrong');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        // dd($product);
        return view('admin.pages.product.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'string|required',
            'short_description' => 'string|required',
            'description' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'ptype' => 'nullable|in:default,hot,new',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'is_featured' => 'required|in:1,0',
            'brand' => 'nullable|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'sub_cat' => 'nullable|exists:categories,id',
            'image' => 'string|required',
        ]);
        $data = $request->all();
        $data['name'] = $data['product_name'];
        $data['type'] = $data['ptype'];
        $data['cat_id'] = $data['category'];
        $data['sub_cat_id'] = $data['sub_cat'];
        $data['brand_id'] = $data['brand'];
        $status = $product->fill($data)->save();
        if ($status) {
            notify()->success('Product Successfully Updated');
        } else {
            notify()->error('Something Wend Wrong');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            $status = $product->delete();

            if ($status) {
                return response()->json(['message' => 'Prosuct deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: Unable to delete Product.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // return response()->json(['message' => 'Banner deleted successfully.']);
    }
}
