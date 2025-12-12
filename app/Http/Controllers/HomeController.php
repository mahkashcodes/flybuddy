<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TravelPackage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function featuredDestinations()
    {
        // Return featured destinations for Ajax call
        $destinations = Destination::take(4)->get();
        return response()->json($destinations);
    }
    
    public function featuredPackages()
    {
        // Return featured packages for Ajax call
        $packages = TravelPackage::with('destination')
            ->take(3)
            ->get();
        return response()->json($packages);
    }
    
    public function subscribe(Request $request)
    {
        // Simple newsletter subscription
        $request->validate([
            'email' => 'required|email'
        ]);
        
        // Here you would save to database
        // For now, just return success
        
        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing!'
        ]);
    }
}