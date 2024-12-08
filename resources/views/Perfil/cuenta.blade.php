<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mi Cuenta</title>
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

        <h1 class="text-2xl font-bold text-gray-800 mb-8">Mi cuenta</h1>
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
            <div class="grid grid-cols-2 gap-6">
                <!-- Columna izquierda -->
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Nombre</p>
                        <p class="text-gray-600">{{ $user->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Apellido</p>
                        <p class="text-gray-600">{{ $user->apellido }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Correo electrónico</p>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Usuario</p>
                        <p class="text-gray-600">{{ $user->usuario ?? 'No especificado' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Contraseña</p>
                        <p class="text-gray-600">****************</p>
                    </div>
                </div>
            </div>

            <!-- Botón de actualizar -->
            <div class="flex justify-center mt-6">
                <button onclick="actualizarInformacion()"
                    class="border border-blue-600 text-blue-600 font-bold py-2 px-6 rounded-lg hover:bg-blue-100">
                    Actualizar información personal
                </button>
            </div>
        </div>

        @include('components.ventajas')
    </main>

    <script>
         function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        function actualizarInformacion() {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800">Actualizar Información Personal</h2>',
                html: `
                <form id="updateForm" class="grid grid-cols-2 gap-4 text-left w-full">
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
                        <input type="text" id="nombre" class="swal2-input w-50" value="{{ $user->nombre }}" required>
                    </div>
                    <div>
                        <label for="apellido" class="block text-sm font-semibold text-gray-700">Apellido</label>
                        <input type="text" id="apellido" class="swal2-input w-50" value="{{ $user->apellido }}" required>
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Correo electrónico</label>
                        <input type="email" id="email" class="swal2-input w-80" value="{{ $user->email }}" required>
                    </div>
                    <div>
                        <label for="usuario" class="block text-sm font-semibold text-gray-700">Usuario</label>
                        <input type="text" id="usuario" class="swal2-input w-50" value="{{ $user->usuario}}" placeholder="Usuario" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700">Nueva Contraseña</label>
                        <input type="password" id="password" class="swal2-input w-50" placeholder="Nueva contraseña" required>
                    </div>
                    <div class="col-span-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" class="swal2-input w-80" placeholder="Confirmar contraseña" required>
                    </div>
                </form>
                `,
                confirmButtonText: 'Guardar Cambios',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'w-full max-w-3xl rounded-lg p-6',
                    confirmButton: 'bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700',
                    cancelButton: 'border border-gray-300 text-gray-600 font-bold py-2 px-4 rounded-lg hover:bg-gray-100',
                },
                preConfirm: () => {
                    const datos = {
                        nombre: document.getElementById('nombre').value,
                        apellido: document.getElementById('apellido').value,
                        email: document.getElementById('email').value,
                        usuario: document.getElementById('usuario').value,
                        password: document.getElementById('password').value,
                        password_confirmation: document.getElementById('password_confirmation').value,
                    };

                    if (Object.values(datos).some((val) => val.trim() === '')) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }
                    
                    if (datos.password !== datos.password_confirmation) {
                        Swal.showValidationMessage('Las contraseñas no coinciden');
                        return false;
                    }

                    return datos;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/profile', {
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
                        Swal.fire('Error', 'No se pudo actualizar la información', 'error');
                    });
                }
            });
        }
    </script>
</body>
</html>