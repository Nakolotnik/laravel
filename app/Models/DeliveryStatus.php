<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryStatus extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_status';
    protected $fillable = ['status_name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_delivery_status');
    }
}
