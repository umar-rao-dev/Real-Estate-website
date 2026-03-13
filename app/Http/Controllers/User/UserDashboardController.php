<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // For landing page, we want only approved and available properties
        $featuredProperties = Property::with(['images', 'category', 'user'])
            ->where('status', 'approved')
            ->where('availability', 'available')
            ->latest()
            ->take(6)
            ->get();

        $announcements = Announcement::latest()->take(3)->get();
        $categories = Category::all();

        return view('user.dashboard', compact('featuredProperties', 'announcements', 'categories'));
    }
}
