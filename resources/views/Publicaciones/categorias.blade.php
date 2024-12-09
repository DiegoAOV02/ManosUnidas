<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manos unidas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <!-- Main Content -->
    <main class="container mx-auto py-14 px-8 relative">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-0 ml-2 mt-4 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <!-- Título de la Categoría -->
        <h2 id="page-title" class="text-xl font-bold text-gray-800 mb-4">Productos en {{ $categoria }}</h2>

        <!-- Productos -->
        @if ($productos->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <a href="{{ route('publicacion', ['id' => $producto->id]) }}"
                        class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                        <!-- Imagen del Producto -->
                        <img src="{{ asset('storage/' . $producto->imagen_path) }}"
                            alt="{{ $producto->nombre_producto }}" class="w-full h-48 object-contain mb-4">

                        <!-- Detalles del Producto -->
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
        @else
            <p class="text-gray-600">No hay productos disponibles en esta categoría.</p>
        @endif

        <!-- Ventajas -->
        @include('components.ventajas')
    </main>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        function updateTitle(category) {
            const title = document.getElementById('page-title');
            title.textContent = category;
        }

        function updateTitleFromSearch() {
            const searchInput = document.getElementById('search-input').value.trim();
            const title = document.getElementById('page-title');
            if (searchInput) {
                title.textContent = `Resultados para: "${searchInput}"`;
            } else {
                title.textContent = 'Productos'; // Valor por defecto
            }
        }
    </script>
</body>

</html>
