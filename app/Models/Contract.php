<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_contract';
    protected $fillable = ['signing_date', 'terms'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_contract');
    }
}
