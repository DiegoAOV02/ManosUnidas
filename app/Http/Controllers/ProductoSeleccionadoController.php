<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoSeleccionadoController extends Controller
{
    public function show($id)
    {
        // Busca el producto por ID, si no existe lanza una página 404
        $producto = Producto::findOrFail($id);

        // Retorna la vista y pasa el producto como variable
        return view('Publicaciones.publicacion', compact('producto'));
    }
}
