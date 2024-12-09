<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8 text-center">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-28 ml-2 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <div class="container mx-auto mt-12 px-4">
            <!-- Encabezado de Mis Compras -->
            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-md mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Mis compras</h2>
            </div>

            <!-- Lista de Compras -->
            @forelse ($compras as $compra)
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        Pedido el {{ $compra->created_at->format('d M Y') }}
                    </h3>
                    <div class="flex items-start gap-4">
                        @foreach ($compra->detalles as $detalle)
                            <!-- Imagen del Producto -->
                            <img src="{{ asset('storage/' . $detalle->producto->imagen_path) }}" alt="{{ $detalle->producto->nombre }}" class="w-20 h-20 object-contain rounded-lg">

                            <!-- Detalles del Producto -->
                            <div class="text-left flex-1">
                                <p class="text-blue-600 font-bold text-lg">{{ $detalle->producto->nombre }}</p>
                                <p class="text-gray-800 font-bold">Precio unitario: <span class="text-blue-600">${{ number_format($detalle->precio, 2) }}</span></p>
                                <p class="text-gray-600 text-sm">Cantidad: {{ $detalle->cantidad }}</p>
                                <p class="text-gray-800 font-bold">Subtotal: <span class="text-blue-600">${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</span></p>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-gray-800 font-bold mt-4">Total de la compra: <span class="text-blue-600">${{ number_format($compra->total, 2) }}</span></p>
                </div>
            @empty
                <p class="text-gray-600">No has realizado ninguna compra.</p>
            @endforelse
        </div>

        <!-- Ventajas -->
        @include('components.ventajas')
    </main>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('block');
            } else {
                dropdown.classList.remove('block');
                dropdown.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
