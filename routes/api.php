<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MealPlanController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\SubscriptionController;

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/users', [AuthController::class, 'indexAll']);
    Route::put('/users/{id}/role', [AuthController::class, 'updateRole']);
});
// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Meal Plans (public)
Route::get('/mealplans', [MealPlanController::class, 'index']);

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::middleware('auth:sanctum')->post('/testimonials', [TestimonialController::class, 'store']);

// Subscriptions
Route::middleware('auth:sanctum')->group(function () {
    // Simpan subscription
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);

    // Tampilkan subscription milik user yang sedang login
    Route::get('/subscriptions', [SubscriptionController::class, 'indexByUser']);
    Route::put('/subscriptions/{id}/pause', [SubscriptionController::class, 'pause']);
    Route::put('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'getByDateRange']);
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'indexAll']);
    Route::get('/subscriptions/filter', [SubscriptionController::class, 'filterByDate']);

});

// Admin-only: Tampilkan semua subscriptions
Route::middleware(['auth:sanctum'])->get('/admin/subscriptions', [SubscriptionController::class, 'indexAll']);
Route::middleware(['auth:sanctum'])->get('/admin/revenue', [SubscriptionController::class, 'getMonthlyRevenue']);
Route::get('/admin/reactivations', [SubscriptionController::class, 'getReactivations']);
Route::get('/admin/active-subscriptions', [SubscriptionController::class, 'getTotalActiveSubscriptions']);



