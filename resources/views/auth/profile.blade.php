@extends('layouts.admin')

@section('title', 'FibroTech || profile')

@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="form-floating mb-3 col-xl-6">
                            <h6 class="mb-1">First Name</h6>
                            {{-- @php
                                echo($user)
                            @endphp --}}
                            <input type="phone" class="form-control" name="firstName" value="{{ $user->firstName }}">
                            <div style="float: right;">
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3 col-sm-6">
                            <h6 class="mb-1">Last Name</h6>
                            <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}">
                            <div style="float: right;">
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Email</h6>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        <div style="float: right;">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Phone</h6>
                        <input type="phone" class="form-control" name="phone" value="{{ $user->phone }}">
                        <div style="float: right;">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Address</h6>
                        <input type="address" class="form-control" name="address" value="{{ $user->address }}">
                        <div style="float: right;">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-lg btn-success m-2" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            @if (session('status') === 'password-updated')
                @php
                    notify()->success('password successfully updated');
                @endphp
            @endif
            <div class="bg-secondary rounded h-100 p-4">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Current Password</h6>
                        <input type="password" class="form-control" name="current_password" required
                            placeholder="Old Password">
                        <div style="float: right;">
                            @error('current_password', 'updatePassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">New Password</h6>
                        <input type="password" class="form-control" name="password" required placeholder="New Password">
                        <div style="float: right;">
                            @error('password', 'updatePassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <h6 class="mb-1">Confirm Password</h6>
                        <input type="password" class="form-control" name="password_confirmation" required
                            placeholder="Confirm Password">
                        <div style="float: right;">
                            @error('password_confirmation', 'updatePassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
