<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PayhereController extends Controller
{
    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);
        // dd($order);
        $hash = strtoupper(
            md5(
                env('PAYHERE_MERCHANT_ID') .
                    $order->id .
                    number_format($order->total, 2, '.', '') .
                    'LKR' .
                    strtoupper(md5(env('PAYHERE_SECRET')))
            )
        );

        return view('payment.pay', compact('order', 'hash'));
    }

    public function return($orderId)
    {
        // $order = new Order();
        // $order = $order->getOrder(base64_decode(urldecode($orderId)));
        echo 'Payment Successfull';
    }
}
