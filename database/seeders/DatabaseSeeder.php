<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Suggestion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Dummy Tickets
        Ticket::create([
            'pc_number' => 'PC-07',
            'lab_location' => 'Computer Lab A',
            'issue_category' => 'Hardware',
            'description' => 'Computer won\'t turn on. No lights, no response. Tried different power outlet but still not working.',
            'status' => 'in-progress',
            'urgency' => 'high',
        ]);

        Ticket::create([
            'pc_number' => 'PC-12',
            'lab_location' => 'Computer Lab B',
            'issue_category' => 'Network',
            'description' => 'Cannot connect to the internet. Says "No Internet, secured".',
            'status' => 'open', // To Review
            'urgency' => 'normal',
        ]);
        
        Ticket::create([
            'pc_number' => 'PC-02',
            'lab_location' => 'Library',
            'issue_category' => 'Software',
            'description' => 'Microsoft Word keeps crashing when trying to print.',
            'status' => 'resolved', // Completed
            'urgency' => 'low',
        ]);

        // 2. Create Dummy Suggestions
        Suggestion::create([
            'content' => 'We need faster Wi-Fi in the student lounge!',
            'submitted_by' => 'John Doe',
            'is_read' => false,
        ]);

        Suggestion::create([
            'content' => 'Can we get more charging stations in Lab B?',
            'submitted_by' => 'Jane Smith',
            'is_read' => true,
        ]);
    }
}