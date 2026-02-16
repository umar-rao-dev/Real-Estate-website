<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images', 'category', 'user')
            ->where('availability', 'available');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('location', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $properties = $query->latest()->paginate(9);
        $categories = Category::all();

        return view('user.properties.index', compact('properties', 'categories'));
    }

    public function show($id)
    {
        $property = Property::with(['images', 'user', 'category'])->findOrFail($id);
        return view('user.properties.show', compact('property'));
    }
}
