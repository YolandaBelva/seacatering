<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

Route::get('/userdashboard', function () {
    return view('userdashboard');
})->name('userdashboard');

Route::get('/admindashboard', function () {
    return view('admindashboard');
})->name('admindashboard');

Route::apiResource('users', UserController::class);

// Route::get('/login/google', [GoogleController::class, 'redirect'])->name('login.google');
// Route::get('/login/google/callback', [GoogleController::class, 'callback']);
