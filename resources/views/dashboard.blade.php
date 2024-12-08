<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manos Unidas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

     <!-- Main Content -->
     <main class="container mx-auto p-8">
        <!-- Ofertas Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            <!-- Oferta del Día -->
            <a href="{{ route('publicacion') }}"
                class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Oferta del día</h2>
                <img src="img/arbol.jpg" alt="Árbol de Navidad" class="w-full h-48 object-contain mx-auto mb-4">
                <p class="text-base text-gray-800">Árbol de Navidad Artificial Pino 1.8m OHS7GY</p>
                <p class="text-gray-600 line-through">$1,500</p>
                <p class="text-green-500 text-3xl font-bold">$1,450</p>
                <p class="text-green-500 text-base">5% OFF</p>
                <p class="text-base text-green-600 mt-4">Envío Gratis</p>
            </a>

            <!-- Ofertas -->
            <div class="col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-left">
                    Ofertas <a href="#" class="text-blue-600 text-base hover:underline">Mostrar todas las
                        ofertas</a>
                </h2>
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
                        <img src="img/refrigerador.jpeg" alt="Refrigerador LG"
                            class="w-full h-48 object-contain mb-4">
                        <p class="text-sm text-gray-800">Refrigerador LG con pantalla táctil</p>
                        <p class="text-gray-600 line-through">$35,000</p>
                        <p class="text-green-500 text-xl font-bold">$15,000</p>
                        <p class="text-base text-green-500">25% OFF</p>
                        <p class="text-base text-green-600 mt-4">Envío Gratis</p>
                    </a>
                    <!-- Producto -->
                    <a href="{{ route('publicacion') }}"
                        class="bg-white rounded-lg shadow-md p-6 text-left w-full max-w-md hover:shadow-lg transition-shadow">
                        <img src="img/refrigerador.jpeg" alt="Refrigerador LG"
                            class="w-full h-48 object-contain mb-4">
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
