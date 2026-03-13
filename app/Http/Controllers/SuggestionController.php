<?php

namespace App\Http\Controllers;

use App\Models\Suggestion; // Ensure you have a Suggestion model
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    // Fetch all suggestions for the list
    public function index()
    {
        $suggestions = Suggestion::orderBy('created_at', 'desc')->get();

        return response()->json([
            'suggestions' => $suggestions->map(function($s) {
                return [
                    'id' => $s->id,
                    'content' => $s->content,
                    'isRead' => (bool)$s->is_read,
                    'submittedAt' => $s->created_at,
                    'submittedBy' => $s->submitted_by ?? 'Anonymous',
                ];
            })
        ]);
    }

    // Mark a single suggestion as read
    public function markAsRead(Suggestion $suggestion)
    {
        $suggestion->update(['is_read' => true]);

        return response()->json(['message' => 'Marked as read']);
    }
}