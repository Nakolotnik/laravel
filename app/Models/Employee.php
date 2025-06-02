<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_employee';
    protected $fillable = ['full_name', 'position', 'contact_info'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_employee');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'id_employee');
    }
}
