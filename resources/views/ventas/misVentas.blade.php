<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis ventas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="container mx-auto py-14 px-8 relative">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-0 ml-2 mt-4 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <section class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Mis ventas</h1>
            <div class="space-y-4">
                <!-- Producto 1 -->
                <div class="border border-blue-300 rounded-lg p-4 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <img src="img/iphone.png" alt="iPhone 16" class="w-16 h-16 object-contain">
                        <div>
                            <h2 class="text-lg font-bold text-blue-600">iPhone 16 128GB Color Blanco Glacial</h2>
                            <p class="text-sm text-gray-600">Precio: $14,500.00</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button onclick="window.location.href='{{ route('vender') }}'" class="bg-blue-600 text-white font-bold py-1 px-4 rounded-lg hover:bg-blue-700">Editar publicación</button>
                        <button class="border border-blue-600 text-blue-600 font-bold py-1 px-4 rounded-lg hover:bg-blue-100">Eliminar publicación</button>
                    </div>
                </div>
                <!-- Producto 2 -->
                <div class="border border-blue-300 rounded-lg p-4 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <img src="img/arbol.jpg" alt="Árbol de Navidad" class="w-16 h-16 object-contain">
                        <div>
                            <h2 class="text-lg font-bold text-blue-600">Árbol de Navidad Artificial Pino 1.8m...</h2>
                            <p class="text-sm text-gray-600">Precio: $1,450.00</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button onclick="window.location.href='{{ route('vender') }}'" class="bg-blue-600 text-white font-bold py-1 px-4 rounded-lg hover:bg-blue-700">Editar publicación</button>
                        <button class="border border-blue-600 text-blue-600 font-bold py-1 px-4 rounded-lg hover:bg-blue-100">Eliminar publicación</button>
                    </div>
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
    </script>
</body>

</html>
