<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'estado_envio',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
