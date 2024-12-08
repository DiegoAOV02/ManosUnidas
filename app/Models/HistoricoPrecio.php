<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoPrecio extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'precio_anterior',
        'nuevo_precio',
    ];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
