<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_producto',
        'descripcion_producto',
        'precio',
        'promocion_activa',
        'unidades_disponibles',
        'categoria',
        'imagen_path',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el historial de precios
    public function historicoPrecios()
    {
        return $this->hasMany(HistoricoPrecio::class);
    }
}