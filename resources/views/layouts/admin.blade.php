<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.admin.partials.head')
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <x-admin.sidebar />
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <x-admin.navbar />
            <!-- Navbar End -->

            <!-- Footer Start -->
            {{-- @include('layouts.admin.partials.footer') --}}
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/admin/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/admin/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/admin/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/admin/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
</body>

</html>
