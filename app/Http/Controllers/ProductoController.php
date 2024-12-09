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
}