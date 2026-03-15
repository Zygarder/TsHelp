<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReportController extends Controller
{
    public function index()
{
    
    $tickets = Ticket::all(); 

   
    return response()->json($tickets);
}
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'priority' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $ticket->update([
            'urgency' => $request->input('priority', $ticket->urgency),
            'status'  => $request->input('status', $ticket->status),
        ]);

        return response()->json([
            'message' => 'Success',
            'report' => $this->transformTicket($ticket->fresh()) // Return the same format Vue expects
        ]);
    }

    // Helper to keep the data format consistent
    private function transformTicket($t)
    {
        return [
            'id' => $t->id,
            'ticketId' => "TKT-{$t->id}",
            'priority' => $t->urgency,
            'status' => $t->status,
            'issueType' => $t->issue_category,
            'location' => $t->lab_location,
            'specificItem' => $t->pc_number,
            'submittedAt' => $t->created_at,
            'description' => $t->description,
            'submittedBy' => 'Student'
        ];
    }
}
