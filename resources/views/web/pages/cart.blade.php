@extends('layouts.web')
@section('title', 'Fibrotech || Cart')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('cart') }}">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody id="cart_item_list">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                @if (Helper::getAllProductFromCart())
                                    @foreach (Helper::getAllProductFromCart() as $key => $cart)
                                        <tr>
                                            @php
                                                $photo = explode(',', $cart->product->image);
                                            @endphp
                                            <td class="image" data-title="No"><img src="{{ $photo[0] }}"
                                                    alt="{{ $photo[0] }}"></td>
                                            <td class="product-des" data-title="Description">
                                                <p class="product-name"><a
                                                        href="{{ route('product.details', $cart->product->slug) }}"
                                                        target="_blank">{{ $cart->product->name }}</a></p>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <span>Rs.{{ number_format($cart->price, 2) }}</span>
                                            </td>
                                            <td class="qty" data-title="Qty"><!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            disabled="disabled" data-type="minus"
                                                            data-field="quant[{{ $key }}]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quant[{{ $key }}]"
                                                        class="input-number" data-min="1" data-max="100"
                                                        value="{{ $cart->quantity }}">
                                                    <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            data-type="plus" data-field="quant[{{ $key }}]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </td>
                                            <td class="total-amount cart_single_price" data-title="Total"><span
                                                    class="money">Rs.{{ $cart->amount }}</span></td>

                                            <td class="action" data-title="Remove"><a
                                                    href="{{ route('cart.delete', $cart->id) }}"><i
                                                        class="ti-trash remove-icon"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="float-right">
                                        <button class="btn float-right" type="submit">Update</button>
                                    </td>
                                @else
                                    <tr>
                                        <td class="text-center">
                                            There are no any carts available. <a href="{{ route('products') }}"
                                                style="color:blue;">Continue shopping</a>
                                        </td>
                                    </tr>
                                @endif
                            </form>
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left"></div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">Cart
                                            Subtotal<span>Rs.{{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                        </li>
                                    </ul>
                                    <div class="button5">
                                        <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ route('products') }}" class="btn">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
@endsection
