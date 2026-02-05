<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryApiController extends Controller
{
    // List queries for the logged-in user
    public function index()
    {
        $user = Auth::user();

        $queries = Query::with('property', 'agent', 'user')
                    ->where('user_id', $user->id)
                    ->orWhere('agent_id', $user->id)
                    ->latest()
                    ->get();

        return response()->json($queries);
    }

    // Store query (User → Agent)
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message'     => 'required|string',
        ]);

        $property = \App\Models\Property::findOrFail($request->property_id);

        $query = Query::create([
            'property_id' => $property->id,
            'agent_id'    => $property->user_id,
            'user_id'     => Auth::id(),
            'message'     => $request->message
        ]);

        return response()->json($query, 201);
    }
}
