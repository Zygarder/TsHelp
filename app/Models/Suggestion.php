<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'is_read',
        'submitted_by', // <--- Changed this to match your migration!
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}