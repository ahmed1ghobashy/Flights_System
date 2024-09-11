@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection
@section('app')
    <div class="body-container">
        <div class="credentials-header">
            <span class="header-span">Login</span>
        </div>
        <div class="credentials-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <label for="email" class="label">Email</label>
                <input type="email" id="email" class="form-control form-input" name="email" placeholder="Enter your email">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="form-control form-input" name="password" placeholder="Enter your password">
                @error('password')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <span class="redirect-span">Don't Have An Account Yet? <a class="redirect-link" href="{{ route('register') }}">Register</a></span>
                
                <button class="btn btn-primary submit-btn" type="submit">Login</button>
            </form>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger mt-3">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>
@endsection