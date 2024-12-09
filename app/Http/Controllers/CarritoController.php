<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request, $producto_id)
    {
        $producto = Producto::findOrFail($producto_id);

        // Verificar si el producto ya está en el carrito
        $item = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $producto_id)
            ->first();

        if ($item) {
            $item->increment('cantidad', $request->input('cantidad', 1));
        } else {
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $producto->id,
                'cantidad' => $request->input('cantidad', 1),
            ]);
        }

        return redirect()->route('carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function mostrarCarrito()
    {
        $carrito = Carrito::with('producto') // Carga información de productos
        ->where('user_id', Auth::id())
        ->get();

        return view('Publicaciones.carrito', [
        'carrito' => $carrito,
        ]);
    }

    public function eliminarDelCarrito($id)
    {
        $item = Carrito::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $item->delete();

        return redirect()->route('carrito')->with('success', 'Producto eliminado del carrito.');
    }
}
