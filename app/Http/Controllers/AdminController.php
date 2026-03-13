<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getDashboardStats()
    {
        // 1. Gather all the stats
        $stats = [
            'to_review' => Ticket::where('status', 'open')->count(),
            'pending' => Ticket::where('status', 'in-progress')->count(),
            'completed' => Ticket::where('status', 'resolved')->count(),
            'rejected' => Ticket::where('status', 'rejected')->count(), // assuming you added this status
            'suggestions' => Suggestion::count(),
        ];

        // 2. Get the "Active Task"
        $activeTask = Ticket::where('status', 'in-progress')
            ->orderBy('created_at', 'asc')
            ->first();

        // 3. Return as JSON for Axios to catch
        return response()->json([
            'stats' => $stats,
            'activeTask' => $activeTask
        ]);
    }
}