<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\Client\TicketController as ClientTicketController;
use App\Http\Controllers\Client\SuggestionController as ClientSuggestionController;
use App\Http\Controllers\AuthController;

// --- AUTHENTICATION ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- ADMIN ROUTES ---
Route::prefix('admin')->group(function () {
    Route::get('/dashboard-stats', [AdminController::class, 'getDashboardStats']);
    Route::get('/tickets', [ReportController::class, 'index']);
    Route::patch('/tickets/{ticket}', [ReportController::class, 'update']);
    Route::get('/suggestions', [SuggestionController::class, 'index']);
    Route::patch('/suggestions/{suggestion}/read', [SuggestionController::class, 'markAsRead']);
});

// --- CLIENT ROUTES ---
Route::prefix('client')->group(function () {
    Route::post('/tickets', [ClientTicketController::class, 'store']);
    Route::post('/suggestions', [ClientSuggestionController::class, 'store']);
});