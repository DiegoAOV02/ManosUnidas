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

    <main class="container mx-auto py-14 px-8 text-center">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-28 ml-2 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <h1 class="text-2xl font-bold text-gray-800 mb-8">Pedido realizado <span class="text-blue-600">No. Pedido:
                AKNSIU8923N</span></h1>
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-8 max-w-xl mx-auto">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-600 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-lg font-medium text-gray-800">En un momento más te llegará a tu correo el código de
                    rastreo</p>
            </div>
        </div>

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
