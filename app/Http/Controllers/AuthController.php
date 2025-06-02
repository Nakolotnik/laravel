<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = User::where('login', $request->login)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login' => 'Неверный логин или пароль.']);
    }

    Auth::login($user);

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'logistician':
            return redirect()->route('logistics.createClientOrder');
        default:
            return abort(403, 'Неизвестная роль.');
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
