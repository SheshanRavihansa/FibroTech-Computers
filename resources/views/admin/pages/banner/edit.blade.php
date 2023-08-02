@extends('layouts.admin')
@section('title', 'Admin || Create Banner')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 ">
                <form method="POST" action="{{ route('banner.update', $banner->id) }}">
                    @csrf
                    @method('PATCH')
                    {{-- title --}}
                    <div class="bg-secondary rounded h-100 px-4 pt-4">
                        <h6 class="mb-2">Banner Title</h6>
                        <input class="form-control form-control-lg" type="text" name="banner_title"
                            value="{{ $banner->title }}">
                        <div style="float: right;">
                            @error('banner_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Description --}}
                    <div class="form-floating px-4 pt-4">
                        <h6 class="mb-2">Description</h6>
                        <textarea class="form-control" id="Textarea" name="description">{{ $banner->description }}</textarea>
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
                                <option {{ $banner->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $banner->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive
                                </option>
                            </select>
                            <div style="float: right;">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- image --}}
                        <div class="px-4">
                            <h6 class="mb-1 mt-4">Image</h6>
                            <h6 class="mb-2 mt-1">
                                <span class="small text-warning">* Choose only one image! 1200 x 628 px</span>
                            </h6>
                            <div class="input-group ">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail1" data-preview="holder1"
                                        class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail1" class="form-control" type="text" name="image"
                                    value="{{ $banner->image }}">
                            </div>
                            <div style="float: right;">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="holder1" class="col-xl-6 mb-3">
                                <img src="{{ $banner->image }}"
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
        tinymce.init({
            selector: '#Textarea',
            skin: "oxide-dark",
            content_css: "dark"
        });

        $('#lfm').filemanager('image');
    </script>
@endpush
