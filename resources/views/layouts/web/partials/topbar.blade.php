<!-- Topbar -->
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <!-- Top Left -->
                <div class="top-left">
                    <ul class="list-main">
                        @php
                            $settings = DB::table('settings')->get();
                        @endphp
                        <li><i class="ti-headphone-alt"></i>
                            @foreach ($settings as $data)
                                {{ $data->phone }}
                            @endforeach
                        </li>
                        <li><i class="ti-email"></i>
                            @foreach ($settings as $data)
                                {{ $data->email }}
                            @endforeach
                        </li>
                    </ul>
                </div>
                <!--/ End Top Left -->
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <!-- Top Right -->
                <div class="right-content">
                    <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="{{ route('order.track') }}">Track Order</a></li>
                        {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                        @auth
                            @if (Auth::user()->role == 'admin')
                                <li><i class="ti-user"></i> <a href="{{ route('admin') }}" target="_blank">Dashboard</a>
                                </li>
                            @else
                                <li><i class="ti-user"></i> <a href="{{ route('user') }}" target="_blank">Dashboard</a></li>
                            @endif
                            <li><i class="ti-power-off"></i> <a href="{{ route('user.logout') }}">Logout</a></li>
                        @else
                            <li><i class="ti-power-off"></i><a href="{{ route('login.form') }}">Login /</a> <a
                                    href="{{ route('register.form') }}">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- End Top Right -->
            </div>
        </div>
    </div>
</div>
<!-- End Topbar -->
