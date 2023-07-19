@extends('auth.layouts.main')

@section('title', 'FibroTech || Register')

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
        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary">FibroTech</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <!-- Alerts -->
                        {{-- <div class="alert alert-danger" role="alert">
                            A simple danger alert—check it out!
                        </div> --}}
                        <!-- Alerts end-->
                        <form method="POST" action="{{ route('register') }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" name="firstName"
                                    :value="old('firstName')" required autocomplete="firstName" placeholder="jhondoe">
                                <label for="floatingText">First Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" name="lastName"
                                    :value="old('lastName')" required autocomplete="lastName" placeholder="jhondoe">
                                <label for="floatingText">Last Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email"
                                    :value="old('email')" required autocomplete="email" placeholder="email@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" name="password" required
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword"
                                    name="password_confirmation" required placeholder="Password">
                                <label for="floatingPassword">Confirm Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        </form>
                        <p class="text-center mb-0">Already have an Account? <a href="">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
@endsection
@push('scripts')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/auth/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/auth/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('assets/auth/js/main.js') }}"></script>
@endpush
