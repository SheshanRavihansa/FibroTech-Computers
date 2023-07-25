<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;

class AdminController extends Controller
{
    public function settings()
    {
        $data = Setting::first();
        // dd($data);
        return view('admin.pages.settings')->with('data', $data);
    }
}
