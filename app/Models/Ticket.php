<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // This tells Laravel which columns we are allowed to fill with data
    protected $fillable = [
        'pc_number',
        'lab_location',
        'issue_category',
        'description',
        'status',
        'urgency',
    ];
}