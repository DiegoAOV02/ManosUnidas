<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8">
        <!-- Proceder al pago -->
        <h2 class="text-2xl font-bold text-gray-800 mb-8">
            Proceder al pago <span class="text-blue-600">(1 artículo)</span>
        </h2>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Dirección de Envío -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">1. Dirección de envío</h3>
                @if ($direccion)
                    <p class="text-gray-600 mb-2">{{ $direccion->user->nombre}} {{ $direccion->user->apellido}}</p>
                    <p class="text-gray-600">{{ $direccion->calle }}, {{ $direccion->colonia }}, {{ $direccion->numero }}</p>
                @else
                    <p class="text-gray-600">No tienes una dirección registrada.</p>
                @endif
                <button  onclick="window.location.href='{{ route('direcciones.index') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4 hover:bg-blue-700 w-full">Modificar</button>
            </div>

            <!-- Método de Pago -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">2. Método de pago</h3>
                @if ($tarjeta)
                    <p class="text-gray-600 mb-4">Visa con terminación {{ substr($tarjeta->numero_tarjeta, -4) }}</p>
                @else
                    <p class="text-gray-600">No tienes un método de pago registrado.</p>
                @endif
                <button  onclick="window.location.href='{{ route('tarjetas.index') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4 hover:bg-blue-700 w-full">Modificar</button>
            </div>

            <!-- Revisar Artículos y Envío -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">3. Revisar artículos y envío</h3>

                @if ($carrito->isNotEmpty())
                    @foreach ($carrito as $item)
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('storage/' . $item->producto->imagen_path) }}" alt="{{ $item->producto->nombre }}" class="w-16 h-16 object-contain rounded-lg">
                            <div>
                                <p class="text-gray-800 font-bold">{{ $item->producto->nombre }}</p>
                                <p class="text-gray-600">Precio: ${{ number_format($item->producto->precio, 2) }}</p>
                                <p class="text-gray-600 text-sm">Cantidad: {{ $item->cantidad }}</p>
                            </div>
                        </div>
                    @endforeach

                    <p class="text-green-500 font-bold mb-4">
                        Subtotal: ${{ number_format($carrito->sum(fn($item) => $item->producto->precio * $item->cantidad), 2) }}
                    </p>
                @else
                    <p class="text-gray-600">Tu carrito está vacío.</p>
                @endif
                <!-- Botón Realizar Pedido y Pagar -->
                <form action="{{ route('realizarCompra') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-full mb-2">
                        Realizar pedido y pagar
                    </button>
                </form>

                <!-- Botón Cancelar Compra -->
                <button onclick="window.history.back()"
                    class="border border-blue-600 text-blue-600 font-bold py-2 px-4 rounded-lg hover:bg-blue-100 w-full">
                    Cancelar compra
                </button>
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

    <script>
    @if (session('success'))
        Swal.fire({
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar',
            customClass: {
                confirmButton: 'bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700'
            }
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: 'Error',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
                confirmButton: 'bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700'
            }
        });
    @endif
</script>
</body>

</html>
