@extends('layouts.web')
{{-- @section('main-content')
    @auth
        <h1>You are logged in !</h1>
        @role('admin')
            <h1>I am an admin!</h1>
        @else
            <h1>I am an user...</h1>
            <h1><a href="{{ route('admin.dashboard') }}">dashboard</a></h1>
        @endrole

        <h1><a href="{{ route('logout') }}">Logout</a></h1>
    @else
        <h1>Please <a href="{{ route('login') }}">LogIn</a> !</h1>
    @endauth
@endsection --}}
