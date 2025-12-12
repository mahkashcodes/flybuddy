<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TravelPackageController extends Controller
{
    public function index()
    {
        $packages = TravelPackage::with('destination')->paginate(12);
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('packages.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destination_id' => 'required|exists:destinations,id',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'package_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->except('_token');
        
        if ($request->hasFile('package_image')) {
            $imagePath = $request->file('package_image')->store('packages', 'public');
            $data['package_image'] = $imagePath;
        }
        
        TravelPackage::create($data);
        
        return redirect()->route('packages.index')
            ->with('success', 'Travel package created successfully!');
    }

    public function show($id)
    {
        $package = TravelPackage::with('destination')->findOrFail($id);
        return view('packages.show', compact('package'));
    }

    public function edit($id)
    {
        $package = TravelPackage::findOrFail($id);
        $destinations = Destination::all();
        return view('packages.edit', compact('package', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destination_id' => 'required|exists:destinations,id',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'package_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        
        $package = TravelPackage::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('package_image')) {
            if ($package->package_image) {
                Storage::disk('public')->delete($package->package_image);
            }
            
            $imagePath = $request->file('package_image')->store('packages', 'public');
            $data['package_image'] = $imagePath;
        }
        
        $package->update($data);
        
        return redirect()->route('packages.index')
            ->with('success', 'Travel package updated successfully!');
    }

    public function destroy($id)
    {
        $package = TravelPackage::findOrFail($id);
        
        if ($package->package_image) {
            Storage::disk('public')->delete($package->package_image);
        }
        
        $package->delete();
        
        return redirect()->route('packages.index')
            ->with('success', 'Travel package deleted successfully!');
    }
    
  public function search(Request $request)
{
    $query = $request->input('query');
    
    $packages = TravelPackage::with('destination')
        ->where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->orWhere('inclusions', 'like', "%$query%")
        ->orWhereHas('destination', function($q) use ($query) {
            $q->where('name', 'like', "%$query%")
              ->orWhere('country', 'like', "%$query%")
              ->orWhere('continent', 'like', "%$query%");
        })
        ->take(10)
        ->get(['id', 'title', 'price', 'duration_days', 'package_image', 'destination_id']);
        
    // Load destination names
    $packages->load('destination:id,name');
    
    return response()->json($packages);
}
}