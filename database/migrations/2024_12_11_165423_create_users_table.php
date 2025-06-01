<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id'); // Код
            $table->string('ФИО', 100); // ФИО
            $table->string('Роли', 50); // Роль
            $table->string('Логип', 50)->unique(); // Логин
            $table->string('Пароль', 256); // Пароль

            // Дополнительные поля авторизации
            $table->integer('failed_attempts')->default(0); // Кол-во неудачных входов
            $table->boolean('is_blocked')->default(false); // Заблокирован ли
            $table->boolean('must_change_password')->default(false); // Требуется смена пароля
            $table->timestamp('last_login_at')->nullable(); // Последний вход

            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};