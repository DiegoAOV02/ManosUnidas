<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CategoriasController extends Controller
{
    /**
     * Mostrar productos por categoría.
     *
     * @param string $categoria
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Obtener la categoría desde el parámetro de la URL
        $categoria = $request->input('categoria');

        // Filtrar los productos por la categoría seleccionada
        $productos = Producto::where('categoria', $categoria)->get();

        // Enviar la categoría y los productos a la vista
        return view('Publicaciones.Categorias', compact('categoria', 'productos'));
    }
}
