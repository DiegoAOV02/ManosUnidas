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
    <header class="bg-gradient-to-r from-[#003152] to-[#0166A5] text-white py-4 px-8">
        <div class="container mx-auto flex items-center">
             <!-- Logo -->
             <div class="flex items-center gap-4">
                <a href="/dashboard" class="flex items-center gap-4">
                    <img src="img/logo.png" alt="Logo Manos Unidas" class="w-12 h-12">
                    <h1 class="text-2xl font-bold">ManosUnidas</h1>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="relative ml-6 flex-1 max-w-[300px]">
                <input type="text" placeholder="Buscar producto..."
                    class="w-full p-2 pr-10 pl-4 rounded-lg text-gray-700 placeholder-gray-500">
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <img src="img/buscar.png" alt="Buscar" class="w-5 h-5">
                </span>
            </div>
            
            <!-- Right-side Options -->
            <div class="flex items-center gap-14 ml-auto">
                <!-- Categorías -->
                <div class="relative">
                    <button class="hover:underline" onclick="toggleDropdown('categories-dropdown')">Categorías</button>
                    <div id="categories-dropdown"
                        class="hidden absolute left-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg">
                        <ul class="p-2 space-y-2 text-sm">
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Belleza y Cuidado Personal</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Construcción</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Electrodomésticos</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Hogar y Muebles</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Moda</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Supermercado</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Tecnología</li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">Vehículos</li>
                        </ul>
                    </div>
                </div>

                <!-- Carrito -->
                <div>
                    <a href="#" class="hover:underline">Carrito</a>
                </div>

                <!-- Perfil -->
                <div class="relative">
                    <button class="hover:underline" onclick="toggleDropdown('profile-dropdown')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14a4 4 0 100-8 4 4 0 000 8zM6 21v-1a4 4 0 014-4h4a4 4 0 014 4v1" />
                        </svg>
                    </button>
                    <div id="profile-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg">
                        <ul class="p-2 space-y-2 text-sm">
                            <!-- Cerrar sesión -->
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left text-gray-800">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/direcciones" class="block text-gray-800">Direcciones</a>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/editar-perfil" class="block text-gray-800">Editar perfil</a>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/pedidos" class="block text-gray-800">Pedidos</a>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/perfil" class="block text-gray-800">Perfil</a>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/tarjetas" class="block text-gray-800">Tarjetas</a>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <a href="/vender" class="block text-gray-800">VENDER</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </header>

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
        <section
            class="bg-gradient-to-r from-[#003152] to-[#0166A5] text-white fixed bottom-0 left-0 right-0 p-6 flex justify-around items-center text-center z-10">
            <div class="flex flex-col items-center">
                <img src="img/tarjeta.png" alt="Elige cómo pagar" class="w-12 h-12 mb-2">
                <p class="font-bold">Elige cómo pagar</p>
                <p class="text-sm text-center">Puedes pagar con tarjeta, débito, efectivo o con Meses sin Tarjeta.</p>
            </div>
            <div class="border-l border-white mx-4 h-12"></div>
            <div class="flex flex-col items-center">
                <img src="img/camion.png" alt="Envío gratis" class="w-12 h-12 mb-2">
                <p class="font-bold">Envío gratis en tu primer compra</p>
                <p class="text-sm text-center">Aprovecha este beneficio en millones de productos.</p>
            </div>
            <div class="border-l border-white mx-4 h-12"></div>
            <div class="flex flex-col items-center">
                <img src="img/verificado.png" alt="Seguridad en tus compras" class="w-12 h-12 mb-2">
                <p class="font-bold">Seguridad en tus compras</p>
                <p class="text-sm text-center">Tus compras están aseguradas para regresarte tu dinero.</p>
            </div>
        </section>


    </main>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>
