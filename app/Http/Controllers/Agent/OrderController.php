<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('agent_id', Auth::id())->with('property', 'buyer')->latest()->get();
        return view('agent.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->agent_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $order->property->update(['availability' => 'sold']);
        }

        return back()->with('success', 'Order status updated!');
    }
}
