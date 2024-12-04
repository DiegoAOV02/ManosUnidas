<!-- resources/views/components/navbar.blade.php -->
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
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Belleza y Cuidado Personal')" class="block">Belleza y Cuidado
                                Personal</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Construcción')" class="block">Construcción</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Electrodomésticos')" class="block">Electrodomésticos</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Hogar y Muebles')" class="block">Hogar y Muebles</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Moda')" class="block">Moda</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Supermercado')" class="block">Supermercado</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Tecnología')" class="block">Tecnología</a>
                        </li>
                        <li class="hover:bg-blue-100 px-2 py-1 rounded">
                            <a onclick="updateTitle('Vehículos')" class="block">Vehículos</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Carrito -->
            <div>
                <a onclick="window.location.href='{{ route('carrito') }}'" class="hover:underline">Carrito</a>
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
                        <li class="hover:bg-blue-100 px-2 py-1 rounded"><a href="/compras"
                                class="block text-gray-800">Mis compras</a></li>
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