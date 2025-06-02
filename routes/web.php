<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\LogisticsController;

Route::get('/', function () {
    return view('welcome');
});

// Авторизация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Доступ только для авторизованных (любой роли)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/logistics/create', [LogisticsController::class, 'createClientOrder'])->name('logistics.createClientOrder');
    Route::post('/logistics/create', [LogisticsController::class, 'storeClientOrder'])->name('logistics.storeClientOrder');
});
