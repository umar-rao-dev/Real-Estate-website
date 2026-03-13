<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', auth()->id())->with('category')->latest()->get();
        return view('agent.properties.index', compact('properties'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('agent.properties.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'area' => 'required|integer',
            'location' => 'required',
            'type' => 'required|in:buy,rent',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $property = Property::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'area' => $request->area,
            'location' => $request->location,
            'type' => $request->type,
            'status' => 'pending', // Strictly pending for agents
            'availability' => 'available'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('agent.properties.index')->with('success', 'Property submitted for admin approval.');
    }

    public function edit(Property $property)
    {
        if ($property->user_id !== auth()->id()) abort(403);
        $categories = Category::all();
        return view('agent.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== auth()->id()) abort(403);
        
        $property->update($request->all());
        
        // Reset to pending if name or description changed? For now keep simple.
        // But per requirement, agent changes should stay or go back to pending.
        $property->update(['status' => 'pending']);

        return redirect()->route('agent.properties.index')->with('success', 'Property updated and resubmitted for approval.');
    }

    public function destroy(Property $property)
    {
        if ($property->user_id !== auth()->id()) abort(403);
        $property->delete();
        return redirect()->route('agent.properties.index')->with('success', 'Property deleted.');
    }
}
