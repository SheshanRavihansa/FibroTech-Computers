<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.web.partials.head')
    @stack('styles')
</head>

<body class="js">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    @include('layouts.web.partials.notification')

    {{-- @include('layouts.web.partials.topbar') --}}

    <!-- Header -->
    {{-- @include('layouts.web.partials.header') --}}
    <!--/ End Header -->

    @yield('main-content')

    {{-- @include('frontend.layouts.footer') --}}

    @stack('scripts')
    <!-- Jquery -->
    <script src="{{ asset('assets/web/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets/web/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('assets/web/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/web/js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('assets/web/js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('assets/web/js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/web/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('assets/web/js/magnific-popup.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/web/js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('assets/web/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/web/js/nicesellect.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('assets/web/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('assets/web/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('assets/web/js/onepage-nav.min.js') }}"></script>
    {{-- Isotope --}}
    <script src="{{ asset('assets/web/js/isotope/isotope.pkgd.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('assets/web/js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('assets/web/js/active.js') }}"></script>

    <script>
        setTimeout(function() {
            $('.alert').slideUp();
        }, 5000);
        $(function() {
            // ------------------------------------------------------- //
            // Multi Level dropdowns
            // ------------------------------------------------------ //
            $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
                event.preventDefault();
                event.stopPropagation();

                $(this).siblings().toggleClass("show");


                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });

            });
        });
    </script>
</body>

</html>
