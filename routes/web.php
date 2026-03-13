<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuggestionController;


// 1. API Data Routes MUST go first! 
// (We will manually add the /api prefix here so your Vue app can find it)
Route::get('/api/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);
Route::get('/api/admin/tickets', [AdminController::class, 'getAllTickets']);
Route::patch('/api/admin/tickets/{id}/status', [AdminController::class, 'updateTicketStatus']);
Route::patch('/api/admin/tickets/{ticket}', [ReportController::class, 'update']);
Route::get('/admin/suggestions', [SuggestionController::class, 'index']);
Route::patch('/admin/suggestions/{suggestion}/read', [SuggestionController::class, 'markAsRead']);
// "If the URL doesn't match anything above, just load the Vue app."
Route::get('/{any}', function () {
    return view('welcome'); 
})->where('any', '.*');