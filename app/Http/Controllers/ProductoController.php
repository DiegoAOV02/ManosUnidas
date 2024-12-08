<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
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

    public function misVentas()
    {
        // Obtener los productos publicados por el usuario actual
        $productos = Producto::where('user_id', auth()->id())->get();

        // Retornar la vista con los productos
        return view('ventas.misVentas', compact('productos'));
    }

    // Funcion para eliminar un producto
    public function destroy(Producto $producto)
    {
        // Asegurar que solo el dueño pueda eliminar el producto
        if ($producto->user_id !== auth()->id()) {
            abort(403, 'No autorizado');
        }

        // Eliminar el archivo de imagen si existe
        if ($producto->imagen_path) {
            Storage::disk('public')->delete($producto->imagen_path);
        }

        // Eliminar el producto
        $producto->delete();

        return redirect()->route('misVentas')->with('success', 'Producto eliminado correctamente.');
    }

    // función para editar el cambio de precio
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nuevo_precio' => 'required|numeric|min:0',
        ]);
    
        // Registrar el precio anterior y el nuevo en el historial
        $producto->historicoPrecios()->create([
            'precio_anterior' => $producto->precio,
            'nuevo_precio' => $request->nuevo_precio,
        ]);
    
        // Actualizar el precio en el producto
        $producto->update([
            'precio' => $request->nuevo_precio,
            'promocion_activa' => true, // Activar promoción
        ]);
    
        return redirect()->route('misVentas')->with('success', 'El precio ha sido actualizado con éxito.');
    }
}