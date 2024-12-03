<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    @vite('resources/css/app.css')
    <style>
        .input-field {
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
        }

        .input-field:focus {
            background-color: #fff;
            border-color: #0166A5;
            outline: none;
            box-shadow: 0 0 5px rgba(1, 102, 165, 0.5);
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-inner {
            margin: 0 20px;
            gap: 1rem;
        }

        .form-title {
            margin-bottom: 2rem;
        }

        .submit-button {
            background-color: #003152;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #0166A5;
        }

        .space-between {
            margin-top: 1rem;
        }

        .redirect-link {
            margin-top: 1rem;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#003152] to-[#0166A5] h-screen flex items-center justify-center">
    <div class="form-container flex w-4/5 md:w-3/4 lg:w-2/3">
        <!-- Sección Izquierda -->
        <div class="p-8 w-full lg:w-1/2">
            <h2 class="text-3xl font-bold text-center form-title">Registrarse</h2>

            <form method="POST" action="{{ route('register') }}" class="form-inner flex flex-col">
                @csrf

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium">Nombre</label>
                    <input id="nombre" class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500"
                        type="text" name="nombre" :value="old('nombre')" required autofocus placeholder="Nombre" />
                </div>

                <!-- Apellido -->
                <div>
                    <label for="apellido" class="block text-sm font-medium">Apellido</label>
                    <input id="apellido" class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500"
                        type="text" name="apellido" :value="old('apellido')" required placeholder="Apellido" />
                </div>

                <!-- Usuario -->
                <div>
                    <label for="usuario" class="block text-sm font-medium">Usuario</label>
                    <input id="usuario" class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500"
                        type="text" name="usuario" :value="old('usuario')" required placeholder="Usuario" />
                </div>

                <!-- Correo Electrónico -->
                <div>
                    <label for="email" class="block text-sm font-medium">Correo Electrónico</label>
                    <input id="email" class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500"
                        type="email" name="email" :value="old('email')" required
                        placeholder="Correo Electrónico" />
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium">Contraseña</label>
                    <input id="password" class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500"
                        type="password" name="password" required placeholder="Contraseña" />
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña</label>
                    <input id="password_confirmation"
                        class="input-field block mt-1 w-full p-3 rounded-md placeholder-gray-500" type="password"
                        name="password_confirmation" required placeholder="Confirmar Contraseña" />
                </div>

                <button type="submit" class="submit-button w-full space-between">
                    Registrar
                </button>
            </form>

            <p class="text-center text-sm redirect-link">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Iniciar
                    sesión</a>
            </p>
        </div>

        <!-- Imagen Lateral -->
        <div class="hidden lg:block lg:w-1/2">
            <img src="{{ asset('img/tec.jpeg') }}" alt="Imagen lateral" class="w-full h-full object-cover">
        </div>
    </div>
</body>

</html>
