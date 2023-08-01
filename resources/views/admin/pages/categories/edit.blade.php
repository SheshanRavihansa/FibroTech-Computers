@extends('layouts.admin')
@section('title', 'Admin || Edit Category')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 ">
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    @method('PATCH')
                    {{-- Name --}}
                    <div class="bg-secondary rounded h-100 px-4 pt-4">
                        <h6 class="mb-2">Category Name</h6>
                        <input class="form-control form-control-lg" type="text" name="category_name"
                            value="{{ $category->name }}">
                        <div style="float: right;">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Description --}}
                    <div class="form-floating px-4 pt-4">
                        <h6 class="mb-2">Description</h6>
                        <textarea class="form-control" id="Textarea" name="description">{{ $category->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row px-4 pt-4">
                        {{-- Status --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Status</h6>
                            <select name="status" class="form-select form-select-lg">
                                <option hidden>Select Status</option>
                                <option {{ $category->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $category->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive
                                </option>
                            </select>
                            <div style="float: right;">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- category type --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Category Type</h6>
                            <select name="category_type" class="form-select form-select-lg" id="cat_type">
                                <option hidden selected value="palceholder">Select Category Type</option>
                                <option {{ $category->is_parent == 1 ? 'selected' : '' }} value="parent">Main Category
                                </option>
                                <option {{ $category->is_parent == 0 ? 'selected' : '' }} value="subcat">Subcategory
                                </option>
                            </select>
                            <div style="float: right;">
                                @error('category_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- parent category --}}
                        <div class=" rounded h-100 col-xl-4" id="parent_cat">
                            <h6 class="mb-2">Main Category</h6>
                            <select name="parent_cat" class="form-select form-select-lg">
                                @foreach ($parent_cats as $key => $parent_cat)
                                    <option value="{{ $parent_cat->id }}"
                                        {{ $parent_cat->id == $category->parent_id ? 'selected' : '' }}>
                                        {{ $parent_cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div style="float: right;">
                                @error('parent_cat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- image --}}
                    <div class="px-4">
                        <h6 class="mb-1 mt-4">Image</h6>
                        <h6 class="mb-2 mt-1"><span class="small text-warning">* Choose only one image! 600 x 370 px</span>
                        </h6>
                        <div class="input-group ">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail1" class="form-control" type="text" name="image"
                                value="{{ $category->image }}">
                        </div>
                        <div style="float: right;">
                            @error('Image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="holder1" class="col-xl-6 mb-3">
                            <img src="{{ $category->image }}"
                                style="margin-top:15px; max-width: 20rem; max-height: fit-content;">
                        </div>
                    </div>

                    <div class="form-group mb-2 p-4">
                        <button class="btn btn-lg btn-success m-2" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/skins/ui/oxide/content.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/tinymce.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {

            $('#cat_type').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue === 'parent' || selectedValue === 'palceholder') {
                    $('#parent_cat').hide();
                } else {
                    $('#parent_cat').show();
                }
            });
            // Trigger the 'change' event on page load to handle visibility
            $('#cat_type').trigger('change');
        });

        tinymce.init({
            selector: '#Textarea',
            skin: "oxide-dark",
            content_css: "dark"
        });

        $('#lfm').filemanager('image');
    </script>
@endpush
