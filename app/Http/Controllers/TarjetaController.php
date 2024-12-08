<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TarjetaController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        
        $tarjetas = Tarjeta::where('user_id', $userId)->get();
        
        return view('Perfil.tarjetas', [
            'tarjetas' => $tarjetas,
            'debug_info' => [
                'user_id' => $userId,
                'has_cards' => $tarjetas->isNotEmpty(),
                'card_count' => $tarjetas->count()
            ]
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre_titular' => 'required|string|max:255',
                'numero_tarjeta' => 'required|digits:16',
                'fecha_expiracion' => 'required|regex:/^\d{2}\/\d{2}$/',
                'ccv' => 'required|digits:3',
            ]);

            $data = array_merge($request->all(), ['user_id' => Auth::id()]);
            
            Log::info('Intentando crear tarjeta:', array_merge(
                $data,
                ['ccv' => '***']
            ));

            $tarjeta = Tarjeta::create($data);

            Log::info('Tarjeta creada exitosamente:', ['tarjeta_id' => $tarjeta->id]);

            return response()->json(['success' => '¡Tarjeta agregada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al crear tarjeta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al guardar la tarjeta'], 500);
        }
    }

    public function update(Request $request, Tarjeta $tarjeta)
    {
        try {
            if ($tarjeta->user_id !== Auth::id()) {
                Log::warning('Intento no autorizado de actualizar tarjeta', [
                    'tarjeta_id' => $tarjeta->id,
                    'user_id' => Auth::id()
                ]);
                return response()->json(['error' => 'No autorizado'], 403);
            }

            $request->validate([
                'nombre_titular' => 'required|string|max:255',
                'numero_tarjeta' => 'required|digits:16',
                'fecha_expiracion' => 'required|regex:/^\d{2}\/\d{2}$/',
                'ccv' => 'required|digits:3',
            ]);

            Log::info('Actualizando tarjeta:', [
                'tarjeta_id' => $tarjeta->id,
                'user_id' => Auth::id()
            ]);

            $tarjeta->update($request->all());

            Log::info('Tarjeta actualizada exitosamente:', ['tarjeta_id' => $tarjeta->id]);

            return response()->json(['success' => '¡Tarjeta actualizada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al actualizar tarjeta:', [
                'tarjeta_id' => $tarjeta->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error al actualizar la tarjeta'], 500);
        }
    }

    public function destroy(Tarjeta $tarjeta)
    {
        try {
            if ($tarjeta->user_id !== Auth::id()) {
                Log::warning('Intento no autorizado de eliminar tarjeta', [
                    'tarjeta_id' => $tarjeta->id,
                    'user_id' => Auth::id()
                ]);
                return response()->json(['error' => 'No autorizado'], 403);
            }

            Log::info('Eliminando tarjeta:', [
                'tarjeta_id' => $tarjeta->id,
                'user_id' => Auth::id()
            ]);

            $tarjeta->delete();

            Log::info('Tarjeta eliminada exitosamente:', ['tarjeta_id' => $tarjeta->id]);

            return response()->json(['success' => '¡Tarjeta eliminada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al eliminar tarjeta:', [
                'tarjeta_id' => $tarjeta->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Error al eliminar la tarjeta'], 500);
        }
    }
}