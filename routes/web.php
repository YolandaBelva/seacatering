<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\UserController;

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

Route::get('/testimonial', function () {
    return view('testimonial');
})->middleware('auth');


Route::get('/userdashboard', function () {
    return view('userdashboard');
})->name('userdashboard');

Route::get('/admindashboard', function () {
    return view('admindashboard');
})->name('admindashboard');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
