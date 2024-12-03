<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    @vite('resources/css/app.css')
    <style>
        .input-field {
            background-color: rgba(255, 255, 255, 0.5);
            color: #000;
            border: 1px solid #ccc;
        }

        .input-field:focus {
            background-color: rgba(255, 255, 255, 0.8);
            border-color: #0166A5;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#003152] to-[#0166A5] h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg flex w-4/5 md:w-3/4 lg:w-2/3 overflow-hidden">
        <!-- Sección Izquierda -->
        <div class="p-10 w-full lg:w-1/2">
            <h2 class="text-3xl font-bold text-center mb-8">Recuperar Contraseña</h2>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('¿Olvidaste tu contraseña? No te preocupes. Solo ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <input id="email"
                        class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500 focus:ring focus:ring-blue-400"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Correo Electrónico" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit"
                        class="w-full bg-[#003152] text-white py-3 rounded-md hover:bg-[#0166A5] text-lg font-semibold">
                        Enviar enlace de recuperación
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Volver al inicio de
                    sesión</a>
            </div>
        </div>

        <!-- Imagen Lateral -->
        <div class="hidden lg:block lg:w-1/2">
            <img src="{{ asset('img/tec.jpeg') }}" alt="Imagen lateral" class="w-full h-full object-cover">
        </div>
    </div>
</body>

</html>
