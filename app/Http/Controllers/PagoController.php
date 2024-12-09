<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
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
}
