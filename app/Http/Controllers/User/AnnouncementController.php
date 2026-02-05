<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('user.announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('user.announcements.show', compact('announcement'));
    }
}
