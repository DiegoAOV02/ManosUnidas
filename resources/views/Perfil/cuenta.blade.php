<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8 text-center">
        <!-- Botón de Regresar -->
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
                        <p class="text-gray-600">Diego A.</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Apellido</p>
                        <p class="text-gray-600">Ortiz</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Correo electrónico</p>
                        <p class="text-gray-600">2030282@upv.edu.mx</p>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Teléfono</p>
                        <p class="text-gray-600">8127178165</p>
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

        <!-- Ventajas -->
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
                <input type="text" id="nombre" class="swal2-input w-50" placeholder="Ej. Diego A." required>
            </div>
            <div>
                <label for="apellido" class="block text-sm font-semibold text-gray-700">Apellido</label>
                <input type="text" id="apellido" class="swal2-input w-50" placeholder="Ej. Ortiz" required>
            </div>
            <div class="col-span-2">
                <label for="correo" class="block text-sm font-semibold text-gray-700">Correo electrónico</label>
                <input type="email" id="correo" class="swal2-input w-80" placeholder="Ej. correo@dominio.com" required>
            </div>
            <div>
                <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono</label>
                <input type="text" id="telefono" class="swal2-input w-50" placeholder="Ej. 8127178165" required>
            </div>
            <div>
                <label for="contrasena" class="block text-sm font-semibold text-gray-700">Contraseña</label>
                <input type="password" id="contrasena" class="swal2-input w-50" placeholder="Nueva contraseña" required>
            </div>
            <div class="col-span-2">
                <label for="confirmarContrasena" class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                <input type="password" id="confirmarContrasena" class="swal2-input w-80" placeholder="Confirmar contraseña" required>
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
                correo: document.getElementById('correo').value,
                telefono: document.getElementById('telefono').value,
                contrasena: document.getElementById('contrasena').value,
                confirmarContrasena: document.getElementById('confirmarContrasena').value,
            };
            if (Object.values(datos).some((val) => val.trim() === '')) {
                Swal.showValidationMessage('Todos los campos son obligatorios');
            } else if (datos.contrasena !== datos.confirmarContrasena) {
                Swal.showValidationMessage('Las contraseñas no coinciden');
            }
            return datos;
        },
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('Información actualizada:', result.value);
            Swal.fire('¡Información actualizada!', '', 'success');
        }
    });
}

    </script>

</body>

</html>
