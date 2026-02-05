<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyApiController extends Controller
{
    // List all properties
    public function index()
    {
        $properties = Property::with('agent', 'category', 'images')->latest()->get();
        return response()->json($properties);
    }

    // Show single property
    public function show($id)
    {
        $property = Property::with('agent', 'category', 'images')->findOrFail($id);
        return response()->json($property);
    }

    // Search properties
    public function search(Request $request)
    {
        $query = Property::with('agent', 'category', 'images');

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('location', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('type')) {
            $query->where('status', $request->type);
        }

        $properties = $query->latest()->get();

        return response()->json($properties);
    }
}
