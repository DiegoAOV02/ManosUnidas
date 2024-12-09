<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manos Unidas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        main {
            min-height: calc(100vh - 100px);
            /* Ajusta según la altura del navbar y el footer */
            margin-bottom: 2rem;
            /* Evita que las ofertas lleguen al footer */
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="container mx-auto py-14 px-8 relative">
        <!-- Ofertas Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Oferta del Día -->
            @if (isset($ofertaDelDia) && $ofertaDelDia)
                <a href="{{ route('publicacion', $ofertaDelDia->id) }}" id="oferta-del-dia"
                    class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Oferta del día</h2>
                    <img src="{{ asset('storage/' . $ofertaDelDia->imagen_path) }}"
                        alt="{{ $ofertaDelDia->nombre_producto }}" class="w-full h-48 object-contain mx-auto mb-4">
                    <p class="text-base text-gray-800">{{ $ofertaDelDia->nombre_producto }}</p>
                    <p class="text-gray-600 line-through">${{ number_format($ofertaDelDia->precio, 2) }}</p>
                    <p class="text-green-500 text-3xl font-bold">
                        ${{ number_format($ofertaDelDia->precio * (1 - $ofertaDelDia->descuento / 100), 2) }}
                    </p>
                    <p class="text-green-500 text-base">{{ $ofertaDelDia->descuento }}% OFF</p>
                    <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                </a>
            @endif

            <!-- Ofertas Destacadas -->
            <div id="ofertas-destacadas" class="col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-left">
                    Ofertas
                    <button id="toggleViewButton" onclick="toggleView()"
                        class="text-blue-600 text-base hover:underline">
                        Mostrar todas las ofertas
                    </button>
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @if (isset($ofertas) && $ofertas->count() > 0)
                        @foreach ($ofertas as $producto)
                            <a href="{{ route('publicacion', $producto->id) }}"
                                class="bg-white rounded-lg shadow-md p-6 text-left hover:shadow-lg transition-shadow">
                                <img src="{{ asset('storage/' . $producto->imagen_path) }}"
                                    alt="{{ $producto->nombre_producto }}" class="w-full h-48 object-contain mb-4">
                                <p class="text-sm text-gray-800">{{ $producto->nombre_producto }}</p>
                                <p class="text-gray-600 line-through">${{ number_format($producto->precio, 2) }}</p>
                                <p class="text-green-500 text-xl font-bold">
                                    ${{ number_format($producto->precio * (1 - $producto->descuento / 100), 2) }}
                                </p>
                                <p class="text-base text-green-500">{{ $producto->descuento }}% OFF</p>
                                <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                            </a>
                        @endforeach
                    @else
                        <p class="text-gray-600">No hay ofertas disponibles en este momento.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Todas las Ofertas -->
        @if ($todasLasOfertas->count() > 0)
            <div id="todas-ofertas" class="hidden mt-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-left">
                    Todas las ofertas
                    <button id="toggleViewButton" onclick="toggleView()"
                        class="text-blue-600 text-base hover:underline">
                        Mostrar ofertas principales
                    </button>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($todasLasOfertas as $producto)
                        <a href="{{ route('publicacion', $producto->id) }}"
                            class="bg-white rounded-lg shadow-md p-8 text-left hover:shadow-lg transition-shadow">
                            <img src="{{ asset('storage/' . $producto->imagen_path) }}"
                                alt="{{ $producto->nombre_producto }}" class="w-full h-48 object-contain mb-4">
                            <p class="text-sm text-gray-800">{{ $producto->nombre_producto }}</p>
                            <p class="text-gray-600 line-through">
                                ${{ number_format($producto->precio * (1 + $producto->descuento / 100), 2) }}
                            </p>
                            <p class="text-green-500 text-xl font-bold">
                                ${{ number_format($producto->precio, 2) }}
                            </p>
                            <p class="text-green-500 text-sm font-semibold">
                                {{ $producto->descuento }}% OFF
                            </p>
                            <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-600">No hay productos disponibles con ofertas en este momento.</p>
        @endif

        <!-- Ventajas -->
        @include('components.ventajas')
    </main>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        function toggleView() {
            const ofertaDelDia = document.getElementById('oferta-del-dia');
            const ofertasDestacadas = document.getElementById('ofertas-destacadas');
            const todasOfertas = document.getElementById('todas-ofertas');
            const toggleButton = document.getElementById('toggleViewButton');

            // Alternar visibilidad
            if (todasOfertas.classList.contains('hidden')) {
                todasOfertas.classList.remove('hidden');
                ofertaDelDia.classList.add('hidden');
                ofertasDestacadas.classList.add('hidden');
                toggleButton.textContent = "Ver ofertas principales";
            } else {
                todasOfertas.classList.add('hidden');
                ofertaDelDia.classList.remove('hidden');
                ofertasDestacadas.classList.remove('hidden');
                toggleButton.textContent = "Ver todas las ofertas";
            }
        }
    </script>
</body>

</html>
