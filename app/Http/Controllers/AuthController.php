<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    public $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }
    public function register () {
        return view ('pages.auth.register');
    }
    public function processRegister(RegisterRequest $request)
    {        
        $this->authService->createUser($request);
        return redirect()->route('login');
    }
    public function login()
    {
        return view('pages.auth.login');
    }
    public function processLogin(LoginRequest $request)
    {
        if($this->authService->processLogin($request)) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
    public function logout()
    { 
        Auth::logout();
        return redirect()->route('home');
    }
}
