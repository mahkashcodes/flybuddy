<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Destination;
use App\Models\TravelPackage;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }
    
    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Use model helper for admin check
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
            }

            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }
    
    // Handle Registration - FIXED
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,  // Explicitly set to false
        ]);
        
        // FIXED: Added semicolon and proper syntax
        Log::info('New user registered:', [
            'email' => $user->email,
            'is_admin' => $user->is_admin
        ]);
        
        Auth::login($user);
        
        return redirect()->route('home')->with('success', 'Account created successfully!');
    }
    
    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    }
    
    // Admin Dashboard - FIXED
    public function dashboard()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        // Get the authenticated user
        $user = Auth::user();
        
        // DEBUG: Check user's admin status
        Log::info('Dashboard access check:', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'is_admin' => $user->is_admin,
            'is_admin_type' => gettype($user->is_admin),
            'is_admin_value' => $user->is_admin
        ]);
        
        // Check if user is admin using model helper
        if (!$user->isAdmin()) {
            // Double check with fresh DB value
            $isAdminFromDB = User::find($user->id)->isAdmin();

            Log::warning('Non-admin user blocked from dashboard:', [
                'user_id' => $user->id,
                'is_admin' => $user->is_admin,
                'fresh_from_db' => $isAdminFromDB
            ]);

            return redirect()->route('home')
                ->with('error', '⚠️ Access denied. Admin privileges required.');
        }
        
        // User is admin - show dashboard
        Log::info('Admin accessing dashboard:', ['user_id' => $user->id]);
        
        // Get counts for dashboard
        $destinationCount = Destination::count();
        $packageCount = TravelPackage::count();
        $featuredDestinationCount = Destination::where('is_featured', true)->count();
        $activePackageCount = TravelPackage::where('is_active', true)->count();
        $usersCount = User::count();
        
        // Get latest additions
        $latestDestinations = Destination::latest()->take(5)->get();
        $latestPackages = TravelPackage::with('destination')->latest()->take(5)->get();
        
        return view('dashboard.index', compact(
            'destinationCount', 
            'packageCount',
            'featuredDestinationCount',
            'activePackageCount',
            'usersCount',
            'latestDestinations',
            'latestPackages'
        ));
    }
}