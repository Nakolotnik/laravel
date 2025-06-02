<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleStatus extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_status';
    protected $fillable = ['status_name'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_status');
    }
}
