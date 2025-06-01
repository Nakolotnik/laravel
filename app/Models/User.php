<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['ФИО', 'Роль', 'Логин', 'Пароль', 'failed_attempts', 'is_locked'];

    protected $hidden = ['Пароль'];

    public $timestamps = false;

    public function getAuthPassword()
{
    return $this->Пароль;
}
public function getAuthIdentifierName()
{
    return 'Логин'; // Имя столбца, используемого для идентификации
}

public function getAuthIdentifier()
{
    return $this->Логин; 
}
}
