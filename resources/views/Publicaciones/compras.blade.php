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
                <div class="relative inline-block">
                    <button onclick="toggleDropdown('time-dropdown')"
                        class="text-blue-600 hover:underline text-sm font-medium flex items-center gap-1 focus:outline-none">
                        últimos 3 meses
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Opciones desplegables -->
                    <div id="time-dropdown"
                        class="absolute hidden bg-white border border-gray-300 rounded-lg shadow-md mt-2 w-40 z-50">
                        <ul class="py-2 text-sm text-gray-800">
                            <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Últimos 3 meses</a></li>
                            <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Últimos 6 meses</a></li>
                            <li class="px-4 py-2 hover:bg-gray-100"><a href="#">Todo el tiempo</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Lista de Compras -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Entregado el 28 de noviembre</h3>
                <div class="flex items-start gap-4">
                    <!-- Imagen del Producto -->
                    <img src="img/iphone.png" alt="Producto" class="w-20 h-20 object-contain rounded-lg">

                    <!-- Detalles del Producto -->
                    <div class="text-left flex-1">
                        <p class="text-blue-600 font-bold text-lg">iPhone 16 128GB Color Blanco Glacial</p>
                        <p class="text-gray-800 font-bold">Total: <span class="text-blue-600">$14,500.00</span></p>
                        <p class="text-gray-600 text-sm">Pedido No. IOJSN2BUYVBIU2O3J9</p>
                    </div>

                    <!-- Botón Volver a Comprar -->
                    <div class="flex items-start">
                        <button onclick="window.location.href='{{ route('publicacion') }}'"
                            class="border border-blue-600 text-blue-600 font-bold py-2 px-4 rounded-lg hover:bg-blue-100">
                            Volver a comprar
                        </button>
                    </div>
                </div>
            </div>
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
