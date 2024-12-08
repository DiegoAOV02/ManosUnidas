<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $table = 'tarjetas';
    
    protected $fillable = [
        'user_id',
        'nombre_titular',
        'numero_tarjeta',
        'fecha_expiracion',
        'ccv'
    ];
}