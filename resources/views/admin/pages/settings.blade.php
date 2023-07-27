@extends('layouts.admin')
@section('title', 'Admin || Settings')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Email Address</h6>
                        <input type="email" class="form-control" name="email" required value="{{ $data->email }}">
                        <div style="float: right;">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Phone Number</h6>
                        <input type="phone" class="form-control" name="phone"  value="{{ $data->phone }}">
                        <div style="float: right;">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Address</h6>
                        <input type="text" class="form-control" name="address"  value="{{ $data->address }}">
                        <div style="float: right;">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Short Description</h6>
                        <textarea class="form-control" id="Textarea" name="short_des">{{ $data->short_des }}</textarea>
                        <div style="float: right;">
                            @error('short_des')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Description</h6>
                        <textarea class="form-control" id="Textarea" name="description">{{ $data->description }}</textarea>
                        <div style="float: right;">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <h6 class="mb-1">Logo</h6>
                        <h6 class="mb-2 mt-1"><span class="small text-warning">Choose only one image! *</span></h6>
                        <div class="input-group ">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail1" class="form-control" type="text" name="logo"
                                value="{{ $data->logo }}">
                        </div>
                        <div style="float: right;">
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="holder1" style="margin-top:15px;background-color: #222f3e;" class="col-xl-6 mb-3">
                            <img src="{{ $data->logo }}"
                                style="margin-top:15px; max-width: 20rem; max-height: fit-content;">
                        </div>
                    </div>
                    <div class="form-group mb-3">
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
