<!DOCTYPE html>
<html lang="en">

<head>

    @include('auth.layouts.head')

    @stack('styles')
    
</head>

<body>

    @yield('main-content')

    @stack('scripts')

</body>

</html>
