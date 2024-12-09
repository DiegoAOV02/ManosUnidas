<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        // Verificar que existen productos con descuento mayor a 0
        $productosConDescuento = Producto::where('descuento', '>', 0)
            ->orderByDesc('descuento')
            ->get();

        // Si no hay productos con descuento, devolver variables vacías
        if ($productosConDescuento->isEmpty()) {
            return view('dashboard', [
                'ofertaDelDia' => null,
                'ofertas' => collect(),
                'todasLasOfertas' => collect(),
            ]);
        }

        // Separar productos
        $ofertaDelDia = $productosConDescuento->first();
        $ofertas = $productosConDescuento->skip(1)->take(4); // Las siguientes 4 ofertas
        $todasLasOfertas = $productosConDescuento; // Todas las ofertas con descuento

        return view('dashboard', compact('ofertaDelDia', 'ofertas', 'todasLasOfertas'));
    }
}
