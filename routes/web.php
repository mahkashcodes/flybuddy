<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TravelPackageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Destinations Module (First Module)
Route::resource('destinations', DestinationController::class);
Route::get('/destinations/search', [DestinationController::class, 'search'])->name('destinations.search');

// Travel Packages Module (Second Module)
Route::resource('packages', TravelPackageController::class);
Route::get('/packages/search', [TravelPackageController::class, 'search'])->name('packages.search');

// Authentication Routes (Temporary - for testing)
Route::get('/login', function() {
    return 'Login Page - Add Laravel Breeze or Jetstream later';
})->name('login');

Route::get('/dashboard', function() {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

// API Routes (for Ajax calls)
Route::get('/api/featured-destinations', [DestinationController::class, 'featured']);
Route::get('/api/featured-packages', [TravelPackageController::class, 'featured']);
Route::get('/api/destinations/search', [DestinationController::class, 'apiSearch']);

// Newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');

// Temporary route for testing
Route::get('/test', function() {
    return view('test');
});