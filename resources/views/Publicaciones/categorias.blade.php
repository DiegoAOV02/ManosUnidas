<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busacar</title>
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

        <!-- Ofertas -->
        <div class="col-span-2">
            <h2 id="page-title" class="text-xl font-bold text-gray-800 mb-4">Productos</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Producto -->
                <a href="{{ route('publicacion') }}"
                    class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                    <img src="img/iphone.png" alt="iPhone 16" class="w-full h-48 object-contain mb-4">
                    <p class="text-sm text-gray-800">iPhone 16 128GB Color Blanco Glacial</p>
                    <p class="text-gray-600 line-through">$15,000</p>
                    <p class="text-green-500 text-xl font-bold">$14,500</p>
                    <p class="text-base text-green-500">5% OFF</p>
                    <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                </a>
                <!-- Producto -->
                <a href="{{ route('publicacion') }}"
                    class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                    <img src="img/karely.jpg" alt="Disfraz de Karely" class="w-full h-48 object-contain mb-4">
                    <p class="text-sm text-gray-800">Disfraz de Karely Ruiz Talla M</p>
                    <p class="text-gray-600 line-through">$250</p>
                    <p class="text-green-500 text-xl font-bold">$150</p>
                    <p class="text-base text-green-500">15% OFF</p>
                    <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                </a>
                <!-- Producto -->
                <a href="{{ route('publicacion') }}"
                    class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                    <img src="img/refrigerador.jpeg" alt="Refrigerador LG" class="w-full h-48 object-contain mb-4">
                    <p class="text-sm text-gray-800">Refrigerador LG con pantalla táctil</p>
                    <p class="text-gray-600 line-through">$35,000</p>
                    <p class="text-green-500 text-xl font-bold">$15,000</p>
                    <p class="text-base text-green-500">25% OFF</p>
                    <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                </a>
                <!-- Producto -->
                <a href="{{ route('publicacion') }}"
                    class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                    <img src="img/refrigerador.jpeg" alt="Refrigerador LG" class="w-full h-48 object-contain mb-4">
                    <p class="text-sm text-gray-800">Refrigerador LG con pantalla táctil</p>
                    <p class="text-gray-600 line-through">$35,000</p>
                    <p class="text-green-500 text-xl font-bold">$15,000</p>
                    <p class="text-base text-green-500">25% OFF</p>
                    <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                </a>
            </div>
        </div>
        </section>

        <!-- Ventajas -->
        <section
            class="bg-gradient-to-r from-[#003152] to-[#0166A5] text-white fixed bottom-0 left-0 right-0 p-6 flex justify-around items-center text-center z-10">
            <div class="flex flex-col items-center">
                <img src="img/tarjeta.png" alt="Elige cómo pagar" class="w-12 h-12 mb-2">
                <p class="font-bold">Elige cómo pagar</p>
                <p class="text-sm">Puedes pagar con tarjeta, débito, efectivo o con Meses sin Tarjeta.</p>
            </div>
            <div class="border-l border-white mx-4 h-12"></div>
            <div class="flex flex-col items-center">
                <img src="img/camion.png" alt="Envío gratis" class="w-12 h-12 mb-2">
                <p class="font-bold">Envío gratis en tu primer compra</p>
                <p class="text-sm">Aprovecha este beneficio en millones de productos.</p>
            </div>
            <div class="border-l border-white mx-4 h-12"></div>
            <div class="flex flex-col items-center">
                <img src="img/verificado.png" alt="Seguridad en tus compras" class="w-12 h-12 mb-2">
                <p class="font-bold">Seguridad en tus compras</p>
                <p class="text-sm">Tus compras están aseguradas para regresarte tu dinero.</p>
            </div>
        </section>
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
