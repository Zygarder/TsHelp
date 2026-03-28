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
        $activeTasks = Ticket::where('status', 'in-progress')
            ->orderBy('updated_at', 'desc')
            ->get();


        return response()->json([
            'stats' => $stats,
            'activeTasks' => $activeTasks
        ]);
    }
    // 1. Get all tickets for the Reports List
    public function getAllTickets()
    {
        // Fetch all tickets, ordering the newest ones first
        $tickets = Ticket::orderBy('created_at', 'desc')->get();

        return response()->json([
            'tickets' => $tickets
        ]);
    }

    // 2. Update a ticket's status (e.g., from 'open' to 'in-progress')
    public function updateTicketStatus(Request $request, $id)
    {
        // Validate that the status they are sending is allowed
        $request->validate([
            'status' => 'required|in:open,in-progress,resolved,rejected'
        ]);

        // Find the ticket and update it
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return response()->json([
            'message' => 'Ticket status updated successfully!',
            'ticket' => $ticket
        ]);
    }
}
