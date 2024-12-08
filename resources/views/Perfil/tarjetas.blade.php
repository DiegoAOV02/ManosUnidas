<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tarjetas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/tarjetas.js') }}"></script>
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

            @if (isset($tarjetas) && $tarjetas->isNotEmpty())
                @foreach ($tarjetas as $tarjeta)
                    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 flex flex-col justify-between">
                        <div class="flex items-center gap-4">
                            <img src="img/tarjeta2.png" alt="Icono de tarjeta" class="w-12 h-12 object-contain">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">
                                    @if (str_starts_with($tarjeta->numero_tarjeta, '4'))
                                        Visa
                                    @elseif(str_starts_with($tarjeta->numero_tarjeta, '5'))
                                        MasterCard
                                    @else
                                        Tarjeta
                                    @endif
                                </h3>
                                <p class="text-gray-600">Tarjeta terminación {{ substr($tarjeta->numero_tarjeta, -4) }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4 mt-6">
                            <button
                                onclick="editarTarjeta('{{ $tarjeta->id }}', '{{ $tarjeta->nombre_titular }}', '{{ $tarjeta->numero_tarjeta }}', '{{ $tarjeta->fecha_expiracion }}')"
                                class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 w-full">
                                Editar Tarjeta
                            </button>
                            <button onclick="eliminarTarjeta('{{ $tarjeta->id }}')"
                                class="border border-red-600 text-red-600 font-bold py-2 px-6 rounded-lg hover:bg-red-100 w-full">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-1 bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <p class="text-gray-600">No hay tarjetas registradas</p>
                </div>
            @endif
        </div>

        <!-- Ventajas -->
        <section
            class="bg-gradient-to-r from-[#003152] to-[#0166A5] text-white fixed bottom-0 left-0 right-0 p-6 flex justify-around items-center text-center z-10">
            <div class="flex flex-col items-center">
                <img src="img/tarjeta.png" alt="Elige cómo pagar" class="w-12 h-12 mb-2">
                <p class="font-bold">Elige cómo pagar</p>
                <p class="text-sm text-center">Puedes pagar con tarjeta, débito, efectivo o con Meses sin Tarjeta.
                </p>
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
                    <label for="nombre_titular" class="block text-sm font-semibold text-gray-700">Nombre del Titular</label>
                    <input type="text" id="nombre_titular" class="swal2-input w-62" placeholder="Ej. Juan Pérez" required>
                </div>
                <div class="col-span-2">
                    <label for="numero_tarjeta" class="block text-sm font-semibold text-gray-700">Número de Tarjeta</label>
                    <input type="text" id="numero_tarjeta" class="swal2-input w-62" placeholder="Ej. 1234 5678 9012 3456" maxlength="16" required>
                </div>
                <div>
                    <label for="fecha_expiracion" class="block text-sm font-semibold text-gray-700">Fecha de Expiración</label>
                    <input type="text" id="fecha_expiracion" class="swal2-input w-32" placeholder="Ej. 12/25" maxlength="5" required>
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
                        nombre_titular: document.getElementById('nombre_titular').value,
                        numero_tarjeta: document.getElementById('numero_tarjeta').value,
                        fecha_expiracion: document.getElementById('fecha_expiracion').value,
                        ccv: document.getElementById('ccv').value,
                    };
                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }
                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/Perfil/tarjetas', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify(result.value),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Éxito!', data.success, 'success').then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'No se pudo registrar la tarjeta', 'error');
                        });
                }
            });
        }

        function editarTarjeta(id, nombreTitular, numeroTarjeta, fechaExpiracion) {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Editar Tarjeta</h2>',
                html: `
        <form id="tarjetaForm" class="grid grid-cols-2 gap-4 text-left w-full">
            <div class="col-span-2">
                <label for="nombre_titular" class="block text-sm font-semibold text-gray-700">Nombre del Titular</label>
                <input type="text" id="nombre_titular" class="swal2-input w-62" placeholder="Ej. Juan Pérez" required value="${nombreTitular}">
            </div>
            <div class="col-span-2">
                <label for="numero_tarjeta" class="block text-sm font-semibold text-gray-700">Número de Tarjeta</label>
                <input type="text" id="numero_tarjeta" class="swal2-input w-62" placeholder="Ej. 1234 5678 9012 3456" maxlength="16" required value="${numeroTarjeta}">
            </div>
            <div>
                <label for="fecha_expiracion" class="block text-sm font-semibold text-gray-700">Fecha de Expiración</label>
                <input type="text" id="fecha_expiracion" class="swal2-input w-32" placeholder="Ej. 12/25" maxlength="5" required value="${fechaExpiracion}">
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
                        nombre_titular: document.getElementById('nombre_titular').value,
                        numero_tarjeta: document.getElementById('numero_tarjeta').value,
                        fecha_expiracion: document.getElementById('fecha_expiracion').value,
                        ccv: document.getElementById('ccv').value,
                    };
                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }
                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/Perfil/tarjetas/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify(result.value)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Éxito!', data.success, 'success').then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'No se pudo actualizar la tarjeta', 'error');
                        });
                }
            });
        }

        function eliminarTarjeta(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/Perfil/tarjetas/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    '¡Eliminada!',
                                    'La tarjeta ha sido eliminada.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'No se pudo eliminar la tarjeta', 'error');
                        });
                }
            });
        }
    </script>

</body>

</html>
