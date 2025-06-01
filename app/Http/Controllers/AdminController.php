<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin-dashboard');
    }

    public function getUsers()
    {
        return response()->json([
            'success' => true,
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'login' => 'required|string|max:50|unique:Пользователи,Логин',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user'
        ]);

        $user = User::create([
            'ФИО' => $request->input('full_name'),
            'Логин' => $request->input('login'),
            'Пароль' => bcrypt($request->input('password')),
            'Роль' => $request->input('role'),
            'failed_attempts' => 0,
            'is_locked' => 0
        ]);

        return response()->json(['success' => true, 'message' => 'Пользователь успешно добавлен.', 'user' => $user]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Пользователь не найден.']);

        $user->delete();
        return response()->json(['success' => true, 'message' => 'Пользователь удалён.']);
    }

    public function unlockUser($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Пользователь не найден.']);

        $user->is_locked = false;
        $user->failed_attempts = 0;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Пользователь разблокирован.']);
    }

    public function toggleLockUser($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Пользователь не найден.']);

        $user->is_locked = $user->is_locked ? 0 : 1;
        $user->failed_attempts = $user->is_locked ? 3 : 0;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => $user->is_locked ? 'Пользователь заблокирован.' : 'Пользователь разблокирован.'
        ]);
    }
}
