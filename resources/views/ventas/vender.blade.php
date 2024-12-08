<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar venta</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="bg-white rounded-lg shadow-md p-6 mb-24">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">Vender</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Formulario del producto -->
                <div class="border-2 border-blue-500 rounded-lg p-6 h-full">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                        @csrf
                        <!-- Cargar Imagen -->
                        <div class="col-span-2">
                            <label for="imageUpload" class="block text-sm font-semibold text-gray-700">Cargar Imagen</label>
                            <input id="imageUpload" type="file" name="imageUpload" accept="image/*"
                                class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        
                        <!-- Nombre del Producto -->
                        <div class="col-span-2">
                            <label for="nombreProducto" class="block text-sm font-semibold text-gray-700">Nombre del Producto</label>
                            <input type="text" id="nombreProducto" name="nombreProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej. Cortina">
                        </div>
                        
                        <!-- Descripción -->
                        <div class="col-span-2">
                            <label for="descripcionProducto" class="block text-sm font-semibold text-gray-700">Descripción del Producto</label>
                            <input type="text" id="descripcionProducto" name="descripcionProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej. Tamaño 45×50cm">
                        </div>
                        
                        <!-- Precio -->
                        <div>
                            <label for="precioProducto" class="block text-sm font-semibold text-gray-700">Precio</label>
                            <input type="text" id="precioProducto" name="precioProducto"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="$300.00">
                        </div>
                        
                        <!-- Unidades Disponibles -->
                        <div>
                            <label for="unidadesDisponibles" class="block text-sm font-semibold text-gray-700">Unidades Disponibles</label>
                            <input type="number" id="unidadesDisponibles" name="unidadesDisponibles"
                                class="w-full p-2 border border-gray-300 rounded-lg" placeholder="5">
                        </div>
                        
                        <!-- Categoría -->
                        <div class="col-span-2">
                            <label for="categoria" class="block text-sm font-semibold text-gray-700">Categoría</label>
                            <select id="categoria" name="categoria" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="Belleza y Cuidado Personal">Belleza y Cuidado Personal</option>
                                <option value="Construcción">Construcción</option>
                                <option value="Electrodomésticos">Electrodomésticos</option>
                                <option value="Hogar y Muebles">Hogar y Muebles</option>
                                <option value="Moda">Moda</option>
                                <option value="Supermercado">Supermercado</option>
                                <option value="Tecnología">Tecnología</option>
                                <option value="Vehículos">Vehículos</option>
                            </select>
                        </div>
                        
                        <!-- Botón de Enviar -->
                        <div class="col-span-2">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                                Publicar Producto
                            </button>
                        </div>
                    </form>

                    <!-- SweetAlert de éxito -->
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Producto publicado!',
                                text: '{{ session("success") }}',
                                confirmButtonText: 'Aceptar',
                                timer: 3000
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
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
