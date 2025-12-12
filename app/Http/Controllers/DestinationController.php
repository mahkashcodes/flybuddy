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
    // Debug: Check if view exists
    if (!view()->exists('destinations.create')) {
        dd('ERROR: View file destinations.create.blade.php does not exist!');
    }
    
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

        $data = $request->except('_token');
        
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('destinations', 'public');
            $data['featured_image'] = $imagePath;
        }
        
        Destination::create($data);
        
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
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('featured_image')) {
            if ($destination->featured_image) {
                Storage::disk('public')->delete($destination->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('destinations', 'public');
            $data['featured_image'] = $imagePath;
        }
        
        $destination->update($data);
        
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