@extends('auth.layouts.main')

@section('title', 'FibroTech || Forgot Password')

@section('main-content')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('web') }}" class="">
                                <h3 class="text-primary">FibroTech</h3>
                            </a>
                            <h3>Forgot Password</h3>
                        </div>
                        <!-- Alerts -->
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                <strong>{{ $error }}</strong>
                                            </li>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <!-- Alerts end-->
                        <form method="post" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email"
                                    :value="old('email')" autocomplete="email" placeholder="email@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send password reset link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
