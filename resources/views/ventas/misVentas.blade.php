<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis ventas</title>
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
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Mis ventas</h1>
            <div class="space-y-4">
                <!-- Iterar productos de acuerdo al id del usuario -->
                 @forelse ($productos as $producto)
                 <div class="border border-blue-300 rounded-lg p-4 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $producto->imagen_path) }}" alt="{{ $producto->nombre_producto }}" class="w-16 h-16 object-contain">
                        <div>
                            <h2 class="text-lg font-bold text-blue-600">{{ $producto->nombre_producto }}</h2>
                            <p class="text-sm text-gray-600">Precio: ${{ number_format($producto->precio, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button onclick="window.location.href='{{ route('vender') }}'" class="bg-blue-600 text-white font-bold py-1 px-4 rounded-lg hover:bg-blue-700">Editar publicación</button>
                        <button 
                            onclick="confirmDelete('{{ route('productos.destroy', $producto->id) }}')" 
                            class="border border-blue-600 text-blue-600 font-bold py-1 px-4 rounded-lg hover:bg-blue-100">
                            Eliminar publicación
                        </button>
                        <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label for="nuevo_precio" class="block text-sm font-semibold text-gray-700">Nuevo Precio</label>
                                <input type="number" id="nuevo_precio" name="nuevo_precio" step="0.01"
                                    class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $producto->precio }}">
                            </div>

                            <button type="submit"
                                class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                                Actualizar Precio
                            </button>
                        </form>
                    </div>
                </div>
                 @empty
                    <p class="text-center text-gray-600">Aún no tienes ventas publicadas.</p>
                 @endforelse
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear un formulario y enviarlo para ejecutar el DELETE
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                const csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = '{{ csrf_token() }}';
                form.appendChild(csrfField);

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

</body>

</html>