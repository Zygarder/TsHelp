<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReportController extends Controller
{
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            // If priority is null, we'll handle it below
            'priority' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $ticket->update([
            // If priority is null/empty, set it to 'normal' (or whatever your default is)
            'urgency' => $validated['priority'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Success',
            'report' => $this->transformTicket($ticket) // Return the same format Vue expects
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
