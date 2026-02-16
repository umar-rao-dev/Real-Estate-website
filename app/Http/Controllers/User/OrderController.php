<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
        ]);

        $property = Property::findOrFail($request->property_id);

        Order::create([
            'property_id' => $property->id,
            'buyer_id' => Auth::id(),
            'agent_id' => $property->user_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Buy request submitted! The agent will review your request.');
    }
}
