@extends('layouts.admin')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                {{-- <h6 class="mb-4">Floating Label</h6> --}}
                <form>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Email Address</h6>
                        <input type="email" class="form-control" name="address" required value="{{$data->email}}">
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Phone Number</h6>
                        <input type="text" class="form-control" name="address" required value="{{$data->phone}}">
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Website Address</h6>
                        <input type="text" class="form-control" name="address" required value="{{$data->address}}">
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Short Description</h6>
                        <textarea class="form-control" id="Textarea" name="short_des">{{$data->short_des}}</textarea>
                    </div>
                    <div class="form-floating mb-3" >
                        <h6 class="mb-1">Description</h6>
                        <textarea class="form-control" id="Textarea" name="description">{{$data->description}}</textarea>
                    </div>
                    <div class="form-floating mb-3" >
                        <h6 class="mb-1">Logo</h6>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
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
    <script>
        tinymce.init({
            selector: '#Textarea',
            skin: "oxide-dark",
            content_css: "dark"
        });
    </script>
@endpush
