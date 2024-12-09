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
            return redirect()->route('pago')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total considerando los descuentos
        $total = $carrito->sum(function ($item) {
            $precio = $item->producto->descuento
                ? $item->producto->precio - ($item->producto->precio * ($item->producto->descuento / 100))
                : $item->producto->precio;
            return $precio * $item->cantidad;
        });

        try {
            // Crear la compra
            $compra = Compra::create([
                'user_id' => $user->id,
                'total' => $total,
            ]);

            // Crear los detalles de la compra y actualizar las unidades disponibles
            foreach ($carrito as $item) {
                $precioConDescuento = $item->producto->descuento
                    ? $item->producto->precio - ($item->producto->precio * ($item->producto->descuento / 100))
                    : $item->producto->precio;

                DetalleCompra::create([
                    'compra_id' => $compra->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio' => $precioConDescuento,
                ]);

                // Restar la cantidad comprada del inventario
                $producto = $item->producto;
                if ($producto->unidades_disponibles >= $item->cantidad) {
                    $producto->unidades_disponibles -= $item->cantidad;
                    $producto->save();
                } else {
                    return redirect()->route('pago')->with('error', "El producto '{$producto->nombre}' no tiene suficiente stock.");
                }
            }

            // Vaciar el carrito
            Carrito::where('user_id', $user->id)->delete();

            return redirect()->route('pago')->with('success', 'Compra realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('pago')->with('error', 'Ocurrió un error al procesar la compra. Inténtalo de nuevo.');
        }
    }
}
