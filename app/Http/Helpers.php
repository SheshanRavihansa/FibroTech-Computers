<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

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
    function isRouteActive($routeName)
    {
        return Route::currentRouteName() === $routeName;
    }
}
