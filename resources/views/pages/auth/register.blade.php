@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection
@section('app')
    <div class="body-container">
        <div class="credentials-header">
            <span class="header-span">Register</span>
        </div>
        <div class="credentials-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <label for="name" class="label">Name</label>
                <input type="text" id="name" class="form-control form-input" name="name" placeholder="Enter your name">
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="email" class="label">Email</label>
                <input type="email" id="email" class="form-control form-input" name="email" placeholder="Enter your email">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="phone" class="label">Phone Number</label>
                <input type="text" id="phone" class="form-control form-input" name="phone" placeholder="Enter your phone number">
                @error('phone')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="form-control form-input" name="password" placeholder="Enter your password">
                @error('password')
                  <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="password_confirmation" class="label">Password Confirmation</label>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Enter your password again">
                @error('password_confirmation')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
                <span class="redirect-span">Already Have An Account? <a class="redirect-link" href="{{ route('login') }}">Log in</a></span>
                <button class="btn btn-primary submit-btn" type="submit">Register</button>
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