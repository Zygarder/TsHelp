<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuggestionController;

Route::get('/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);
Route::patch('/api/admin/tickets/{ticket}', [ReportController::class, 'update']);
Route::get('/admin/suggestions', [SuggestionController::class, 'index']);
Route::patch('/admin/suggestions/{suggestion}/read', [SuggestionController::class, 'markAsRead']);
?>