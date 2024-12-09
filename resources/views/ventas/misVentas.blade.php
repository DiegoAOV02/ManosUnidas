<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis ventas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <main class="container mx-auto py-14 px-8 relative mb-32">
        <!-- Botón de Regresar -->
        <button onclick="window.history.back()"
            class="absolute top-0 ml-2 mt-4 flex items-center gap-2 text-gray-600 hover:text-gray-800">
            <img src="img/regresar.png" alt="Regresar" class="w-6 h-6 object-contain">
            <span class="text-lg font-medium">Regresar</span>
        </button>

        <!-- Sección de productos -->
        <section class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Mis ventas</h1>
            @if ($productos->isEmpty())
                <p class="text-gray-600">No tienes productos publicados.</p>
            @else
                <div class="space-y-4">
                    @foreach ($productos as $producto)
                        <div class="border border-blue-300 rounded-lg p-4 flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $producto->imagen_path) }}"
                                    alt="{{ $producto->nombre_producto }}" class="w-16 h-16 object-contain">
                                <div>
                                    <h2 class="text-lg font-bold text-blue-600">{{ $producto->nombre_producto }}</h2>
                                    <p class="text-sm text-gray-600">Precio: ${{ number_format($producto->precio, 2) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <button onclick="editProduct({{ $producto }})"
                                    class="bg-blue-600 text-white font-bold py-1 px-4 rounded-lg hover:bg-blue-700">
                                    Editar publicación
                                </button>
                                <button onclick="confirmDelete('{{ route('productos.destroy', $producto->id) }}')"
                                    class="border border-blue-600 text-blue-600 font-bold py-1 px-4 rounded-lg hover:bg-blue-100">
                                    Eliminar publicación
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <!-- Ventajas -->
    @include('components.ventajas')

    <script>
         function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        function confirmDelete(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(csrfField);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function editProduct(product) {
            Swal.fire({
                title: '<h2 class="text-lg font-bold text-gray-800 mb-4">Editar Publicación</h2>',
                html: `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Producto</label>
                    <input type="text" id="nombre_producto" class="w-full px-4 py-2 border rounded-lg" value="${product.nombre_producto}" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción del Producto</label>
                    <textarea id="descripcion_producto" class="w-full px-4 py-2 border rounded-lg" rows="3">${product.descripcion_producto || ''}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Precio</label>
                    <input type="number" id="precio" class="w-full px-4 py-2 border rounded-lg" value="${product.precio}" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Descuento (%)</label>
                    <input type="number" id="descuento" class="w-full px-4 py-2 border rounded-lg" value="${product.descuento || ''}" min="0" max="100">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Unidades Disponibles</label>
                    <input type="number" id="unidades_disponibles" class="w-full px-4 py-2 border rounded-lg" value="${product.unidades_disponibles}" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Categoría</label>
                    <select id="categoria" class="w-full px-4 py-2 border rounded-lg">
                        <option value="Belleza y Cuidado Personal" ${product.categoria === 'Belleza y Cuidado Personal' ? 'selected' : ''}>Belleza y Cuidado Personal</option>
                        <option value="Construcción" ${product.categoria === 'Construcción' ? 'selected' : ''}>Construcción</option>
                        <option value="Electrodomésticos" ${product.categoria === 'Electrodomésticos' ? 'selected' : ''}>Electrodomésticos</option>
                        <option value="Hogar y Muebles" ${product.categoria === 'Hogar y Muebles' ? 'selected' : ''}>Hogar y Muebles</option>
                        <option value="Moda" ${product.categoria === 'Moda' ? 'selected' : ''}>Moda</option>
                        <option value="Supermercado" ${product.categoria === 'Supermercado' ? 'selected' : ''}>Supermercado</option>
                        <option value="Tecnología" ${product.categoria === 'Tecnología' ? 'selected' : ''}>Tecnología</option>
                        <option value="Vehículos" ${product.categoria === 'Vehículos' ? 'selected' : ''}>Vehículos</option>
                    </select>
                </div>
            </div>
        `,
                width: '800px',
                showCancelButton: true,
                confirmButtonText: 'Guardar Cambios',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    return {
                        nombre_producto: document.getElementById('nombre_producto').value,
                        descripcion_producto: document.getElementById('descripcion_producto').value,
                        precio: document.getElementById('precio').value,
                        descuento: document.getElementById('descuento').value,
                        unidades_disponibles: document.getElementById('unidades_disponibles').value,
                        categoria: document.getElementById('categoria').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/productos/${product.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(result.value)
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire('¡Éxito!', data.message, 'success').then(() => location.reload());
                            } else {
                                Swal.fire('Error', data.error || 'No se pudo actualizar el producto.', 'error');
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                            Swal.fire('Error', 'No se pudo actualizar el producto.', 'error');
                        });
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar',
                timer: 3000
            });
        </script>
    @endif
</body>

</html>
