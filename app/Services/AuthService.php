<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthService {
    public function createUser ($request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' =>$request->phone
        ]);

        Session::flash('success', 'User Registered Successfully');
        return $user;
    }

    public function processLogin ($request) {
        $credentials = $request->except(['_token']);

        $user = User::where('email', $request->name)->first();

        if (auth()->attempt($credentials)) {
            return true;
        } else {
            Session::flash('error', 'Invalid credentials');
            return false;
        }
    }
}