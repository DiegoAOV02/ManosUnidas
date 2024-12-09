<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre_producto }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="container mx-auto py-14 px-8 relative">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()" class="absolute top-0 ml-2 mt-4 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center mx-auto max-w-screen-xl mb-20">
            <!-- Producto -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div class="flex-grow">
                    <img src="{{ asset('storage/' . $producto->imagen_path) }}" alt="{{ $producto->nombre_producto }}" class="w-full h-60 object-contain mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $producto->nombre_producto }}</h2>
                    <p class="text-gray-600 line-through">
                        ${{ number_format($producto->precio, 2) }}
                    </p>
                    <p class="text-green-500 text-xl font-bold">
                        ${{ number_format($producto->precio - ($producto->precio * $producto->descuento / 100), 2) }}
                    </p>
                    <p class="text-green-500 text-base">{{ $producto->descuento }}% OFF</p>                    
                </div>
                <!-- Descripción desplegable -->
                <div>
                    <button onclick="toggleDescription()" class="text-blue-600 text-sm hover:underline mt-4 inline-block">
                        Ver información del producto
                    </button>
                    <div id="product-description" class="hidden mt-4 bg-gray-100 rounded-lg p-4 border border-gray-300">
                        <p class="text-gray-700 text-sm">{{ $producto->descripcion_producto }}</p>
                    </div>
                </div>
            </div>

            <!-- Panel de Compra -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2 flex flex-col justify-center">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Precio más conveniente</h3>
                <p class="text-gray-800 text-3xl font-bold">${{ number_format($producto->precio, 2) }}</p>
                <p class="text-green-500 font-bold text-lg mt-4">Llega gratis mañana</p>
                <div class="flex items-center gap-8 mt-4">
                    <label for="quantity" class="text-gray-800 font-bold">Cantidad:</label>
                    <select id="quantity" class="border border-gray-300 rounded-md p-2 w-40">
                        @for ($i = 1; $i <= $producto->unidades_disponibles; $i++)
                            <option>{{ $i }} unidad{{ $i > 1 ? 'es' : '' }}</option>
                        @endfor
                    </select>
                </div>                
                <div class="flex gap-4 mt-6">
                    <button onclick="window.location.href='{{ route('pago') }}'" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                        Comprar ahora
                    </button>
                    <button onclick="window.location.href='{{ route('carrito') }}'" class="border border-blue-600 text-blue-600 font-bold py-2 px-4 rounded-lg hover:bg-blue-100">
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Ventajas -->
        @include('components.ventajas')
    </main>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        // Función para mostrar/ocultar la descripción del producto
        function toggleDescription() {
            const description = document.getElementById('product-description');
            description.classList.toggle('hidden');
        }
    </script>
</body>

</html>
