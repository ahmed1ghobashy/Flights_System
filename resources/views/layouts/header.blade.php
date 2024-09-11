@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
@endsection
@section('app')
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" style="font-weight: bold">Flights System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('flights/create') }}">Add Flight</a>
                        </li>
                    @endif
                    @if (Auth::user())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('tickets') }}">My Bookings</a>
                        </li>
                    @endif
                </ul>
                @if (Auth::user())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endif
            </div>
        </div>
    </nav>
    @yield('body')
@endsection
