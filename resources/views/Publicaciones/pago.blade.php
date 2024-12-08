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
                <p class="text-gray-600 mb-2">Diego A. Ortiz</p>
                <p class="text-gray-600">C Lomas del Pedregal 380 Fracc Lomas de Calamaco, Ciudad Victoria, Tamaulipas
                    87018</p>
                <button  onclick="window.location.href='{{ route('direcciones') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4 hover:bg-blue-700 w-full">Modificar</button>
            </div>

            <!-- Método de Pago -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">2. Método de pago</h3>
                <p class="text-gray-600 mb-4">Pagar con Visa 3217</p>
                <button onclick="window.location.href='{{ route('tarjetas') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-full mb-2">Agregar
                    otra tarjeta</button>
                <button onclick="editarTarjeta()"
                    class="border border-blue-600 text-blue-600 font-bold py-2 px-4 rounded-lg hover:bg-blue-100 w-full">Modificar</button>
            </div>

            <!-- Revisar Artículos y Envío -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">3. Revisar artículos y envío</h3>
                <div class="flex items-center gap-4 mb-4">
                    <img src="img/arbol.jpg" alt="Producto" class="w-16 h-16 object-contain rounded-lg">
                    <div>
                        <p class="text-gray-800 font-bold">Árbol de Navidad Artificial Pino 1.8m OHS7GY</p>
                        <p class="text-gray-600">$1,450.00</p>
                        <p class="text-gray-600 text-sm">Cantidad: 1 artículo</p>
                    </div>
                </div>
                <p class="text-green-500 font-bold mb-4">Llega el 30 de noviembre</p>
                <!-- Botón Realizar Pedido y Pagar -->
                <button onclick="window.location.href='{{ route('pedidoRealizado') }}'"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-full mb-2">
                    Realizar pedido y pagar
                </button>

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

        function editarTarjeta() {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Editar Tarjeta</h2>',
                html: `
             <form id="tarjetaForm" class="grid grid-cols-2 gap-4 text-left w-full">
            <div class="col-span-2">
                <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre del Titular</label>
                <input type="text" id="nombre" class="swal2-input w-62" placeholder="Ej. Juan Pérez" required>
            </div>
            <div class="col-span-2">
                <label for="numeroTarjeta" class="block text-sm font-semibold text-gray-700">Número de Tarjeta</label>
                <input type="text" id="numeroTarjeta" class="swal2-input w-62" placeholder="Ej. 1234 5678 9012 3456" maxlength="16" required>
            </div>
            <div>
                <label for="fechaExp" class="block text-sm font-semibold text-gray-700">Fecha de Expiración</label>
                <input type="text" id="fechaExp" class="swal2-input w-32" placeholder="Ej. 12/25" maxlength="5" required>
            </div>
            <div>
                <label for="ccv" class="block text-sm font-semibold text-gray-700">CCV</label>
                <input type="text" id="ccv" class="swal2-input w-24" placeholder="Ej. 123" maxlength="3" required>
            </div>
        </form>
        `,
                confirmButtonText: 'Guardar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'w-full max-w-xl rounded-lg p-6',
                    confirmButton: 'bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700',
                    cancelButton: 'border border-gray-300 text-gray-600 font-bold py-2 px-4 rounded-lg hover:bg-gray-100',
                },
                preConfirm: () => {
                    const datos = {
                        nombre: document.getElementById('nombre').value,
                        numeroTarjeta: document.getElementById('numeroTarjeta').value,
                        fechaExp: document.getElementById('fechaExp').value,
                        ccv: document.getElementById('ccv').value,
                    };
                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                    }
                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Tarjeta actualizada:', result.value);
                    Swal.fire('¡Tarjeta actualizada!', '', 'success');
                }
            });
        }
    </script>
</body>

</html>
