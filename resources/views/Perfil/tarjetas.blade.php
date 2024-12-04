<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjetas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8 text-center">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-28 ml-2 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <h1 class="text-2xl font-bold text-gray-800 mb-8">Mis Tarjetas</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Botón para agregar tarjeta -->
            <div
                class="bg-white border border-gray-300 rounded-lg shadow-md p-6 flex flex-col items-center justify-center">
                <button onclick="agregarTarjeta()"
                    class="flex flex-col items-center gap-4 text-blue-600 hover:text-blue-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-lg font-bold">Agregar Tarjeta</span>
                </button>
            </div>

            <!-- Tarjeta existente -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div class="flex items-center gap-4">
                    <img src="img/tarjeta2.png" alt="Icono de tarjeta" class="w-12 h-12 object-contain">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Visa</h3>
                        <p class="text-gray-600">Tarjeta de débito con terminación 3217</p>
                    </div>
                </div>
                <div class="flex gap-4 mt-6">
                    <!-- Botón de Editar -->
                    <button onclick="editarTarjeta()"
                        class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 w-full">
                        Editar Tarjeta
                    </button>
                    <button
                        class="border border-red-600 text-red-600 font-bold py-2 px-6 rounded-lg hover:bg-red-100 w-full">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

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

        function agregarTarjeta() {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Agregar Tarjeta</h2>',
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
                    popup: 'w-full max-w-lg rounded-lg p-6',
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
                    console.log('Tarjeta agregada:', result.value);
                    Swal.fire('¡Tarjeta agregada!', '', 'success');
                }
            });
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
