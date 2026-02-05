<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAgents = User::where('role', 'agent')->count();
        $totalProperties = Property::count();

        $latestProperties = Property::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAgents',
            'totalProperties',
            'latestProperties'
        ));
    }
}
