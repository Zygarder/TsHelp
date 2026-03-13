<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// 1. API Data Routes MUST go first! 
// (We will manually add the /api prefix here so your Vue app can find it)
Route::get('/api/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);

// 2. The Catch-All Route MUST go last!
// This tells Laravel: "If the URL doesn't match anything above, just load the Vue app."
Route::get('/{any}', function () {
    return view('welcome'); 
})->where('any', '.*');