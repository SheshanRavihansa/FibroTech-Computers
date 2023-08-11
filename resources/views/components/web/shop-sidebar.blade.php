<div class="shop-sidebar">
    <div class="single-widget category">
        <h3 class="title">Categories</h3>
        <ul class="categor-list">
            @php
                $menu = App\Models\Category::getAllMainsWithSubcats();
            @endphp
            @if ($menu)
                @foreach ($menu as $cat_info)
                    <li class="category-item">
                        @if ($cat_info->sub_cats->count() > 0)
                            <a href="{{ route('product.cat', $cat_info->slug) }}">{{ $cat_info->name }}</a>
                            <ul class="sub-category-list">
                                @foreach ($cat_info->sub_cats as $sub_menu)
                                    <li>
                                        <a href="{{ route('product.sub.cat', [$cat_info->slug, $sub_menu->slug]) }}">{{ $sub_menu->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ route('product.cat', $cat_info->slug) }}">{{ $cat_info->name }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="single-widget recent-post">
        <h3 class="title">Recent</h3>
        @foreach ($recentproducts as $product)
            <!-- Single Post -->
            @php
                $photo = explode(',', $product->image);
            @endphp
            <div class="single-post first">
                <div class="image">
                    <img src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                </div>
                <div class="content">
                    <h5>
                        <a href="{{-- route('product-detail', $product->slug) --}}">{{ $product->name }}</a>
                    </h5>
                    @php
                        $after_discount = $product->price - ($product->price * $product->discount) / 100;
                    @endphp
                    <p class="price">
                        @if ($product->discount)
                            <del class="text-muted">Rs.{{ number_format($product->price, 2) }}</del>
                            Rs.{{ number_format($after_discount, 2) }}
                        @else
                            Rs.{{ number_format($product->price, 2) }}
                        @endif
                    </p>
                </div>
            </div>
            <!-- End Single Post -->
        @endforeach
    </div>
    <div class="single-widget category">
        <h3 class="title">Brands</h3>
        <ul class="categor-list">
            @php
                $brands = DB::table('brands')
                    ->orderBy('name', 'ASC')
                    ->where('status', 'active')
                    ->get();
            @endphp
            @foreach ($brands as $brand)
                <li>
                    <a href="{{ route('product.brand', $brand->slug) }}">{{ $brand->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


@push('styles')
    <style>
        .sub-category-list {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            left: 50%;
        }

        .category-item:hover .sub-category-list {
            display: block;
        }
    </style>
@endpush
