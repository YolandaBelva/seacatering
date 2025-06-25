<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MealPlanController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TestimonialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return response()->json(['message' => 'API aktif!']);
});

Route::apiResource('users', UserController::class);


Route::prefix('meal-plans')->group(function () {
    Route::get('/', [MealPlanController::class, 'index']);
    Route::get('/{id}', [MealPlanController::class, 'show']);
    Route::post('/', [MealPlanController::class, 'store']);
    Route::put('/{id}', [MealPlanController::class, 'update']);
    Route::delete('/{id}', [MealPlanController::class, 'destroy']);
});

Route::prefix('subscriptions')->group(function () {
    Route::get('/', [SubscriptionController::class, 'index']);         
    Route::get('/{id}', [SubscriptionController::class, 'show']);      
    Route::post('/', [SubscriptionController::class, 'subscribe']);    
    Route::put('/{id}', [SubscriptionController::class, 'update']);    
    Route::delete('/{id}', [SubscriptionController::class, 'destroy']);
});

Route::prefix('testimonials')->group(function () {
    Route::get('/', [TestimonialController::class, 'index']);
    Route::post('/', [TestimonialController::class, 'store']);
});