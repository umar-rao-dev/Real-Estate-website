<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['user', 'category'])->latest()->get();
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
            'location' => 'required',
            'type' => 'required|in:buy,rent',
        ]);

        $property = new Property($request->all());
        $property->user_id = auth()->id();
        $property->status = 'approved'; // Admin-created properties are auto-approved
        $property->save();

        return redirect()->route('admin.properties.index')->with('success', 'Property created and auto-approved.');
    }

    public function edit(Property $property)
    {
        $categories = Category::all();
        return view('admin.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());
        return redirect()->route('admin.properties.index')->with('success', 'Property updated.');
    }

    public function approve(Property $property)
    {
        $property->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Property approved successfully.');
    }

    public function reject(Property $property)
    {
        $property->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Property rejected.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted.');
    }
}
