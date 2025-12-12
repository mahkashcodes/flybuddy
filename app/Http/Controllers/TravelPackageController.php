<?php
// app/Http/Controllers/TravelPackageController.php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use App\Models\Destination;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    public function index()
    {
        $packages = TravelPackage::with('destination')
            ->where('is_active', true)
            ->orderBy('price')
            ->paginate(12);
            
        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = TravelPackage::with('destination')->findOrFail($id);
        return view('packages.show', compact('package'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('packages.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'max_people' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        // Convert inclusions/exclusions from string to array
        if ($request->inclusions) {
            $validated['inclusions'] = json_encode(explode(',', $request->inclusions));
        }
        if ($request->exclusions) {
            $validated['exclusions'] = json_encode(explode(',', $request->exclusions));
        }

        // Set default for is_active if not provided
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        TravelPackage::create($validated);

        return redirect()->route('packages.index')
            ->with('success', 'Travel package created successfully!');
    }

    public function edit($id)
    {
        $package = TravelPackage::findOrFail($id);
        $destinations = Destination::where('is_active', true)->get();
        return view('packages.edit', compact('package', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $package = TravelPackage::findOrFail($id);
        
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'max_people' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        // Convert to array
        if ($request->inclusions) {
            $validated['inclusions'] = json_encode(explode(',', $request->inclusions));
        }
        if ($request->exclusions) {
            $validated['exclusions'] = json_encode(explode(',', $request->exclusions));
        }

        $package->update($validated);

        return redirect()->route('packages.index')
            ->with('success', 'Package updated successfully!');
    }

    public function destroy($id)
    {
        $package = TravelPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully!');
    }

    // ==================== ADD THESE MISSING METHODS ====================
    
    /**
     * Search packages (for Ajax search in your destinations blade)
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $packages = TravelPackage::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('destination', function($q2) use ($query) {
                      $q2->where('name', 'like', "%{$query}%")
                         ->orWhere('country', 'like', "%{$query}%");
                  });
            })
            ->limit(10)
            ->get();
        
        return response()->json($packages);
    }

    /**
     * Get featured packages for API
     */
    public function featured()
    {
        $packages = TravelPackage::with('destination')
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        
        return response()->json($packages);
    }

    /**
     * API search for packages
     */
    public function apiSearch(Request $request)
    {
        $query = $request->get('q');
        
        $packages = TravelPackage::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get(['id', 'name', 'price', 'image_url']);
        
        return response()->json($packages);
    }
}