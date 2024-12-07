<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $fillable = [
        'user_id',
        'nombre_titular',
        'numero_tarjeta',
        'fecha_expiracion',
        'ccv'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}