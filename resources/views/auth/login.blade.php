<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    @vite('resources/css/app.css')
    <style>
        /* Asegurar fondo transparente */
        .input-field {
            background-color: rgba(255, 255, 255, 0.5); /* Fondo blanco semi-transparente */
            color: #000; /* Texto negro */
            border: 1px solid #ccc; /* Borde gris claro */
        }
        .input-field:focus {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo más blanco al enfocarse */
            border-color: #0166A5; /* Borde azul al enfocar */
        }
    </style>
</head>
<body class="bg-gradient-to-b from-[#003152] to-[#0166A5] h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg flex w-4/5 md:w-3/4 lg:w-2/3 overflow-hidden">
        <!-- Sección Izquierda -->
        <div class="p-10 w-full lg:w-1/2">
            <h2 class="text-3xl font-bold text-center mb-8">Iniciar sesión</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <input
                        id="email"
                        class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500 focus:ring focus:ring-blue-400"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <input
                        id="password"
                        class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500 focus:ring focus:ring-blue-400"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Contraseña" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-blue-400" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Recordar</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu Contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#003152] text-white py-3 rounded-md hover:bg-[#0166A5] text-lg font-semibold">
                    Iniciar
                </button>
            </form>

            <!-- Enlace de Registro -->
            <p class="mt-6 text-center text-sm">
                ¿Aún no tienes una cuenta? 
                <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">Registrarte</a>
            </p>
        </div>

        <!-- Imagen Lateral -->
        <div class="hidden lg:block lg:w-1/2">
            <img src="{{ asset('img/tec.jpeg') }}" alt="Imagen lateral" class="w-full h-full object-cover">
        </div>
    </div>
</body>
</html>
