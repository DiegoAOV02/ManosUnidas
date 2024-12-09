<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        // Obtener el carrito de la sesión o inicializar uno nuevo
        $carrito = session()->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += $request->input('cantidad', 1); // Incrementar cantidad
        } else {
            $carrito[$id] = [
                "nombre" => $producto->nombre_producto,
                "precio" => $producto->precio,
                "descuento" => $producto->descuento,
                "cantidad" => $request->input('cantidad', 1),
                "imagen" => $producto->imagen_path
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()->route('carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function mostrarCarrito()
    {
        $carrito = session()->get('carrito', []);
        return view('Publicaciones.carrito', compact('carrito'));
    }

    public function eliminarDelCarrito($id)
    {
        $carrito = session()->get('carrito', []);

        // Eliminar el producto del carrito
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito')->with('success', 'Producto eliminado del carrito.');
    }
}
