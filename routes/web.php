<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::middleware(['web'])->group(function () {

    // Главная
    Route::get('/', function () {
        return redirect()->route('login.form');
    });

    // Авторизация
    Route::get('/login', fn() => view('login'))->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Смена пароля
    Route::get('/change-password', [AuthController::class, 'changePasswordForm'])->name('password.change.form');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');

    // Админ-панель
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users.get');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [AdminController::class, 'delete'])->name('admin.users.delete');
    Route::post('/admin/users/{id}/unlock', [AdminController::class, 'unlockUser'])->name('admin.users.unlock');
    Route::post('/admin/users/{id}/toggle-lock', [AdminController::class, 'toggleLockUser'])->name('admin.users.toggleLock');

    // Тестовая смена пароля
    Route::get('/fix-password', function () {
        $user = \App\Models\User::where('Логин', 'sidorov_s')->first();
        if ($user) {
            $user->Пароль = \Illuminate\Support\Facades\Hash::make('12345678');
            $user->must_change_password = true;
            $user->save();
            return 'Пароль обновлён на 12345678';
        }
        return 'Пользователь не найден.';
    });

Route::get('/debug-session', function () {
    session(['test_key' => 'test_value_123']); // Записываем что-то простое
    Log::info('Session after setting test_key in /debug-session: ', session()->all());
    return 'Сессия установлена (test_key = test_value_123). Проверьте /check-session и логи.';
});

Route::get('/check-session', function () {
    Log::info('Session data in /check-session: ', session()->all());
    Log::info('Auth::check() in /check-session: ' . (Auth::check() ? 'true' : 'false'));
    if (Auth::check()) {
        Log::info('Auth::user()->Логин in /check-session: ' . Auth::user()->Логин);
    }
    return 'Значение test_key из сессии: ' . session('test_key', 'НЕ НАЙДЕНО') .
           '<br>Auth::check(): ' . (Auth::check() ? 'ДА, пользователь ' . Auth::user()->Логин : 'НЕТ');
});
});
