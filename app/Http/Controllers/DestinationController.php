<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        // For now, return empty view or some dummy data
        return view('destinations.index', [
            'destinations' => [] // Empty array for now
        ]);
    }
    
    public function create()
    {
        return view('destinations.create');
    }
    
    public function store(Request $request)
    {
        // Will implement later
        return redirect()->route('destinations.index');
    }
    
    public function show($id)
    {
        return view('destinations.show', ['id' => $id]);
    }
    
    public function edit($id)
    {
        return view('destinations.edit', ['id' => $id]);
    }
    
    public function update(Request $request, $id)
    {
        return redirect()->route('destinations.index');
    }
    
    public function destroy($id)
    {
        return redirect()->route('destinations.index');
    }
    
    public function search(Request $request)
    {
        // For Ajax search
        return response()->json([]);
    }
    
    public function featured()
    {
        // Return some dummy data for now
        return response()->json([
            [
                'id' => 1,
                'name' => 'Bali, Indonesia',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Beautiful tropical paradise with stunning beaches and temples.',
                'country' => 'Indonesia',
                'starting_price' => 1200
            ],
            [
                'id' => 2,
                'name' => 'Paris, France',
                'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'The city of love with iconic landmarks and rich history.',
                'country' => 'France',
                'starting_price' => 1500
            ],
            [
                'id' => 3,
                'name' => 'Tokyo, Japan',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Vibrant metropolis blending tradition with modernity.',
                'country' => 'Japan',
                'starting_price' => 1800
            ],
            [
                'id' => 4,
                'name' => 'New York, USA',
                'image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'The city that never sleeps with endless attractions.',
                'country' => 'USA',
                'starting_price' => 2000
            ]
        ]);
    }
    
    public function apiSearch(Request $request)
    {
        // Dummy search results
        return response()->json([
            [
                'id' => 1,
                'name' => 'Bali',
                'country' => 'Indonesia',
                'continent' => 'Asia',
                'starting_price' => 1200
            ],
            [
                'id' => 2,
                'name' => 'Paris',
                'country' => 'France',
                'continent' => 'Europe',
                'starting_price' => 1500
            ]
        ]);
    }
}