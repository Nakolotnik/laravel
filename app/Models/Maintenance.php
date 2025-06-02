<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_maintenance';
    protected $fillable = ['id_vehicle', 'id_employee', 'planned_date', 'completion_date', 'work_description', 'status'];

    public function vehicle() { return $this->belongsTo(Vehicle::class, 'id_vehicle'); }
    public function employee() { return $this->belongsTo(Employee::class, 'id_employee'); }
}
