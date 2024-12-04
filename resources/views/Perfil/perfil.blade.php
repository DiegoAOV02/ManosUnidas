<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Menú lateral -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Mi cuenta</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="/misVentas"
                                class="flex items-center gap-2 text-blue-600 font-medium hover:underline">
                                <img src="img/ventas.png" alt="Mis ventas" class="w-5 h-5">
                                Mis ventas
                            </a>
                        </li>
                        <li>
                            <a href="/vender"
                                class="flex items-center gap-2 text-blue-600 font-medium hover:underline">
                                <img src="img/ventas.png" alt="Vender" class="w-5 h-5">
                                Vender
                            </a>
                        </li>
                        <li>
                            <a href="/compras"
                                class="flex items-center gap-2 text-blue-600 font-medium hover:underline">
                                <img src="img/compras.png" alt="Compras" class="w-5 h-5">
                                Compras
                            </a>
                        </li>
                        <li>
                            <a href="/cuenta"
                                class="flex items-center gap-2 text-blue-600 font-medium hover:underline">
                                <img src="img/perfil.png" alt="Cuenta" class="w-5 h-5">
                                Cuenta
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Información de la cuenta -->
                <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="img/usuario.png" alt="Usuario" class="w-12 h-12 rounded-full">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Diego A. Ortiz</h2>
                            <p class="text-sm text-gray-600">2030282@upv.edu.mx</p>
                        </div>
                    </div>
                    <hr class="border-gray-300 mb-4">
                    <ul class="space-y-2">
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="img/tarjeta3.png" alt="Tarjetas" class="w-5 h-5">
                                <p class="text-gray-800 font-medium">Tarjetas</p>
                            </div>
                            <a href="/tarjetas" class="text-blue-600 text-sm font-medium hover:underline">Ver</a>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="img/direcciones.png" alt="Direcciones" class="w-5 h-5">
                                <p class="text-gray-800 font-medium">Direcciones</p>
                            </div>
                            <a href="/direcciones" class="text-blue-600 text-sm font-medium hover:underline">Ver</a>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <button
                            class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 flex items-center gap-2">
                            Eliminar Cuenta
                        </button>
                    </div>
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
