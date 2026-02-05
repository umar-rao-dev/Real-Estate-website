<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementApiController extends Controller
{
    // List announcements
    public function index()
    {
        $announcements = Announcement::where('is_active', true)->latest()->get();
        return response()->json($announcements);
    }

    // Show single announcement
    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return response()->json($announcement);
    }
}
