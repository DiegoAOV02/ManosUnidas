<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articulo</title>
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

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center mx-auto max-w-screen-xl mb-20">
            <!-- Producto -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div class="flex-grow">
                    <img src="img/arbol.jpg" alt="Árbol de Navidad" class="w-full h-60 object-contain mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Árbol de Navidad Artificial Pino 1.8m OHS7GY</h2>
                    <p class="text-gray-600 line-through text-sm mt-2">$1,500.00</p>
                    <p class="text-green-500 text-3xl font-bold">$1,450.00</p>
                    <p class="text-green-500 text-base">5% OFF</p>
                </div>
                <a href="#" class="text-blue-600 text-sm hover:underline mt-4 inline-block">Ver información del
                    producto</a>
            </div>

            <!-- Panel de Compra -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2 flex flex-col justify-center">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Precio más conveniente</h3>
                <p class="text-gray-800 text-3xl font-bold">$1,450.00</p>
                <p class="text-sm text-gray-600">IVA incluido</p>
                <p class="text-green-500 font-bold text-lg mt-4">Llega gratis mañana</p>
                <p class="text-sm text-gray-600">Comprando dentro de las próximas 2h 34min</p>
                <div class="flex items-center gap-8 mt-4">
                    <label for="quantity" class="text-gray-800 font-bold">Cantidad:</label>
                    <select id="quantity" class="border border-gray-300 rounded-md p-2 w-40">
                        <option>1 unidad</option>
                        <option>2 unidades</option>
                        <option>3 unidades</option>
                    </select>
                </div>
                <div class="flex gap-4 mt-6">
                    <button onclick="window.location.href='{{ route('pago') }}'"
                        class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                        Comprar ahora
                    </button>

                    <button onclick="window.location.href='{{ route('carrito') }}'"
                        class="border border-blue-600 text-blue-600 font-bold py-2 px-4 rounded-lg hover:bg-blue-100">Agregar
                        al carrito</button>
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
