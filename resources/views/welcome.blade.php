<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manos Unidas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-[#003152] to-[#0166A5] text-white min-h-screen">
    <!-- Header -->
    <header class="container mx-auto flex justify-between items-center py-4 px-8">
        <div class="flex items-center">
            <img src="img/logo.png" alt="Logo Manos Unidas" class="w-12 h-12">
            <h1 class="text-2xl font-bold ml-4">ManosUnidas</h1>
        </div>
        @if (Route::has('login'))
            <nav class="flex justify-end gap-4">
                @auth
                    <!-- Enlace al Dashboard si el usuario está autenticado -->
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black bg-white ring-1 ring-gray-300 transition hover:bg-gray-100 focus:outline-none focus-visible:ring-blue-500">
                        Dashboard
                    </a>
                @else
                    <!-- Enlace al Login si el usuario no está autenticado -->
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-gray-300 transition hover:bg-blue-500 hover:text-black focus:outline-none focus-visible:ring-white">
                        Iniciar Sesión
                    </a>

                    <!-- Enlace al Registro si la ruta está disponible -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-white ring-1 ring-gray-300 transition hover:bg-green-500 hover:text-black focus:outline-none focus-visible:ring-white">
                            Registrarte
                        </a>
                    @endif
                @endauth
            </nav>
        @endif

    </header>

    <!-- Sección principal -->
    <main class="container mx-auto flex flex-col lg:flex-row items-center gap-8 px-8 py-16">
        <!-- Imagen -->
        <div class="lg:w-1/2">
            <img src="img/personas.jpg" alt="Personas usando Manos Unidas" class="rounded-lg shadow-md">
        </div>

        <!-- Texto -->
        <div class="lg:w-1/2 text-center lg:text-left">
            <h2 class="text-4xl font-bold mb-4">COMPRA Y VENDE <span class="text-blue-300">SEGURO</span></h2>
            <p class="text-lg">Únete a esta plataforma donde miles de personas pueden sentirse seguros al comprar sus
                productos favoritos.</p>
        </div>
    </main>

    <!-- Sección de testimonios -->
<section>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Testimonio 1 -->
        <div class="bg-white/90 text-black p-6 rounded-lg shadow-md">
            <p class="font-bold text-lg">Rafael Báez</p>
            <p class="text-sm text-gray-600">69 años, Tampico, México</p>
            <p class="mt-4">¡Gracias a Manos Unidas, le he perdido el miedo a comprar en línea!</p>
        </div>

        <!-- Testimonio 2 -->
        <div class="bg-white/90 text-black p-6 rounded-lg shadow-md">
            <p class="font-bold text-lg">Verónica Flores</p>
            <p class="text-sm text-gray-600">123 años, Culiacán, Sinaloa</p>
            <p class="mt-4">¡La experiencia con Manos Unidas es completamente diferente a las demás!</p>
        </div>
    </div>
</section>

</body>

</html>
