<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido realizado</title>
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

         <!-- Título de Mi Carrito -->
    <h2 class="text-2xl font-bold text-gray-800 mb-8">Mi carrito</h2>
    
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @if ($carrito->isNotEmpty())
            @foreach ($carrito as $item)
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $item->producto->imagen_path) }}" alt="{{ $item->producto->nombre }}" class="w-16 h-16 object-contain rounded-lg">
                        <div>
                        <p class="text-gray-800 font-bold">{{ $item->producto->nombre }}</p>
                        <p class="text-gray-600">Precio: ${{ number_format($item->producto->precio, 2) }}</p>
                        <p class="text-gray-600">Cantidad: {{ $item->cantidad }}</p>
                        </div>
                    </div>
                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-sm hover:underline">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endforeach
    
            <!-- Resumen del carrito -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    Subtotal: <span class="text-blue-600">
                        ${{ number_format($carrito->sum(fn($item) => $item->producto->precio * $item->cantidad), 2) }}
                    </span>
                </h3>
                <p class="text-gray-600 mb-4 text-sm">Pueden aplicarse tarifas de importación al finalizar la compra.</p>
                <button onclick="window.location.href='{{ route('pago') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-full">
                    Proceder al pago
                </button>
            </div>
        @else
            <p class="text-gray-600">Tu carrito está vacío.</p>
        @endif
    </section>    

        <!-- Ventajas -->
        @include('components.ventajas')
    </main>
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>