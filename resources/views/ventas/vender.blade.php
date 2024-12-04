<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar venta</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <main class="container mx-auto py-1 px-14 text-center">
        <!-- Botón de Regresar -->
        <div class="flex justify-start mt-4 ml-6">
            <button onclick="window.history.back()" class="flex items-center gap-2 text-gray-600 hover:text-gray-800">
                <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
                <span class="text-lg font-medium">Regresar</span>
            </button>
        </div>
    
        <!-- Contenido Principal -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-24"> <!-- Aquí se agregó mb-24 -->
            <h1 class="text-2xl font-bold text-gray-800 mb-8">Vender</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Imagen del producto -->
                <div class="border-2 border-blue-500 rounded-lg flex justify-center items-center h-full">
                    <label for="imageUpload" class="cursor-pointer flex flex-col items-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-10 h-10 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-sm font-bold text-blue-600">Cargar imagen</span>
                    </label>
                    <input id="imageUpload" type="file" accept="image/*" class="hidden" onchange="previewImage(event)">
                </div>
    
                <!-- Formulario del producto -->
                <div class="border-2 border-blue-500 rounded-lg p-6 h-full">
                    <form action="#" method="POST" class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="nombreProducto" class="block text-sm font-semibold text-gray-700">Nombre del Producto</label>
                            <input type="text" id="nombreProducto" name="nombreProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej. Cortina">
                        </div>
                        <div class="col-span-2">
                            <label for="descripcionProducto" class="block text-sm font-semibold text-gray-700">Descripción del Producto</label>
                            <input type="text" id="descripcionProducto" name="descripcionProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej. Tamaño 45×50cm">
                        </div>
                        <div>
                            <label for="precioProducto" class="block text-sm font-semibold text-gray-700">Precio</label>
                            <input type="text" id="precioProducto" name="precioProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="$300.00">
                        </div>
                        <div>
                            <label for="unidadesDisponibles" class="block text-sm font-semibold text-gray-700">Unidades Disponibles</label>
                            <input type="number" id="unidadesDisponibles" name="unidadesDisponibles"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="5">
                        </div>
                        <div class="col-span-2">
                            <label for="categoria" class="block text-sm font-semibold text-gray-700">Categoría</label>
                            <select id="categoria" name="categoria" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="Belleza">Belleza y Cuidado Personal</option>
                                <option value="Construcción">Construcción</option>
                                <option value="Electrodomésticos">Electrodomésticos</option>
                                <option value="Hogar y Muebles">Hogar y Muebles</option>
                                <option value="Moda">Moda</option>
                                <option value="Supermercado">Supermercado</option>
                                <option value="Tecnología">Tecnología</option>
                                <option value="Vehículos">Vehículos</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                                Publicar Producto
                            </button>
                        </div>
                    </form>
                </div>
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

        function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const imageContainer = document.querySelector('.border-2');
        imageContainer.style.backgroundImage = `url(${reader.result})`;
        imageContainer.style.backgroundSize = 'cover';
        imageContainer.style.backgroundPosition = 'center';
    };
    reader.readAsDataURL(event.target.files[0]);
}

    </script>
</body>

</html>
