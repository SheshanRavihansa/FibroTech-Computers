<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('admin.pages.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'string|required',
            'status' => 'string|in:active,inactive|required'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->brand_name);
        $data['slug'] = $slug;
        $data['name'] = $data['brand_name'];
        $status = Brand::create($data);
        if ($status) {
            notify()->success('Brand Successfully Created');
        } else {
            notify()->error('Something Went Wrong');
        }

        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id); 
        return view('admin.pages.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'brand_name' => 'string|required',
            'status' => 'string|in:active,inactive|required'
        ]);

        // dd($brand);

        $data = $request->all();

        $data['name'] = $data['brand_name'];

        $status = $brand->update($data);

        if ($status) {
            notify()->success('Brand Successfully Created');
        } else {
            notify()->error('Something Went Wrong');
        }

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $status = $brand->delete();

            if ($status) {
                return response()->json(['message' => 'Brand deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: Unable to delete Brand.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['message' => 'Brand deleted successfully.']);
    }
}
