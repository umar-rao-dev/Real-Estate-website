<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return response()->json(Property::with(['images', 'category', 'user'])
            ->where('is_approved', true)
            ->get());
    }

    public function show($id)
    {
        $property = Property::with(['images', 'category', 'user'])->findOrFail($id);
        return response()->json($property);
    }

    public function search(Request $request)
    {
        $query = Property::with(['images', 'category', 'user'])->where('is_approved', true);

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('location', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get());
    }
}
