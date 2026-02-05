<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Query;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agentId = Auth::id();

        $totalProperties = Property::where('user_id', $agentId)->count();
        $totalQueries = Query::where('agent_id', $agentId)->count();

        $latestProperties = Property::where('user_id', $agentId)
            ->latest()
            ->take(5)
            ->get();

        return view('agent.dashboard', compact(
            'totalProperties',
            'totalQueries',
            'latestProperties'
        ));
    }
}
