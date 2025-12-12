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
// ==================== CART ROUTES ====================
use App\Http\Controllers\CartController;

// Debug route to check if destinations.show exists
Route::get('/debug-routes', function() {
    echo "<h3>Checking Destination Routes:</h3>";
    
    $routes = Route::getRoutes()->getRoutesByName();
    
    if (isset($routes['destinations.show'])) {
        echo "<p style='color:green'>✅ Route 'destinations.show' EXISTS!</p>";
        echo "<pre>";
        print_r([
            'uri' => $routes['destinations.show']->uri,
            'method' => $routes['destinations.show']->methods,
            'action' => $routes['destinations.show']->action['controller'] ?? 'Closure',
        ]);
        echo "</pre>";
    } else {
        echo "<p style='color:red'>❌ Route 'destinations.show' DOES NOT EXIST!</p>";
    }
    
    echo "<h3>All Destination Routes:</h3>";
    foreach ($routes as $name => $route) {
        if (strpos($name, 'destinations') !== false) {
            echo "<p>{$name} => {$route->uri}</p>";
        }
    }
    
    return "";
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update/{key}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.process');
    Route::get('/success', function() {
        return view('cart.success');
    })->name('cart.success');
});
// routes/web.php
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{key}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Add to routes/web.php
Route::get('/debug-auth', function() {
    if (!Auth::check()) {
        return "Not logged in";
    }
    
    $user = Auth::user();
    $freshUser = \App\Models\User::find($user->id);
    
    echo "<h3>User Info:</h3>";
    echo "Email: " . $user->email . "<br>";
    echo "is_admin (from Auth): " . json_encode($user->is_admin) . " (type: " . gettype($user->is_admin) . ")<br>";
    echo "Raw is_admin: " . $user->getRawOriginal('is_admin') . "<br>";
    echo "Fresh from DB is_admin: " . $freshUser->is_admin . "<br>";
    echo "<br><strong>Check: !\$user->is_admin = " . (!$user->is_admin ? 'TRUE (WILL BLOCK)' : 'FALSE (WILL ALLOW)') . "</strong><br>";
    
    echo "<h3>Test Login:</h3>";
    echo "<a href='/login'>Login Page</a><br>";
    echo "<h3>Test Dashboard:</h3>";
    echo "<a href='/dashboard'>Dashboard</a>";
    
    return "";
});

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


// Temporary route for testing
Route::get('/test', function() {
    return "Test route working!";
});

// Remove or comment out this Laravel default route!
// Route::get('/', function () {
//     return view('welcome');
// });