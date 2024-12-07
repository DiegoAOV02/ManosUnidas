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
    
    <!-- Productos en el carrito -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Producto 1 -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
            <div class="flex items-center gap-4">
                <img src="img/iphone.png" alt="iPhone 16" class="w-16 h-16 object-contain rounded-lg">
                <div>
                    <p class="text-gray-800 font-bold">iPhone 16 128GB Color Blanco Glacial</p>
                    <p class="text-gray-600">Precio: $14,500.00</p>
                </div>
            </div>
            <p class="text-green-500 font-bold mt-4">Agregado al carrito</p>
        </div>

        <!-- Producto 2 -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
            <div class="flex items-center gap-4">
                <img src="img/arbol.jpg" alt="Árbol de Navidad" class="w-16 h-16 object-contain rounded-lg">
                <div>
                    <p class="text-gray-800 font-bold">Árbol de Navidad Artificial Pino 1.8m OHS7GY</p>
                    <p class="text-gray-600">Precio: $1,450.00</p>
                </div>
            </div>
            <p class="text-green-500 font-bold mt-4">Agregado al carrito</p>
        </div>

        <!-- Resumen del carrito -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Subtotal: <span class="text-blue-600">$15,950.00</span></h3>
            <p class="text-gray-600 mb-4 text-sm">Pueden aplicarse tarifas de importación al finalizar la compra.</p>
            <button onclick="window.location.href='{{ route('pago') }}'"
                class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-full">
                Proceder al pago
            </button>
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
    </script>
</body>

</html>