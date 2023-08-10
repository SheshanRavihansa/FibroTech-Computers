<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $featured = Product::where('status', 'active')->where('is_featured', 1)->orderBy('price', 'DESC')->limit(2)->get();
    //     $product_lists = Product::where('status', 'active')->get();
    //     $hot_items = Product::where('status', 'active')->where('type', 'hot')->limit(8)->get();
    //     $banners = Banner::where('status', 'active')->limit(5)->orderBy('id', 'DESC')->get();
    //     // dd($banners);
    //     return view('home.index', compact('banners', 'product_lists', 'featured', 'hot_items'));
    // }
    public function index()
{
    $featured = Product::where('status', 'active')->where('is_featured', 1)->orderBy('price', 'DESC')->limit(2)->get();
    $categories = Category::where('status', 'active')->where('is_parent', 1)->get();

    $product_lists = []; // Array to store product lists for each category

    foreach ($categories as $category) {
        $categoryProducts = Product::where('status', 'active')
            ->where('cat_id', $category->id)
            ->limit(8) // Limit to 8 products per category
            ->get();

        $product_lists[$category->id] = $categoryProducts;
    }

    $hot_items = Product::where('status', 'active')->where('type', 'hot')->limit(8)->get();
    $banners = Banner::where('status', 'active')->limit(5)->orderBy('id', 'DESC')->get();

    return view('home.index', compact('banners', 'product_lists', 'featured', 'hot_items'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
