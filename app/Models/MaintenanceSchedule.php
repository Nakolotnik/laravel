<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceSchedule extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_schedule';
    protected $fillable = ['id_vehicle', 'maintenance_date', 'maintenance_type'];

    public function vehicle() { return $this->belongsTo(Vehicle::class, 'id_vehicle'); }
}
