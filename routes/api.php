<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
Route::get('/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);

?>