<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/subscription', function () {
    return view('subscription');
})->name('subscription');

Route::get('/meal_plans', function () {
    return view('meal_plans');
})->name('meal_plans');

// Route::get('/login/google', [GoogleController::class, 'redirect'])->name('login.google');
// Route::get('/login/google/callback', [GoogleController::class, 'callback']);