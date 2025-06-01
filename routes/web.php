<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', function () {
    return view('login');
})->name('login.form');

Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users.get');
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::delete('/admin/users/{id}', [AdminController::class, 'delete'])->name('admin.users.delete');
Route::post('/admin/users/{id}/unlock', [AdminController::class, 'unlockUser'])->name('admin.users.unlock');
Route::post('/admin/users/{id}/toggle-lock', [AdminController::class, 'toggleLockUser'])->name('admin.users.toggleLock');
Route::get('/change-password', [AuthController::class, 'changePasswordForm'])->name('password.change.form');
Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
