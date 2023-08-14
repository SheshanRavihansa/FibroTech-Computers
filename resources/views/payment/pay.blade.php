@extends('layouts.web')
@section('title', 'Fibrotech || Pay')
@section('content')
    <main>
        <div class="container d-flex justify-content-center text-center">
            <div class="">
                <h2>Payhere Payment</h2>
                <h3>Order ID: {{ $order->id }}</h3>
                <h4>Total: {{ $order->sub_total }}</h4>
                <form class="" method="post" action="{{ env('PAYHERE_ENDPOINT') }}">
                    <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">

                    <input type="hidden" name="return_url" value="{{ route('payhere.return', $order->id) }}">
                    <input type="hidden" name="cancel_url" value="{{ route('payhere.cancel', $order->id) }}">
                    <input type="hidden" name="notify_url" value="https://8000.nuwanr.dev/api/payhere/notify">

                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="items" value="Order {{ $order->id }}">
                    <input type="hidden" name="currency" value="LKR">
                    <input type="hidden" name="amount" value="{{ number_format($order->sub_total, 2, '.', '') }}">

                    <input type="hidden" name="first_name" value="{{ $order->first_name ?? '' }}">
                    <input type="hidden" name="last_name" value="{{ $order->last_name ?? '' }}">
                    <input type="hidden" name="email" value="{{ $order->email ?? '' }}">
                    <input type="hidden" name="phone" value="{{ $order->phone ?? '' }}">
                    <input type="hidden" name="address" value="{{ $order->address ?? '' }}">
                    <input type="hidden" name="city" value="Colombo">
                    <input type="hidden" name="country" value="Sri Lanka">
                    <input type="hidden" name="hash" value="{{ $hash }}"> <!-- Replace with generated hash -->
                    <input type="submit" class="btn" value="Pay Now">
                </form>
            </div>
        </div>
    </main>
@endsection
