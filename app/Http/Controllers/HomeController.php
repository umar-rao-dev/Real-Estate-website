<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::with(['images', 'category'])
            ->where('availability', 'available')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::all();
        
        $announcements = Announcement::latest()
            ->take(3)
            ->get();

        return view('welcome', compact('featuredProperties', 'categories', 'announcements'));
    }
}
