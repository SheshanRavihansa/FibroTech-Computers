<div class="middle-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-12">
                <!-- Logo -->
                <div class="logo">
                    @php
                        $settings = DB::table('settings')->get();
                    @endphp
                    <a href="{{ route('home') }}"><img src="@foreach ($settings as $data) {{ $data->logo }} @endforeach"
                            alt="logo"></a>
                </div>
                <!--/ End Logo -->
                <!-- Search Form -->
                <div class="search-top">
                    <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                    <!-- Search Form -->
                    <div class="search-top">
                        <form class="search-form">
                            <input type="text" placeholder="Search here..." name="search">
                            <button value="search" type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    <!--/ End Search Form -->
                </div>
                <!--/ End Search Form -->
                <div class="mobile-nav"></div>
            </div>
            <div class="col-lg-8 col-md-7 col-12">
                <div class="search-bar-top">
                    <div class="search-bar">
                        <select>
                            <option>All Category</option>
                            @foreach (Helper::getAllCategory() as $category)
                                <option>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <form method="POST" action="">
                            @csrf
                            <input name="search" placeholder="Search Products Here....." type="search">
                            <button class="btnn" type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-12">
                <div class="right-bar">
                    {{-- <div class="sinlge-bar shopping">
                        <a href="{{ route('cart') }}" class="single-icon"><i class="ti-bag"></i> <span
                                class="total-count">{{ Helper::cartCount() }}</span></a>
                        <!-- Shopping Item -->
                        @auth
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>{{ count(Helper::getAllProductFromCart()) }} Items</span>
                                    <a href="{{ route('cart')-- }}">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    {{Helper::getAllProductFromCart()}}
                                    @foreach (Helper::getAllProductFromCart() as $data)
                                        @php
                                            $photo = explode(',', $data->product['photo']);
                                        @endphp
                                        <li>
                                            <a href="{{ route('cart-delete', $data->id) }}" class="remove"
                                                title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                    alt="{{ $photo[0] }}"></a>
                                            <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                    target="_blank">{{ $data->product['title'] }}</a></h4>
                                            <p class="quantity">{{ $data->quantity }} x - <span
                                                    class="amount">${{ number_format($data->price, 2) }}</span></p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount">${{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                </div>
                            </div>
                        @endauth
                        <!--/ End Shopping Item -->
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Inner -->
<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">
                                <div class="nav-inner">
                                    <ul class="nav main-menu menu navbar-nav">
                                        <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a
                                                href="{{ route('home') }}">Home</a></li>
                                        <li class="{{ Request::path() == 'about-us' ? 'active' : '' }}"><a
                                                href="{{-- route('about-us') --}}">About Us</a></li>
                                        <li class="@if (Request::path() == 'product-grids' || Request::path() == 'product-lists') active @endif">
                                            <a href="{{-- route('product-grids') --}}">Products</a>
                                            {{-- <span class="new">New</span> --}}
                                        </li>
                                        @php
                                            $category = new \App\Models\Category();
                                            $menu = $category->getAllMainsWithSubcats();
                                        @endphp
                                        @if ($menu)
                                            <li>
                                                <a href="javascript:void(0);">Category<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown border-0 shadow">
                                                    @foreach ($menu as $cat_info)
                                                        @if ($cat_info->sub_cats->count() > 0)
                                                            <li>
                                                                <a
                                                                    href="{{-- route('product-cat', $cat_info->slug) --}}">{{ $cat_info->name }}</a>
                                                                <ul class="dropdown sub-dropdown border-0 shadow">
                                                                    @foreach ($cat_info->sub_cats as $sub_menu)
                                                                        <li>
                                                                            <a href="{{-- route('product-sub-cat', [$cat_info->slug, $sub_menu->slug]) --}}">
                                                                                {{ $sub_menu->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{-- route('product-cat', $cat_info->slug) --}}">
                                                                    {{ $cat_info->name }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                        <li class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a
                                                href="{{-- route('contact') --}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Header Inner -->
