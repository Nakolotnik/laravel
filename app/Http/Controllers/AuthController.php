<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Добавим для логирования
use App\Models\User;

class AuthController
{
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt for: ' . $request->login);

        // Ищем пользователя вручную
        $user = User::where('Логин', $request->login)->first();

        if (!$user) {
            Log::warning('User not found: ' . $request->login);
            return redirect()->route('login.form')->with('error', 'Неверный логин или пароль.');
        }

        // Залогируем данные пользователя, которого нашли, до проверки пароля
        Log::info('User found: ', ['id' => $user->id, 'login' => $user->Логин, 'Роль_from_db' => $user->Роль, 'is_locked_from_db' => $user->is_locked, 'must_change_password_from_db' => $user->must_change_password]);


        if (!Hash::check($request->password, $user->Пароль)) {
            Log::warning('Password mismatch for user: ' . $user->Логин);
            // Логин неправильный или пароль не совпал
            $user->failed_attempts++;
            if ($user->failed_attempts >= 3) {
                $user->is_locked = 1;
                Log::info('User account locked due to failed attempts: ' . $user->Логин);
            }
            $user->save();
            return redirect()->route('login.form')->with('error', 'Неверный логин или пароль.');
        }

        if ($user->is_locked) {
            Log::warning('Login attempt for locked account: ' . $user->Логин);
            return redirect()->route('login.form')->with('error', 'Ваш аккаунт заблокирован. Обратитесь к администратору.');
        }

        // Вход успешен
        Log::info('Login successful for user: ' . $user->Логин);
        Auth::login($user); // Авторизация вручную
        $request->session()->regenerate(); // Важно для безопасности и предотвращения session fixation

        // Сброс счетчика неудачных попыток и обновление времени последнего входа
        $user->failed_attempts = 0;
        // $user->is_locked = 0; // Это уже было проверено выше, но на всякий случай, если логика изменится
        $user->last_login_at = now();
        // Сохраняем изменения перед проверками must_change_password и Роль
        // Это гарантирует, что объект $user, который используется в условиях, актуален
        $user->save(); 

        // Логируем состояние пользователя ПОСЛЕ Auth::login() и $user->save()
        // особенно интересуют поля, влияющие на редирект
        Log::info('User state after Auth::login and save: ', [
            'id' => $user->id,
            'Логин' => $user->Логин,
            'Роль' => $user->Роль, // Это значение будет использоваться в условии ниже
            'must_change_password' => $user->must_change_password, // И это
            'is_locked' => $user->is_locked,
            'failed_attempts' => $user->failed_attempts,
            'session_id' => session()->getId() // Проверим, что сессия имеет ID
        ]);
        Log::info('User Роль (for condition check): \'' . $user->Роль . '\' (Type: ' . gettype($user->Роль) . ')');
        Log::info('User must_change_password (for condition check): ' . ($user->must_change_password ? 'true' : 'false') . ' (Type: ' . gettype($user->must_change_password) . ')');


        // --- Начало логики редиректов ---

        if ($user->must_change_password) {
            Log::info('Redirecting user to password.change.form: ' . $user->Логин);
            return redirect()->route('password.change.form')->with('message', 'Пожалуйста, измените ваш пароль.');
        }

        // Используем trim() на всякий случай, если в БД есть лишние пробелы, хотя лучше их исправить в БД
        // Но для === сравнения это не поможет, если пробелы есть. Это для отладки, чтобы увидеть.
        // Для надежности, если есть сомнения в данных, лучше было бы сделать:
        // if (trim((string)$user->Роль) === 'admin') {
        // Но правильнее всего - чистые данные в БД.
        if ($user->Роль === 'admin') {
            Log::info('User is admin. Redirecting to admin.dashboard: ' . $user->Логин);
            return redirect()->route('admin.dashboard')->with('message', 'Добро пожаловать, администратор!');
        }

        // Если пользователь не админ и не должен менять пароль
        Log::info('User is not admin or must_change_password is false. Redirecting to / for user: ' . $user->Логин);
        return redirect('/')->with('message', 'Добро пожаловать!');
    }

    /* === Р Е Г И С Т Р А Ц И Я ============================= */
    public function register(Request $request)
    {
        $request->validate([
            'ФИО'    => 'required|string|max:255',
            'Логин'  => 'required|string|max:50|unique:users,Логин', // Убедитесь, что таблица users
            'Пароль' => 'required|string|min:8',
            'Роль'   => 'required|string|in:admin,user',
        ]);

        $user = User::create([
            'ФИО'                  => $request->ФИО,
            'Логин'                => $request->Логин,
            'Пароль'               => Hash::make($request->Пароль),
            'Роль'                 => $request->Роль,
            'must_change_password' => true, // заставляем сменить при 1‑м входе
            'failed_attempts'      => 0,    // По умолчанию
            'is_locked'            => 0,    // По умолчанию
        ]);
        Log::info('User registered: ', ['id' => $user->id, 'login' => $user->Логин]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    /* === С М Е Н А   П А Р О Л Я =========================== */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // 'confirmed' требует поля password_confirmation
        ]);

        $user = Auth::user();
        if (!$user) {
            Log::warning('Attempt to change password for unauthenticated user.');
            return redirect()->route('login.form')->with('error', 'Вы должны войти в систему.');
        }

        $user->Пароль               = Hash::make($request->password);
        $user->must_change_password = false;
        $user->save();
        Log::info('Password changed for user: ' . $user->Логин);

        $targetRoute = $user->Роль === 'admin' ? 'admin.dashboard' : 'home'; // Используем 'home' для обычных юзеров
        // Если роута 'home' нет или он ведет не туда, можно использовать '/'
        // $targetRoute = $user->Роль === 'admin' ? 'admin.dashboard' : '/';

        return redirect()->route($targetRoute)->with('message', 'Пароль успешно изменён.');
    }

    /* === В Ы Х О Д ======================================== */
    public function logout(Request $request) // Добавим Request для работы с сессией
    {
        if (Auth::check()) {
            Log::info('User logging out: ' . Auth::user()->Логин);
        } else {
            Log::info('Logout called but no user was authenticated.');
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('message', 'Вы вышли из системы.');
    }

    public function changePasswordForm()
    {
        // Можно добавить проверку, что пользователь аутентифицирован,
        // прежде чем показывать форму смены пароля, если она не для первого входа.
        if (!Auth::check() && !session()->has('message')) { // Проверка, если нет сообщения о необходимости смены пароля
             // Если мы сюда попали без спец. сообщения (например, must_change_password), то лучше редирект на логин.
             // return redirect()->route('login.form')->with('error', 'Сначала войдите в систему.');
        }
        return view('change-password');
    }
}