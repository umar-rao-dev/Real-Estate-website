<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAgents = User::where('role', 'agent')->count();
        $totalProperties = Property::count();
        $totalOrders = Order::count();

        // Advanced Approval Stats
        $pendingProperties = Property::where('status', 'pending')->count();
        $approvedProperties = Property::where('status', 'approved')->count();
        $rejectedProperties = Property::where('status', 'rejected')->count();

        $latestProperties = Property::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();
        
        $latestOrders = Order::with('property', 'buyer', 'agent')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAgents',
            'totalProperties',
            'totalOrders',
            'pendingProperties',
            'approvedProperties',
            'rejectedProperties',
            'latestProperties',
            'latestOrders'
        ));
    }
}
