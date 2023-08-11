<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function products()
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();
        $products = Product::query();

        if (!empty($_GET['show'])) {
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        } else {
            $products = $products->where('status', 'active')->paginate(9);
        }

        return view('web.pages.products', compact('recent_products', 'products'));
    }

    public function productFilter(Request $request)
    {
        $data = $request->all();

        $showURL = '';
        if (!empty($data['show'])) {
            $showURL .= '&show=' . $data['show'];
        }
        return redirect()->route('products', $showURL);
    }

    public function productCat(Request $request)
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();

        $category = Category::where('slug', $request->slug)->firstOrFail();

        $products = $category->products()->paginate(9);

        return view('web.pages.products', compact('recent_products', 'products'));
    }

    public function productSubCat(Request $request)
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();

        $category = Category::where('slug', $request->subCatSlug)->firstOrFail();

        $products = $category->sub_cat_products()->paginate(9);

        return view('web.pages.products', compact('recent_products', 'products'));
    }

    public function productBrand(Request $request)
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();

        $Brand = Brand::where('slug', $request->slug)->firstOrFail();

        $products = $Brand->products()->paginate(9);

        return view('web.pages.products', compact('recent_products', 'products'));
    }

    public function productSearch(Request $request)
    {
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();

        // dd($request->all());
        $products = Product::orwhere('name', 'like', '%' . $request->search . '%')
            ->orwhere('slug', 'like', '%' . $request->search . '%')
            ->orwhere('description', 'like', '%' . $request->search . '%')
            ->orwhere('short_description', 'like', '%' . $request->search . '%')
            ->orwhere('price', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate('9');

        return view('web.pages.products', compact('recent_products', 'products'));
    }

    public function productDetail($slug)
    {
        $product_details;
    }
}
