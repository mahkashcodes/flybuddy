<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;  // Add this import
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(12);
        return view('destinations.index', compact('destinations'));
    }
    
    public function create()
    {
        return view('destinations.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'country' => 'required|max:100',
            'continent' => 'required|max:50',
            'starting_price' => 'required|numeric|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $destination = new Destination();
        $destination->name = $request->name;
        $destination->description = $request->description;
        $destination->country = $request->country;
        $destination->continent = $request->continent;
        $destination->best_time_to_visit = $request->best_time_to_visit;
        $destination->starting_price = $request->starting_price;
        $destination->is_featured = $request->has('is_featured') ? 1 : 0;
        $destination->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('destinations', 'public');
            $destination->featured_image = $imagePath;
        }

        $destination->save();
        
        return redirect()->route('destinations.index')
            ->with('success', 'Destination created successfully!');
    }
    
    public function show($id)  // Changed from show(Destination $destination)
    {
        $destination = Destination::findOrFail($id);
        return view('destinations.show', compact('destination'));
    }
    
    public function edit($id)  // Changed from edit(Destination $destination)
    {
        $destination = Destination::findOrFail($id);
        return view('destinations.edit', compact('destination'));
    }
    
    public function update(Request $request, $id)  // Changed parameter
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'country' => 'required|max:100',
            'continent' => 'required|max:50',
            'starting_price' => 'required|numeric|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $destination = Destination::findOrFail($id);

        $destination->name = $request->name;
        $destination->description = $request->description;
        $destination->country = $request->country;
        $destination->continent = $request->continent;
        $destination->best_time_to_visit = $request->best_time_to_visit;
        $destination->starting_price = $request->starting_price;
        $destination->is_featured = $request->has('is_featured') ? 1 : 0;
        $destination->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            if ($destination->featured_image) {
                Storage::disk('public')->delete($destination->featured_image);
            }

            $imagePath = $request->file('featured_image')->store('destinations', 'public');
            $destination->featured_image = $imagePath;
        }

        $destination->save();
        
        return redirect()->route('destinations.index')
            ->with('success', 'Destination updated successfully!');
    }
    
    public function destroy($id)  // Changed from destroy(Destination $destination)
    {
        $destination = Destination::findOrFail($id);
        
        if ($destination->featured_image) {
            Storage::disk('public')->delete($destination->featured_image);
        }
        
        $destination->delete();
        
        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
    
public function search(Request $request)
{
    $query = $request->input('query');
    
    $destinations = Destination::where('name', 'like', "%$query%")
        ->orWhere('country', 'like', "%$query%")
        ->orWhere('continent', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->take(10)
        ->get(['id', 'name', 'country', 'continent', 'starting_price', 'featured_image']);
        
    return response()->json($destinations);
}
    
    public function featured()
    {
        $destinations = Destination::where('is_featured', true)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return response()->json($destinations);
    }
    
    public function apiSearch(Request $request)
    {
        $query = $request->input('query');
        
        $destinations = Destination::where('name', 'like', "%$query%")
            ->orWhere('country', 'like', "%$query%")
            ->orWhere('continent', 'like', "%$query%")
            ->take(5)
            ->get(['id', 'name', 'country', 'continent', 'starting_price']);
            
        return response()->json($destinations);
    }
}