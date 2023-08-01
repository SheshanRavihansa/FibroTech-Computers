<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::getAllCategories();
        // dd($categories);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_cats = Category::getAllCategories();
        // dd($parent_cat);
        return view('admin.pages.categories.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string',
            'description' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'category_type' => 'required|in:parent,subcat',
            'image' => 'string|nullable',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->category_name);
        $cat_check = Category::where('slug', $slug)->count();

        if ($cat_check > 0) {
            notify()->error('Category alredy exists');
            return back();
        }

        if ($request->category_type == 'subcat') {
            $data['is_parent'] = 0;
            $data['parent_id'] = $request->parent_cat;
        }

        $data['slug'] = $slug;
        $data['name'] = $data['category_name'];

        $status = Category::create($data);

        if ($status) {
            notify()->success('Category successfully created');
        } else {
            notify()->error('Something Went Wrong');
        }
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'category_name' => 'required|string',
            'description' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'category_type' => 'required|in:parent,subcat',
            'image' => 'string|nullable',
        ]);

        $data = $request->all();
        $data['name'] = $data['category_name'];

        if ($request->category_type == 'parent') {
            $data['is_parent'] = 1;
            $data['parent_id'] = null;
        } else {
            $data['is_parent'] = 0;
            $data['parent_id'] = $request->parent_cat;
        }

        $status = $category->fill($data)->save();
        if ($status) {
            notify()->success('Category successfully updated');
        } else {
            notify()->error('Something Went Wrong');
        }
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $parent_cats = Category::where('is_parent', 1)->get();
        return view('admin.pages.categories.edit', compact('category', 'parent_cats'));
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $child_cat_id = Category::where('parent_id', $id)->pluck('id');

            $status = $category->delete();

            if ($status) {
                if (count($child_cat_id) > 0) {
                    Category::whereIn('id', $child_cat_id)->update(['is_parent' => 1]);
                }
            }
            return response()->json(['message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: Unable to delete category.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['message' => 'Category deleted successfully.']);

    }
}
