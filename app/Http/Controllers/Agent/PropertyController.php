<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->with('category')->latest()->get();
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
            'area' => 'required|numeric',
            'location' => 'required|string',
            'type' => 'required|in:buy,rent',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $property = Property::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'area' => $request->area,
            'location' => $request->location,
            'type' => $request->type,
            'availability' => 'available',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('agent.properties.index')->with('success', 'Property listed successfully');
    }

    public function edit(Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        $categories = Category::all();
        return view('agent.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'area' => 'required|numeric',
            'location' => 'required|string',
            'type' => 'required|in:buy,rent',
            'availability' => 'required|in:available,sold',
        ]);

        $property->update($request->all());

        return redirect()->route('agent.properties.index')->with('success', 'Property updated successfully');
    }

    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        $property->delete();
        return redirect()->route('agent.properties.index')->with('success', 'Property deleted successfully');
    }
}
