<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    // Mostrar los productos del usuario autenticado
    public function misVentas()
    {
        $productos = Producto::where('user_id', Auth::id())->get();
        return view('ventas.misVentas', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:255',
            'descripcionProducto' => 'nullable|string',
            'precioProducto' => 'required|numeric|min:0',
            'unidadesDisponibles' => 'required|integer|min:1',
            'categoria' => 'required|string',
            'imageUpload' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $path = null;
        if ($request->hasFile('imageUpload')) {
            $path = $request->file('imageUpload')->store('productos', 'public');
        }
        Producto::create([
            'user_id' => Auth::id(),
            'nombre_producto' => $request->nombreProducto,
            'descripcion_producto' => $request->descripcionProducto,
            'precio' => $request->precioProducto,
            'unidades_disponibles' => $request->unidadesDisponibles,
            'categoria' => $request->categoria,
            'imagen_path' => $path,
        ]);

        return redirect()->route('vender')->with('success', '¡El producto y la imagen fueron guardados con éxito!');
    }

    public function update(Request $request, $id)
    {
        try {
            $producto = Producto::findOrFail($id);

            // Verifica que el producto pertenezca al usuario autenticado
            if ($producto->user_id !== Auth::id()) {
                return response()->json(['error' => 'No autorizado'], 403);
            }

            $request->validate([
                'nombre_producto' => 'required|string|max:255',
                'descripcion_producto' => 'nullable|string',
                'precio' => 'required|numeric|min:0',
                'descuento' => 'nullable|numeric|min:0|max:100',
                'unidades_disponibles' => 'required|integer|min:1',
                'categoria' => 'required|string',
            ]);

            $producto->update([
                'nombre_producto' => $request->nombre_producto,
                'descripcion_producto' => $request->descripcion_producto,
                'precio' => $request->precio,
                'descuento' => $request->descuento,
                'unidades_disponibles' => $request->unidades_disponibles,
                'categoria' => $request->categoria,
            ]);

            return response()->json(['success' => true, 'message' => 'Producto actualizado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        if ($producto->user_id === Auth::id()) {
            $producto->delete();
            return redirect()->route('productos.misVentas')->with('success', '¡Producto eliminado con éxito!');
        }

        return redirect()->route('productos.misVentas')->with('error', 'No tienes permiso para eliminar este producto.');
    }
}
