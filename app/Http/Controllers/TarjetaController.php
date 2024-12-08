<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarjetaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Verificar si el usuario está autenticado
        if (!$user) {
            return view('Perfil.tarjetas', ['tarjetas' => collect([])]);
        }
    
        // Obtener las tarjetas del usuario autenticado
        $tarjetas = Tarjeta::where('user_id', $user->id)->get();
    
        // Pasar las tarjetas a la vista
        return view('Perfil.tarjetas', compact('tarjetas'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'nombre_titular' => 'required|string|max:255',
            'numero_tarjeta' => 'required|digits:16',
            'fecha_expiracion' => 'required|regex:/^\d{2}\/\d{2}$/',
            'ccv' => 'required|digits:3',
        ]);

        Tarjeta::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return response()->json(['success' => '¡Tarjeta agregada con éxito!']);
    }

    public function update(Request $request, Tarjeta $tarjeta)
    {
        if ($tarjeta->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate([
            'nombre_titular' => 'required|string|max:255',
            'numero_tarjeta' => 'required|digits:16',
            'fecha_expiracion' => 'required|regex:/^\d{2}\/\d{2}$/',
            'ccv' => 'required|digits:3',
        ]);

        $tarjeta->update($request->all());

        return response()->json(['success' => '¡Tarjeta actualizada con éxito!']);
    }

    public function destroy(Tarjeta $tarjeta)
    {
        if ($tarjeta->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $tarjeta->delete();

        return response()->json(['success' => '¡Tarjeta eliminada con éxito!']);
    }
}
