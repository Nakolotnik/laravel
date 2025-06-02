<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'login',
        'password',
        'role',
        'id_employee',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }

    public function isRole(string $role): bool
    {
        return $this->role === $role;
    }
}
