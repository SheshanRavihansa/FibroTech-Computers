<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        // dd($banners);
        return view('admin.pages.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'banner_title' => 'string|required|max:50',
            'description' => 'string|nullable',
            'image' => 'string|required',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->banner_title);
        $data['title'] = $request->banner_title;
        unset($data['banner_title']);
        $count = Banner::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis');
        }
        $data['slug'] = $slug;

        $status = Banner::create($data);

        if ($status) {
            notify()->success('Banner successfully created');
        } else {
            notify()->error('Something Went Wrong');
        }
        return redirect()->route('banner.index');
        // dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner=Banner::findOrFail($id);
        return view('admin.pages.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner=Banner::findOrFail($id);
        $request->validate([
            'banner_title' => 'string|required|max:50',
            'description' => 'string|nullable',
            'image' => 'string|required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $data['title'] = $request->banner_title;
        unset($data['banner_title']);
        $status = $banner->fill($data)->save();

        if ($status) {
            notify()->success('Banner successfully Updated');
        } else {
            notify()->error('Something Went Wrong');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);

            $status = $banner->delete();

            if ($status) {
                return response()->json(['message' => 'Banner deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: Unable to delete Banner.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['message' => 'Banner deleted successfully.']);
    }
}
