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
                <div class="relative z-50">
                    <button class="hover:underline" onclick="toggleDropdown('categories-dropdown')">Categorías</button>
                    <div id="categories-dropdown"
                        class="hidden absolute left-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg z-50">
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
                <div class="relative z-50">
                    <button class="hover:underline" onclick="toggleDropdown('profile-dropdown')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14a4 4 0 100-8 4 4 0 000 8zM6 21v-1a4 4 0 014-4h4a4 4 0 014 4v1" />
                        </svg>
                    </button>
                    <div id="profile-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg z-50">
                        <ul class="p-2 space-y-2 text-sm">
                            <li class="hover:bg-blue-100 px-2 py-1 rounded">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left text-gray-800">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/direcciones"
                                    class="block text-gray-800">Direcciones</a></li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/editar-perfil"
                                    class="block text-gray-800">Editar perfil</a></li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/pedidos"
                                    class="block text-gray-800">Pedidos</a></li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/perfil"
                                    class="block text-gray-800">Perfil</a></li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/tarjetas"
                                    class="block text-gray-800">Tarjetas</a></li>
                            <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/vender"
                                    class="block text-gray-800">VENDER</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
    </script>
</body>

</html>
