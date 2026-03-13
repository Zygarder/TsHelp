<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'submitted_by',
        'is_read',
    ];

    // This tells Laravel to automatically treat is_read as a true/false boolean
    protected $casts = [
        'is_read' => 'boolean',
    ];
}