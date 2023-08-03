@extends('layouts.admin')
@section('title', 'Admin || Create Brand')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 ">
                <form method="POST" action="{{ route('brand.store') }}">
                    @csrf
                    {{-- Name --}}
                    <div class="bg-secondary rounded h-100 px-4 pt-4">
                        <h6 class="mb-2">Brand Name</h6>
                        <input class="form-control form-control-lg" type="text" name="brand_name"
                            value="{{ old('brand_name') }}">
                        <div style="float: right;">
                            @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Status --}}
                    <div class="row px-4 pt-4">
                        <div class="rounded h-100 col-xl-4">
                            <h6 class="mb-2">Status</h6>
                            <select name="status" class="form-select form-select-lg">
                                <option hidden selected >Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div style="float: right;">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2 p-4">
                        <button class="btn btn-lg btn-success m-2" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
