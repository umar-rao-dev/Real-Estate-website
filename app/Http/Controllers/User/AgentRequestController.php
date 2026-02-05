<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AgentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentRequestController extends Controller
{
    public function create()
    {
        return view('user.become-agent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
        ]);

        AgentRequest::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Agent request submitted');
    }
}
