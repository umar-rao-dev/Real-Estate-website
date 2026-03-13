<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Property;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('agent_id', auth()->id())
            ->with(['property', 'buyer'])
            ->latest()
            ->get();
            
        return view('agent.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->agent_id !== auth()->id()) abort(403);

        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $order->update(['status' => $request->status]);

        // If order is approved, mark property as sold
        if ($request->status == 'approved') {
            Property::find($order->property_id)->update(['availability' => 'sold']);
            
            // Reject other pending orders for the same property
            Order::where('property_id', $order->property_id)
                ->where('id', '!=', $order->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
