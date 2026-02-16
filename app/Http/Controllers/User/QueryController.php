<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Query;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message' => 'required|string',
        ]);

        $property = Property::findOrFail($request->property_id);

        Query::create([
            'property_id' => $property->id,
            'agent_id' => $property->user_id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent to agent');
    }
}
