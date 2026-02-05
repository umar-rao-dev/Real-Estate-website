<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Query;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function index()
    {
        $queries = Query::where('agent_id', Auth::id())
            ->with('property', 'user')
            ->latest()
            ->get();

        return view('agent.queries.index', compact('queries'));
    }

    public function show(Query $query)
    {
        if ($query->agent_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('agent.queries.show', compact('query'));
    }
}
