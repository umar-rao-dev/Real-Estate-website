<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentRequest;
use App\Models\User;

class AgentRequestController extends Controller
{
    public function index()
    {
        $requests = AgentRequest::with('user')->latest()->get();
        return view('admin.agent_requests.index', compact('requests'));
    }

    public function approve(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'approved']);

        $user = User::find($agentRequest->user_id);
        $user->update(['role' => 'agent']);

        return redirect()->back()->with('success', 'Agent request approved');
    }

    public function reject(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Agent request rejected');
    }
}
