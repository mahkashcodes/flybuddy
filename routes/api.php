<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are for your React frontend to communicate with Laravel.
| All routes here will be prefixed with /api
|
*/

// Public API routes
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{id}', [DestinationController::class, 'show']);
Route::get('/destinations/search', [DestinationController::class, 'search']);
Route::get('/featured-destinations', [DestinationController::class, 'featured']);

Route::get('/packages', [TravelPackageController::class, 'index']);
Route::get('/packages/{id}', [TravelPackageController::class, 'show']);
Route::get('/packages/search', [TravelPackageController::class, 'apiSearch']);
Route::get('/featured-packages', [TravelPackageController::class, 'featured']);

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Protected routes (need authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Create
    Route::post('/destinations', [DestinationController::class, 'store']);
    Route::post('/packages', [TravelPackageController::class, 'store']);
    
    // Update
    Route::put('/destinations/{id}', [DestinationController::class, 'update']);
    Route::put('/packages/{id}', [TravelPackageController::class, 'update']);
    
    // Delete
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy']);
    Route::delete('/packages/{id}', [TravelPackageController::class, 'destroy']);
    
    // Get current user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});