<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Query;
use App\Models\Property;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Store a new query (user contacting agent)
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message' => 'required|string|max:1000',
        ]);

        $property = Property::find($request->property_id);

        if(!$property){
            return response()->json(['message' => 'Property not found'], 404);
        }

        $query = Query::create([
            'property_id' => $request->property_id,
            'user_id' => $request->user()->id,
            'agent_id' => $property->user_id, // safely get agent
            'message' => $request->message,
        ]);

        return response()->json([
            'message' => 'Query sent successfully',
            'query' => $query
        ], 201);
    }

    /**
     * Optional: list all queries for logged-in user (optional)
     */
    public function index(Request $request)
    {
        $queries = Query::where('user_id', $request->user()->id)
            ->with(['property', 'user']) // user refers to the agent in some contexts, but let's just use what's in the model
            ->get();

        return response()->json($queries);
    }
}
