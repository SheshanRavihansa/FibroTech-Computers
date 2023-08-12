@extends('layouts.web')
@section('title', 'Fibrotech || Product')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('products') }}">Products<i class="ti-arrow-right"></i></a>
                            </li>
                            <li class="active"><a href="#">Product Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        @php
                                            $photo = explode(',', $product_details->image);
                                            // dd($photo);
                                        @endphp
                                        @foreach ($photo as $data)
                                            <li data-thumb="{{ $data }}" rel="adjustX:10, adjustY:">
                                                <img src="{{ $data }}" alt="{{ $data }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{ $product_details->name }}</h4>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            @php
                                                $rate = ceil($product_details->reviews->avg('rate'));
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <li><i class="fa fa-star"></i></li>
                                                @else
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <a href="#" class="total-review">({{ $product_details->reviews->count() }})
                                            Review</a>
                                    </div>
                                    @php
                                        $after_discount = $product_details->price - ($product_details->price * $product_details->discount) / 100;
                                    @endphp
                                    <p class="price"><span
                                            class="discount">Rs.{{ number_format($after_discount, 2) }}</span>
                                        @if ($product_details->discount)
                                            <s>Rs.{{ number_format($product_details->price, 2) }}</s>
                                        @endif
                                    </p>
                                    <p class="description">{!! $product_details->short_description !!}</p>
                                </div>
                                <!--/ End Description -->
                                <!-- Product Buy -->
                                <div class="product-buy">
                                    <form action="{{-- route('single-add-to-cart') --}}" method="POST">
                                        @csrf
                                        <div class="quantity">
                                            <h6>Quantity :</h6>
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{ $product_details->slug }}">
                                                <input type="text" name="quant[1]" class="input-number" data-min="1"
                                                    data-max="1000" value="1" id="quantity">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>
                                        <div class="add-to-cart mt-4">
                                            <button type="submit" class="btn">Add to cart</button>
                                            {{-- <a href="{{ route('add-to-wishlist', $product_detail->slug) }}"
                                                class="btn min"><i class="ti-heart"></i></a> --}}
                                        </div>
                                    </form>
                                    {{-- <p class="cat">Category :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p> --}}
                                    {{-- @if ($product_detail->sub_cat_info)
                                        <p class="cat mt-1">Sub Category :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
                                        @endif --}}
                                    <p class="availability">Stock : @if ($product_details->stock > 0)
                                            <span class="badge badge-success m-2 p-2">{{ $product_details->stock }}</span>
                                        @else
                                            <span class="badge badge-danger m-2 p-2">Out Of Stock</span>
                                        @endif
                                    </p>
                                </div>
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">
                                <div class="nav-main">
                                    <!-- Tab Nav -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#description" role="tab">Description</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews"
                                                role="tab">Reviews</a></li>
                                    </ul>
                                    <!--/ End Tab Nav -->
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des">
                                                        <p>{!! $product_details->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Description Tab -->
                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                                        <div class="tab-single review-panel">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- Review -->
                                                    <div class="comment-review">
                                                        <div class="add-review">
                                                            <h5>Add A Review</h5>
                                                            <p>Your email address will not be published. Required fields are
                                                                marked</p>
                                                        </div>
                                                        <h4>Your Rating <span class="text-danger">*</span></h4>
                                                        <div class="review-inner">
                                                            <!-- Form -->
                                                            @auth
                                                                <form class="form" method="POST"
                                                                    action="{{ route('review.product.submit', $product_details->slug) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-5" type="radio"
                                                                                            name="rate" value="5">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-5"
                                                                                            title="5 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-4" type="radio"
                                                                                            name="rate" value="4">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-4"
                                                                                            title="4 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-3" type="radio"
                                                                                            name="rate" value="3">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-3"
                                                                                            title="3 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-2" type="radio"
                                                                                            name="rate" value="2">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-2"
                                                                                            title="2 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-1" type="radio"
                                                                                            name="rate" value="1">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-1"
                                                                                            title="1 out of 5 stars"></label>
                                                                                        @error('rate')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>Write a review</label>
                                                                                <textarea name="review" rows="6" placeholder=""></textarea>
                                                                            </div>
                                                                            @error('review')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group button5">
                                                                                <button type="submit"
                                                                                    class="btn">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <p class="text-center p-5">
                                                                    You need to <a href="{{ route('login') }}"
                                                                        style="color:rgb(54, 54, 204)">Login</a> OR <a
                                                                        style="color:blue"
                                                                        href="{{ route('register') }}">Register</a>
                                                                </p>
                                                                <!--/ End Form -->
                                                            @endauth
                                                        </div>
                                                    </div>

                                                    <div class="ratting-main">
                                                        <div class="avg-ratting">
                                                            <h4>{{ ceil($product_details->reviews->avg('rate')) }}
                                                                <span>(Overall)</span>
                                                            </h4>
                                                            <span>Based on {{ $product_details->reviews->count() }}
                                                                Comments</span>
                                                        </div>
                                                        @foreach ($product_details->reviews as $data)
                                                            <!-- Single Rating -->
                                                            <div class="single-rating">
                                                                <div class="rating-author">
                                                                    @if ($data->user_info['photo'])
                                                                        <img src="{{ $data->user_info['photo'] }}"
                                                                            alt="{{ $data->user_info['photo'] }}">
                                                                    @else
                                                                        <img src="/storage/user.png" alt="Profile.jpg">
                                                                    @endif
                                                                </div>
                                                                <div class="rating-des">
                                                                    <h6>{{ $data->user_info->firstName . ' ' . $data->user_info->lastName }}
                                                                    </h6>
                                                                    <div class="ratings">

                                                                        <ul class="rating">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($data->rate >= $i)
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                @else
                                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                                @endif
                                                                            @endfor
                                                                        </ul>
                                                                        <div class="rate-count">
                                                                            (<span>{{ $data->rate }}</span>)</div>
                                                                    </div>
                                                                    <p>{{ $data->review }}</p>
                                                                </div>
                                                            </div>
                                                            <!--/ End Single Rating -->
                                                        @endforeach
                                                    </div>

                                                    <!--/ End Review -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Reviews Tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Shop Single -->
    <!-- Start Related Products -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- {{$product_detail->rel_prods}} --}}
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach ($product_details->related_products as $data)
                            @if ($data->id !== $product_details->id)
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('product.details', $data->slug) }}">
                                            @php
                                                $photo = explode(',', $data->image);
                                            @endphp
                                            <img class="default-img" src="{{ $photo[0] }}"
                                                alt="{{ $photo[0] }}">
                                            <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                            @if ($data->discount)
                                                <span class="price-dec">{{ $data->discount }} % Off</span>
                                            @endif
                                            {{-- <span class="out-of-stock">Hot</span> --}}
                                        </a>
                                        {{-- <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#modelExample" title="Quick View"
                                                    href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to
                                                        Wishlist</span></a>
                                                <a title="Compare" href="#"><i
                                                        class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                            </div>
                                            <div class="product-action-2">
                                                <a title="Add to cart" href="#">Add to cart</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('product.details', $data->slug) }}">{{ $data->name }}</a>
                                        </h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount = $data->price - ($data->discount * $data->price) / 100;
                                            @endphp
                                            <span class="old">Rs.{{ number_format($data->price, 2) }}</span>
                                            <span>Rs.{{ number_format($after_discount, 2) }}</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Related Porducts -->
@endsection

@push('styles')
    <style>
        /* Rating */
        .rating_box {
            display: inline-flex;
        }

        .star-rating {
            font-size: 0;
            padding-left: 10px;
            padding-right: 10px;
        }

        .star-rating__wrap {
            display: inline-block;
            font-size: 1rem;
        }

        .star-rating__wrap:after {
            content: "";
            display: table;
            clear: both;
        }

        .star-rating__ico {
            float: right;
            padding-left: 2px;
            cursor: pointer;
            color: #F7941D;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating__ico:last-child {
            padding-left: 0;
        }

        .star-rating__input {
            display: none;
        }

        .star-rating__ico:hover:before,
        .star-rating__ico:hover~.star-rating__ico:before,
        .star-rating__input:checked~.star-rating__ico:before {
            content: "\F005";
        }
    </style>
@endpush
