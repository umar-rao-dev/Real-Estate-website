<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('user')->latest()->get();
        return view('admin.feedback.index', compact('feedback'));
    }

    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback deleted');
    }
}
