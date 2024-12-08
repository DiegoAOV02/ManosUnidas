<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Direcciones</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8 text-center">
        <button onclick="window.history.back()"
            class="absolute top-28 ml-2 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <h1 class="text-2xl font-bold text-gray-800 mb-8">Mis direcciones</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Botón para agregar dirección -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 flex flex-col items-center justify-center">
                <button onclick="agregarDireccion()"
                    class="flex flex-col items-center gap-4 text-blue-600 hover:text-blue-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-lg font-bold">Agregar dirección</span>
                </button>
            </div>

            @if($direcciones->isNotEmpty())
                @foreach($direcciones as $direccion)
                    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h3>
                        <p class="text-gray-600 mb-2">{{ $direccion->calle }} {{ $direccion->numero }}, {{ $direccion->colonia }}</p>
                        <p class="text-gray-600 mb-2">{{ $direccion->ciudad }}, {{ $direccion->estado }}, {{ $direccion->codigo_postal }}, {{ $direccion->pais }}</p>
                        <div class="flex gap-4">
                            <button onclick="editarDireccion('{{ $direccion->id }}', '{{ $direccion->calle }}', '{{ $direccion->numero }}', '{{ $direccion->codigo_postal }}', '{{ $direccion->colonia }}', '{{ $direccion->ciudad }}', '{{ $direccion->estado }}', '{{ $direccion->pais }}')"
                                class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 w-1/2">
                                Editar
                            </button>
                            <button onclick="eliminarDireccion('{{ $direccion->id }}')"
                                class="border border-red-600 text-red-600 font-bold py-2 px-4 rounded-lg hover:bg-red-100 w-1/2">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <p class="text-gray-600">No hay direcciones registradas</p>
                </div>
            @endif
        </div>

        @include('components.ventajas')
    </main>

    <script>
        function agregarDireccion() {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Agregar dirección</h2>',
                html: `
                    <form id="direccionForm" class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <label for="calle" class="block text-sm font-semibold text-gray-700">Calle</label>
                            <input type="text" id="calle" class="swal2-input" placeholder="Ej. Av. Principal" required>
                        </div>
                        <div>
                            <label for="numero" class="block text-sm font-semibold text-gray-700">Número</label>
                            <input type="text" id="numero" class="swal2-input" placeholder="Ej. 123" required>
                        </div>
                        <div>
                            <label for="codigo_postal" class="block text-sm font-semibold text-gray-700">Código Postal</label>
                            <input type="text" id="codigo_postal" class="swal2-input" placeholder="Ej. 87000" required>
                        </div>
                        <div>
                            <label for="colonia" class="block text-sm font-semibold text-gray-700">Colonia/Fracc.</label>
                            <input type="text" id="colonia" class="swal2-input" placeholder="Ej. Lomas" required>
                        </div>
                        <div>
                            <label for="ciudad" class="block text-sm font-semibold text-gray-700">Ciudad</label>
                            <input type="text" id="ciudad" class="swal2-input" placeholder="Ej. Ciudad Victoria" required>
                        </div>
                        <div>
                            <label for="estado" class="block text-sm font-semibold text-gray-700">Estado</label>
                            <input type="text" id="estado" class="swal2-input" placeholder="Ej. Tamaulipas" required>
                        </div>
                        <div class="col-span-2">
                            <label for="pais" class="block text-sm font-semibold text-gray-700">País</label>
                            <input type="text" id="pais" class="swal2-input" placeholder="Ej. México" required>
                        </div>
                    </form>
                `,
                confirmButtonText: 'Guardar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'w-full max-w-4xl rounded-lg p-6',
                    confirmButton: 'bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700',
                    cancelButton: 'border border-gray-300 text-gray-600 font-bold py-2 px-4 rounded-lg hover:bg-gray-100',
                },
                preConfirm: () => {
                    const datos = {
                        calle: document.getElementById('calle').value,
                        numero: document.getElementById('numero').value,
                        codigo_postal: document.getElementById('codigo_postal').value,
                        colonia: document.getElementById('colonia').value,
                        ciudad: document.getElementById('ciudad').value,
                        estado: document.getElementById('estado').value,
                        pais: document.getElementById('pais').value,
                    };
                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }
                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/direcciones', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(result.value)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', data.success, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'No se pudo guardar la dirección', 'error');
                    });
                }
            });
        }

        function editarDireccion(id, calle, numero, codigo_postal, colonia, ciudad, estado, pais) {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Editar dirección</h2>',
                html: `
                    <form id="direccionForm" class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <label for="calle" class="block text-sm font-semibold text-gray-700">Calle</label>
                            <input type="text" id="calle" class="swal2-input" value="${calle}" required>
                        </div>
                        <div>
                            <label for="numero" class="block text-sm font-semibold text-gray-700">Número</label>
                            <input type="text" id="numero" class="swal2-input" value="${numero}" required>
                        </div>
                        <div>
                            <label for="codigo_postal" class="block text-sm font-semibold text-gray-700">Código Postal</label>
                            <input type="text" id="codigo_postal" class="swal2-input" value="${codigo_postal}" required>
                        </div>
                        <div>
                            <label for="colonia" class="block text-sm font-semibold text-gray-700">Colonia/Fracc.</label>
                            <input type="text" id="colonia" class="swal2-input" value="${colonia}" required>
                        </div>
                        <div>
                            <label for="ciudad" class="block text-sm font-semibold text-gray-700">Ciudad</label>
                            <input type="text" id="ciudad" class="swal2-input" value="${ciudad}" required>
                        </div>
                        <div>
                            <label for="estado" class="block text-sm font-semibold text-gray-700">Estado</label>
                            <input type="text" id="estado" class="swal2-input" value="${estado}" required>
                        </div>
                        <div class="col-span-2">
                            <label for="pais" class="block text-sm font-semibold text-gray-700">País</label>
                            <input type="text" id="pais" class="swal2-input" value="${pais}" required>
                        </div>
                    </form>
                `,
                confirmButtonText: 'Guardar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'w-full max-w-4xl rounded-lg p-6',
                    confirmButton: 'bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700',
                    cancelButton: 'border border-gray-300 text-gray-600 font-bold py-2 px-4 rounded-lg hover:bg-gray-100',
                },
                preConfirm: () => {
                    const datos = {
                        calle: document.getElementById('calle').value,
                        numero: document.getElementById('numero').value,
                        codigo_postal: document.getElementById('codigo_postal').value,
                        colonia: document.getElementById('colonia').value,
                        ciudad: document.getElementById('ciudad').value,
                        estado: document.getElementById('estado').value,
                        pais: document.getElementById('pais').value,
                    };
                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }
                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/direcciones/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(result.value)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', data.success, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'No se pudo actualizar la dirección', 'error');
                    });
                }
            });
        }

        function eliminarDireccion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/direcciones/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Eliminada!', data.success, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'No se pudo eliminar la dirección', 'error');
                    });
                }
            });
        }
    </script>
</body>
</html>