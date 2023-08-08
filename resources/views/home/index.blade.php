@extends('layouts.web')
@section('title', 'Fibrotech || Home')
@section('main-content')
    <!-- start Banner -->
    @if (count($banners) > 0)
        <section id="Gslider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($banners as $key => $banner)
                    <li data-target="#Gslider" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                    </li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="first-slide" src="{{ $banner->image }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-left">
                            <h1 class="wow fadeInDown">{{ $banner->title }}</h1>
                            <p>{!! html_entity_decode($banner->description) !!}</p>
                            <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{-- route('product-grids') --}}" role="button">Shop
                                Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </section>
    @endif
    <!-- End Baner -->
    <!-- Start Small Banners  -->
    <section class="small-banner section">
        <div class="container-fluid">
            <div class="row">
                @php
                    $category_lists = DB::table('categories')
                        ->where('status', 'active')
                        ->where('is_parent', 1)
                        ->limit(3)
                        ->get();
                    // dump($category_lists);
                @endphp
                @if ($category_lists)
                    @foreach ($category_lists as $cat)
                        <!-- Single Banner  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-banner">
                                @if ($cat->image)
                                    <img src="{{ $cat->image }}" alt="{{ $cat->image }}">
                                @else
                                    <img src="https://via.placeholder.com/600x370" alt="#">
                                @endif
                                <div class="content">
                                    <h3>{{ $cat->name }}</h3>
                                    <a href="{{-- route('product-cat', $cat->slug) --}}">Discover Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Banner  -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- End Small Banners -->
    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                @php
                                    $categories = DB::table('categories')
                                        ->where('status', 'active')
                                        ->where('is_parent', 1)
                                        ->get();
                                    // dd($categories);
                                @endphp
                                @if ($categories)
                                    <button class="btn" style="background:black"data-filter="*">
                                        All Products
                                    </button>
                                    @foreach ($categories as $key => $cat)
                                        <button class="btn" style="background:none;color:black;"
                                            data-filter=".{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </button>
                                    @endforeach
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                            <!-- Start Single Tab -->
                            @if ($product_lists)
                                @foreach ($product_lists as $key => $product)
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->cat_id }}">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{-- route('product-detail', $product->slug) --}}">
                                                    @php
                                                        $photo = explode(',', $product->image);
                                                        // dd($photo);
                                                    @endphp
                                                    <img class="default-img" src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}">
                                                    <img class="hover-img" src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}">
                                                    @if ($product->stock <= 0)
                                                        <span class="out-of-stock">Sale out</span>
                                                    @elseif($product->type == 'new')
                                                        <span class="new">New</span>
                                                    @elseif($product->type == 'hot')
                                                        <span class="hot">Hot</span>
                                                    @else
                                                        <span class="price-dec">{{ $product->discount }}% Off</span>
                                                    @endif


                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#{{ $product->id }}"
                                                            title="Quick View" href="#"><i
                                                                class=" ti-eye"></i><span>Quick Shop</span></a>
                                                        <a title="Wishlist" href="{{-- route('add-to-wishlist', $product->slug) --}}"><i
                                                                class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart" href="{{-- route('add-to-cart', $product->slug) --}}">Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{-- route('product-detail', $product->slug) --}}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    @php
                                                        $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                                    @endphp
                                                    <span>Rs.{{ number_format($after_discount, 2) }}</span>
                                                    <del
                                                        style="padding-left:4%;">Rs.{{ number_format($product->price, 2) }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!--/ End Single Tab -->
                            @endif
                            <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->
    <!-- Start Midium Banner (Featured) -->
    <section class="midium-banner">
        <div class="container" style="display: flex; justify-content: center;">
            <div class="row">
                @if ($featured)
                    @foreach ($featured as $data)
                        <!-- Single Banner  -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-banner">
                                @php
                                    $photo = explode(',', $data->image);
                                @endphp
                                <img style="width: 600px; height: 750px; object-fit: cover" src="{{ $photo[0] }}"
                                    alt="{{ $photo[0] }}">
                                <div class="content">
                                    <h3>{{ $data->name }} <br>Up to<span> {{ $data->discount }}%</span></h3>
                                    <a href="{{-- route('product-detail', $data->slug) --}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- /End Single Banner  -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- End Midium Banner -->
@endsection


@push('styles')
    <style>
        #Gslider .carousel-inner {
            background: #000000;
            color: black;
            height: 628px;
        }

        #Gslider .carousel-inner img {
            object-fit: cover;
            width: 100%;
            height: 628px;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 35%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
    {{-- Isotope --}}
    <script src="{{ asset('assets/web/js/isotope/isotope.pkgd.min.js') }}"></script>
    <script>

        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function() {
            $filter.on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({
                    filter: filterValue
                });
            });

        });

        // init Isotope
        $(window).on('load', function() {
            var $grid = $topeContainer.each(function() {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine: 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function() {
            $(this).on('click', function() {
                for (var i = 0; i < isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
@endpush
