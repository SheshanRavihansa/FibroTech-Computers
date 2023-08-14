<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $user_id = auth()->user()->id;

        if (empty($request->slug)) {
            return back()->with('error', 'Invalid Products');
        }
        $product = Product::where('slug', $request->slug)->first();
        $product_price = ($product->price - ($product->price * $product->discount) / 100);

        if (empty($product)) {
            return back()->with('error', 'Invalid Products');
        }
        $already_cart = Cart::where('user_id', $user_id)->where('order_id', null)->where('product_id', $product->id)->first();
        if ($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product_price + $already_cart->amount;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0)
                return back()->with('error', 'Stock not sufficient!.');
            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->id;
            $cart->price = $product_price;
            $cart->quantity = 1;
            $cart->amount = $cart->price * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0)
                return back()->with('error', 'Stock not sufficient!.');
            $cart->save();
        }
        return back()->with('success', 'Product successfully added to cart.');
    }

    public function singleAddToCart(Request $request)
    {
        $user_id = auth()->user()->id;
        $quantity = $request->quant[1];
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        // dd($request->quant[1]);

        $product = Product::where('slug', $request->slug)->first();
        $product_price = ($product->price - ($product->price * $product->discount) / 100);
        if ($product->stock < $quantity) {
            return back()->with('error', 'Out of stock, You can add other products.');
        }
        if (($quantity < 1) || empty($product)) {
            return back()->with('error', 'Invalid Products');;
        }
        $already_cart = Cart::where('user_id', $user_id)->where('order_id', null)->where('product_id', $product->id)->first();
        if ($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $quantity;
            $already_cart->amount = ($product_price * $quantity) + $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0)
                return back()->with('error', 'Stock not sufficient!.');

            $already_cart->save();
        } else {

            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->id;
            $cart->price = $product_price;
            $cart->quantity = $quantity;
            $cart->amount = ($product_price * $quantity);
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error', 'Stock not sufficient!.');
            $cart->save();
        }
        return back()->with('success', 'Product successfully added to cart.');;
    }

    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);
        // dd($cart);
        if ($cart) {
            $cart->delete();
            return back()->with('success', 'Cart item successfully removed!.');
        }
        return back()->with('error', 'Error please try again!.');
    }

    public function cartUpdate(Request $request)
    {
        // dd($request->all());
        if ($request->quant) {
            $error = array();
            $success = '';
            foreach ($request->quant as $k => $quant) {

                $id = $request->qty_id[$k];

                $cart = Cart::find($id);

                if ($quant > 0 && $cart) {

                    if ($cart->product->stock < $quant) {
                        // request()->session()->flash('error','Out of stock');
                        return back()->with('error', 'Out Of Stock');
                    }
                    $cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;

                    if ($cart->product->stock <= 0) continue;
                    $after_price = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $cart->amount = $after_price * $quant;

                    $cart->save();
                    $success = 'Cart successfully updated!';
                } else {
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->with($error)->with('success', $success);
        } else {
            return back()->with('Cart Invalid!');
        }
    }

    public function checkout(Request $request)
    {
        return view('web.pages.checkout');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
