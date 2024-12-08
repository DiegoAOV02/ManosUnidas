<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DireccionController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $direcciones = Direccion::where('user_id', $userId)->get();

        return view('Perfil.direcciones', [
            'direcciones' => $direcciones
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'calle' => 'required|string|max:255',
                'numero' => 'required|string|max:20',
                'codigo_postal' => 'required|string|max:10',
                'colonia' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
                'estado' => 'required|string|max:255',
                'pais' => 'required|string|max:255',
            ]);

            $data = array_merge($request->all(), ['user_id' => Auth::id()]);
            
            Log::info('Intentando crear dirección:', $data);

            $direccion = Direccion::create($data);

            Log::info('Dirección creada exitosamente:', ['direccion_id' => $direccion->id]);

            return response()->json(['success' => '¡Dirección agregada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al crear dirección:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al guardar la dirección'], 500);
        }
    }

    public function update(Request $request, Direccion $direccion)
    {
        try {
            if ($direccion->user_id !== Auth::id()) {
                Log::warning('Intento no autorizado de actualizar dirección', [
                    'direccion_id' => $direccion->id,
                    'user_id' => Auth::id()
                ]);
                return response()->json(['error' => 'No autorizado'], 403);
            }

            $request->validate([
                'calle' => 'required|string|max:255',
                'numero' => 'required|string|max:20',
                'codigo_postal' => 'required|string|max:10',
                'colonia' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
                'estado' => 'required|string|max:255',
                'pais' => 'required|string|max:255',
            ]);

            $direccion->update($request->all());

            return response()->json(['success' => '¡Dirección actualizada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al actualizar dirección:', [
                'direccion_id' => $direccion->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error al actualizar la dirección'], 500);
        }
    }

    public function destroy(Direccion $direccion)
    {
        try {
            if ($direccion->user_id !== Auth::id()) {
                return response()->json(['error' => 'No autorizado'], 403);
            }

            $direccion->delete();

            return response()->json(['success' => '¡Dirección eliminada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al eliminar dirección:', [
                'direccion_id' => $direccion->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error al eliminar la dirección'], 500);
        }
    }
}