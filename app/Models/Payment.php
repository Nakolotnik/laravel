<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_payment';
    protected $fillable = ['amount', 'payment_date', 'payment_status'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_payment');
    }
}
