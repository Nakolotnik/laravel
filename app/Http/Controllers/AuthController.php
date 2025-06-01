<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController
{

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('Логин', $request->login)->first();

        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Неверный логин или пароль.');
        }

        if ($user->is_locked) {
            return redirect()->route('login.form')->with('error', 'Ваш аккаунт заблокирован. Обратитесь к администратору.');
        }

        if ($request->password !== $user->Пароль) {
            $user->failed_attempts += 1;

            if ($user->failed_attempts >= 3) {
                $user->is_locked = 1;
            }

            $user->save();

            return redirect()->route('login.form')->with('error', 'Неверный логин или пароль.');
        }

        $user->failed_attempts = 0;
        $user->is_locked = 0;
        $user->save();

        Auth::login($user);

        if ($user->Роль === 'admin') {
            return redirect('/admin-dashboard')->with('message', 'Добро пожаловать, администратор!');
        }

        return redirect('/change-password')->with('message', 'Пожалуйста, измените ваш пароль.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'ФИО' => 'required|string|max:255',
            'Логин' => 'required|string|max:50|unique:Пользователи,Логин',
            'Пароль' => 'required|string|min:8',
            'Роль' => 'required|string|in:admin,user'
        ]);

        $user = User::create([
            'ФИО' => $request->ФИО,
            'Логин' => $request->Логин,
            'Пароль' => $request->Пароль,
            'Роль' => $request->Роль
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Пользователь успешно зарегистрирован.',
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Вы должны войти в систему.');
        }

        $user->Пароль = $request->password;
        $user->save();

        return redirect()->route('login.form')->with('message', 'Пароль успешно изменён.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form')->with('message', 'Вы успешно вышли из системы.');
    }
    
    public function changePasswordForm()
    {
        return view('change-password');
    }
}
