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
        'unidades_disponibles',
        'categoria',
        'imagen_path',
        'descuento',
    ];
    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'precio' => 'decimal:2',
        'descuento' => 'decimal:2', // Para asegurarte de que siempre sea tratado como un decimal
    ];
}
