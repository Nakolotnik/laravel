<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'id_client';
    public $timestamps = true;

    protected $fillable = [
        'full_name',
        'contact_info',
    ];
}
