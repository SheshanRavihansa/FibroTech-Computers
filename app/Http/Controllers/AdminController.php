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
        return view('admin.pages.settings')->with('data', $data);
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'short_des' => 'required|string',
            'description' => 'string',
            'logo' => 'required',
        ]);

        $data = $request->all();
        // dump($data);
        $settings = Setting::first();
        // dd($settings);
        $status = $settings->fill($data)->save();

        if ($status) {
            $request->session()->flash('success', 'Setting successfully updated');
        } else {
            $request->session()->flash('error', 'Please try again');
        }

        return back();
    }
}
