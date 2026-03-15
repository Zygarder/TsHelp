<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Suggestion; // Pull in the model we perfected earlier
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'content' => 'required|string|min:10', // Let's make sure they type at least 10 characters!
            'submitted_by' => 'nullable|string|max:255', // Optional: if they want to leave their name
        ]);

        // 2. Create the suggestion
        $suggestion = Suggestion::create([
            'content' => $validated['content'],
            // If they didn't provide a name, default to 'Anonymous Student'
            'submitted_by' => $validated['submitted_by'] ?? 'Anonymous Student', 
            'is_read' => false, // Always starts as unread so the admin gets the yellow badge!
        ]);

        // 3. Send success response back to Vue
        return response()->json([
            'message' => 'Thank you for your feedback!',
            'suggestion' => $suggestion
        ], 201);
    }
}