<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Direccion;
use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function index()
    {
        // obtener el usuario autenticado
        $user = Auth::user();

        // Obtener la dirección con información del usuario
        $direccion = Direccion::with('user')->where('user_id', $user->id)->first();

        // obtener la tarjeta de crédito del usuario.
        $tarjeta = Tarjeta::where('user_id', $user->id)->first();

        $carrito = Carrito::with('producto')->where('user_id', $user->id)->get();

        return view('Publicaciones.pago', [
            'direccion' => $direccion,
            'tarjeta' => $tarjeta,
            'carrito' => $carrito
        ]);
    }

    public function realizarCompra()
    {
        $user = Auth::user();
        $carrito = Carrito::with('producto')->where('user_id', $user->id)->get();

        if ($carrito->isEmpty()) {
                return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total de la compra
        $total = $carrito->sum(fn($item) => $item->producto->precio * $item->cantidad);

        // Crear la compra
        $compra = Compra::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);

        // Crear los detalles de la compra
        foreach ($carrito as $item) {
            DetalleCompra::create([
                'compra_id' => $compra->id,
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio' => $item->producto->precio,
            ]);
        }

        // Vaciar el carrito 
        Carrito::where('user_id', $user->id)->delete();

        return redirect()->route('dashboard')->with('success', 'Compra realizada con éxito.');
    }
}
