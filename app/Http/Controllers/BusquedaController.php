<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        // Obtiene el término de búsqueda desde el input
        $query = $request->input('query');

        // Busca productos cuyo nombre contenga el término
        $productos = Producto::where('nombre_producto', 'LIKE', "%{$query}%")->get();

        // Título dinámico para la vista
        $categoria = "Resultados para: '{$query}'";

        // Retorna a la vista con los resultados
        return view('Publicaciones.Categorias', compact('productos', 'categoria'));
    }
}
