<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener las compras realizadas por el usuario
        $compras = Compra::with('detalles.producto')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pasar las compras a la vista
        return view('Publicaciones.compras', compact('compras'));
    }
}
