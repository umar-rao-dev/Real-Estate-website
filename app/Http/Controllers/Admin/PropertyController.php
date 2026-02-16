<?php

namespace App\Http\Controllers\Admin;

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
        $properties = Property::with('category', 'user')->latest()->get();
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.properties.create', compact('categories'));
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
            'location' => 'required|string',
            'type' => 'required|in:buy,rent',
            'availability' => 'required|in:available,sold',
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
            'availability' => $request->availability,
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

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully');
    }

    public function edit(Property $property)
    {
        $categories = Category::all();
        $property->load('images');
        return view('admin.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'area' => 'required|integer',
            'location' => 'required|string',
            'type' => 'required|in:buy,rent',
            'availability' => 'required|in:available,sold',
        ]);

        $property->update($request->all());

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully');
    }
}
