<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    public function index()
    {
        return view('packages.index', [
            'packages' => [] // Empty for now
        ]);
    }
    
    public function create()
    {
        return view('packages.create');
    }
    
    public function store(Request $request)
    {
        return redirect()->route('packages.index');
    }
    
    public function show($id)
    {
        return view('packages.show', ['id' => $id]);
    }
    
    public function edit($id)
    {
        return view('packages.edit', ['id' => $id]);
    }
    
    public function update(Request $request, $id)
    {
        return redirect()->route('packages.index');
    }
    
    public function destroy($id)
    {
        return redirect()->route('packages.index');
    }
    
    public function search(Request $request)
    {
        return response()->json([]);
    }
    
    public function featured()
    {
        // Dummy data for featured packages
        return response()->json([
            [
                'id' => 1,
                'title' => 'Bali Paradise Getaway',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => '7 days in beautiful Bali with luxury accommodation and guided tours.',
                'price' => 1299,
                'duration' => 7
            ],
            [
                'id' => 2,
                'title' => 'Paris Romance Tour',
                'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => '5 days exploring the romantic city of Paris with fine dining.',
                'price' => 1599,
                'duration' => 5
            ],
            [
                'id' => 3,
                'title' => 'Tokyo Adventure',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => '10 days experiencing modern and traditional Japan.',
                'price' => 2299,
                'duration' => 10
            ]
        ]);
    }
}