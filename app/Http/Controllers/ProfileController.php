<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Perfil.cuenta', compact('user'));
    }

    public function perfil()
    {
        $user = Auth::user();

        // Retornar la vista `Perfil.perfil` con los datos del usuario
        return view('Perfil.perfil', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            // Validar datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'usuario' => 'required|string|max:255|unique:users,usuario,' . $user->id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Preparar datos para la actualización
            $userData = [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'usuario' => $request->usuario,
                'email' => $request->email,
            ];

            // Solo actualizar la contraseña si se proporciona
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Actualizar el modelo
            $user->update($userData);

            return response()->json(['success' => '¡Información actualizada con éxito!']);
        } catch (\Exception $e) {
            Log::error('Error al actualizar perfil:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al actualizar la información'], 500);
        }
    }

    public function destroy()
    {
        try {
            $user = Auth::user();

            // Elimina al usuario autenticado
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error al eliminar cuenta:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al eliminar la cuenta'], 500);
        }
    }
}
