<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Announcement;

class UserDashboardController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::with('images', 'category')
            ->where('availability', 'available')
            ->latest()
            ->take(6)
            ->get();

        $announcements = Announcement::latest()->take(3)->get();

        return view('user.dashboard', compact('featuredProperties', 'announcements'));
    }
}
