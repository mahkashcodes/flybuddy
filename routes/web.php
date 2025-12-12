<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Main Pages (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Viewing Routes (No Auth Required)
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/packages', [TravelPackageController::class, 'index'])->name('packages.index');

// Admin-only Routes (must come BEFORE parameterized routes)
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard - Only for admins
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
    Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');
    
    Route::get('/packages/create', [TravelPackageController::class, 'create'])->name('packages.create');
    Route::get('/packages/{id}/edit', [TravelPackageController::class, 'edit'])->name('packages.edit');
    Route::post('/packages', [TravelPackageController::class, 'store'])->name('packages.store');
    Route::put('/packages/{id}', [TravelPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{id}', [TravelPackageController::class, 'destroy'])->name('packages.destroy');
});

// Parameterized routes (come AFTER specific routes)
Route::get('/packages/{id}', [TravelPackageController::class, 'show'])->name('packages.show');
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

// Search Routes (Public)
Route::get('/destinations/search', [DestinationController::class, 'search'])->name('destinations.search');
Route::get('/packages/search', [TravelPackageController::class, 'search'])->name('packages.search');

// API Routes (for Ajax calls - Public)
Route::get('/api/featured-destinations', [DestinationController::class, 'featured']);
Route::get('/api/featured-packages', [TravelPackageController::class, 'featured']);
Route::get('/api/destinations/search', [DestinationController::class, 'apiSearch']);

// Newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');

// ==================== PROTECTED ROUTES ====================
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

// Temporary route for testing
Route::get('/test', function() {
    return "Test route working!";
});

// Remove or comment out this Laravel default route!
// Route::get('/', function () {
//     return view('welcome');
// });