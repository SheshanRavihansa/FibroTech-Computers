<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (!function_exists('imageCheck')) {
    function imageCheck($image)
    {
        if (!$image) {
            return URL::asset('images/placeholder.jpg');
        }
        //check if valid url
        if (str_contains($image, 'http')) {
            return $image;
            //check if image exists in storage
        } elseif (Storage::disk('public')->exists($image)) {
            return URL::asset('storage/' . $image);
        }
        return URL::asset('images/placeholder.jpg');
    }
}

if (!function_exists('isRouteActive')) {
    function isRouteActive(array $routeName)
    {
        return in_array(Route::currentRouteName(), $routeName);
    }
}

class Helper
{
    public static function getAllCategory()
    {
        $category = new Category();
        $activeCat = $category->getAllMainsWithSubcats();
        return $activeCat;
    }

    public static function getAllProductFromCart()
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->get();
        } else {
            return 0;
        }
    }
    public static function totalCartPrice()
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('amount');
        } else {
            return 0;
        }
    }
}
