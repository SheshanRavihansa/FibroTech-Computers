@extends('layouts.web')
@section('main-content')
    @auth
        <h1>You are logged in !</h1>
        <h1><a href="{{ route('logout') }}">Logout</a></h1>
    @else
        <h1>Please <a href="{{ route('login') }}">LogIn</a> !</h1>
    @endauth
@endsection
