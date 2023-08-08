@extends('layouts.admin')
@section('title', 'Admin || Edit Product')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 ">
                <form method="POST" action="{{ route('product.update', $product->id) }}">
                    @csrf
                    @method('PATCH')
                    {{-- Name --}}
                    <div class="bg-secondary rounded h-100 px-4 pt-4">
                        <h6 class="mb-2">Product Name</h6>
                        <input class="form-control form-control-lg" type="text" name="product_name"
                            value="{{ $product->name }}">
                        <div style="float: right;">
                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Short Description --}}
                    <div class="form-floating px-4 pt-4">
                        <h6 class="mb-2">Short Description</h6>
                        <textarea class="form-control" id="Textarea" name="short_description">{{ $product->short_description }}</textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Description --}}
                    <div class="form-floating px-4 pt-4">
                        <h6 class="mb-2">Description</h6>
                        <textarea class="form-control" id="Textarea" name="description">{{ $product->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row px-4 pt-4">
                        {{-- Status --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Status</h6>
                            <select name="status" class="form-select form-select-lg">
                                {{-- <option hidden selected>Select Status</option> --}}
                                <option {{ $product->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $product->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive
                                </option>
                            </select>
                            <div style="float: right;">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- product type --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Product Type</h6>
                            <select name="ptype" class="form-select form-select-lg">
                                {{-- <option hidden selected value="ptype">Select a Type</option> --}}
                                <option {{ $product->type == 'default' ? 'selected' : '' }} value="default">
                                    Default
                                </option>
                                <option {{ $product->type == 'hot' ? 'selected' : '' }} value="hot">Hot</option>
                                <option {{ $product->type == 'new' ? 'selected' : '' }} value="new">New</option>
                            </select>
                            <div style="float: right;">
                                @error('ptype')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Inventory Stock --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Inventory Stock</h6>
                            <input class="form-control form-control-lg" type="text" name="stock"
                                value="{{ $product->stock }}">
                            <div style="float: right;">
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 pt-4">
                        {{-- Price --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Price</h6>
                            <input class="form-control form-control-lg" type="text" name="price"
                                value="{{ $product->price }}">
                            <div style="float: right;">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Discount --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Discount (%)</h6>
                            <input class="form-control form-control-lg" type="text" name="discount"
                                value="{{ $product->discount }}">
                            <div style="float: right;">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Is featured --}}
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Featured</h6>
                            <select name="is_featured" class="form-select form-select-lg">
                                {{-- <option  hidden selected>Is Featured ?</option> --}}
                                <option {{ $product->is_featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                                <option {{ $product->is_featured == 0 ? 'selected' : '' }} value="0">No</option>
                            </select>
                            <div style="float: right;">
                                @error('is_featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 pt-4">
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Brand</h6>
                            <select name="brand" class="form-select form-select-lg">
                                {{-- <option hidden selected value="palceholder">Select Brand</option> --}}
                                @foreach ($brands as $key => $brand)
                                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <div style="float: right;">
                                @error('brand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" rounded h-100 col-xl-4">
                            <h6 class="mb-2">Category</h6>
                            <select name="category" class="form-select form-select-lg" id="category">
                                {{-- <option hidden selected value="palceholder">Select Category</option> --}}
                                @foreach ($categories as $key => $parent_cat)
                                    <option {{ $product->cat_id == $parent_cat->id ? 'selected' : '' }}
                                        value="{{ $parent_cat->id }}">{{ $parent_cat->name }}</option>
                                @endforeach
                            </select>
                            <div style="float: right;">
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" rounded h-100 col-xl-4 d-none" id="sub_cat">
                            <h6 class="mb-2">Sub Category</h6>
                            <select name="sub_cat" class="form-select form-select-lg" id="sub_category">
                            </select>
                            <div style="float: right;">
                                @error('sub_cat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- image --}}
                    <div class="px-4">
                        <h6 class="mb-1 mt-4">Images</h6>
                        <h6 class="mb-2 mt-1"><span class="small text-warning">* Choose one or multiple images! 500 x 500
                                px</span>
                        </h6>
                        <div class="input-group ">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail1" data-preview="holder1"
                                    class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail1" class="form-control" type="text" name="image"
                                value="{{ $product->image }}">
                        </div>
                        <div style="float: right;">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="holder1" class="col-xl-6 mb-3">
                            @php
                                $imagePaths = explode(',', $product->image);
                            @endphp

                            @foreach ($imagePaths as $imagePath)
                                <img src="{{ $imagePath }}"
                                    style="margin-top:15px; max-width: 15rem; max-height: fit-content; margin:5px;">
                            @endforeach
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
    <style>
        #holder1 {
            display: flex;
            flex-direction: row;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/tinymce.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        tinymce.init({
            selector: '#Textarea',
            skin: "oxide-dark",
            content_css: "dark"
        });

        $('#lfm').filemanager('image');
    </script>
    <script>
        var sub_cat_id = '{{ $product->sub_cat_id }}';

        $(document).ready(function() {
            $('#category').change(function() {
                var cat_id = $(this).val();

                if (cat_id != null) {
                    $.ajax({
                        url: "/admin/dashboard/category/" + cat_id + "/sub",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: cat_id
                        },
                        success: function(response) {
                            if (typeof(response) != 'object') {
                                response = $.parseJSON(response);
                            }
                            var html_option =
                                "<option selected value=''>None</option>";
                            if (response.status) {
                                var data = response.data;
                                if (response.data) {
                                    $('#sub_cat').removeClass('d-none');
                                    $.each(data, function(id, name) {
                                        html_option += "<option value='" + id + "' " + (
                                                sub_cat_id == id ? 'selected ' : '') +
                                            ">" + name + "</option>";
                                    });
                                }
                            } else {
                                $('#sub_cat').addClass('d-none');
                            }
                            $('#sub_category').html(html_option);
                        }
                    });
                } else {
                    $('#sub_cat').addClass('d-none');
                    $('#sub_category').html(
                        "<option hidden selected value=''>Select Sub Category</option>");
                }
            });

            if (sub_cat_id != null) {
                $('#category').change(); // Trigger the change event to populate subcategories
            }
        });
    </script>
@endpush
