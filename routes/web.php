<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register');

Route::group(['middleware' => ['auth']], function () {
    //Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Flights
    Route::resource('/flights', FlightController::class);
    Route::get('/api/getCitiesByCountry/{country}', [CitiesController::class, 'getCitiesByCountry']);
    Route::get('/flight/search', [FlightController::class, 'search']);

    //Tickets
    Route::resource('/tickets', TicketController::class);
});
Route::get('/', [FlightController::class, 'index'])->name('home');

