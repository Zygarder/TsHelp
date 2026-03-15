<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket; 
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data (safety first!)
        $validated = $request->validate([
            'issue_category' => 'required|string|max:255',
            'lab_location' => 'required|string|max:255',
            'pc_number' => 'required|string|max:50',
            'description' => 'required|string',
            // If you have authentication later, you'd grab the user ID here too
        ]);

        // 2. Create the ticket in the database
        $ticket = Ticket::create([
            'issue_category' => $validated['issue_category'],
            'lab_location' => $validated['lab_location'],
            'pc_number' => $validated['pc_number'],
            'description' => $validated['description'],
            // Set the defaults for a brand new ticket!
            'status' => 'open', 
            'urgency' => 'unassigned', // Or null, based on how we set up your database earlier
        ]);

        // 3. Send a success response back to Vue
        return response()->json([
            'message' => 'Ticket submitted successfully!',
            'ticket' => $ticket
        ], 201); // 201 means "Created"
    }
}