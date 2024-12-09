<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\DireccionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoSeleccionadoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Ruta para visualizar un producto específico por ID
Route::get('/publicacion/{id}', [ProductoSeleccionadoController::class, 'show'])->name('publicacion');

// Ruta genérica para acceder a una página sin un ID (por ejemplo, un error o página en blanco)
Route::get('/publicacion', function () {
    return view('Publicaciones.publicacion'); // Ruta genérica
})->middleware(['auth', 'verified'])->name('publicacion.general');


Route::get('/pago', function () {
    return view('Publicaciones/pago');
})->middleware(['auth', 'verified'])->name('pago');

Route::get('/pedidoRealizado', function () {
    return view('Publicaciones/pedidoRealizado');
})->middleware(['auth', 'verified'])->name('pedidoRealizado');

Route::get('/carrito', function () {
    return view('Publicaciones/carrito');
})->middleware(['auth', 'verified'])->name('carrito');

Route::get('/compras', function () {
    return view('Publicaciones/compras');
})->middleware(['auth', 'verified'])->name('compras');

Route::get('/categorias', function () {
    return view('Publicaciones/categorias');
})->middleware(['auth', 'verified'])->name('categorias');

Route::get('/perfil', function () {
    return view('Perfil/perfil');
})->middleware(['auth', 'verified'])->name('perfil');

Route::get('/direcciones', function () {
    return view('Perfil/direcciones');
})->middleware(['auth', 'verified'])->name('direcciones');

Route::get('/tarjetas', function () {
    return view('Perfil/tarjetas');
})->middleware(['auth', 'verified'])->name('tarjetas');

Route::get('/cuenta', function () {
    return view('Perfil/cuenta');
})->middleware(['auth', 'verified'])->name('cuenta');

Route::get('/vender', function () {
    return view('ventas/vender');
})->middleware(['auth', 'verified'])->name('vender');

Route::post('/vender', [ProductoController::class, 'store'])->middleware(['auth', 'verified'])->name('productos.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/misVentas', [ProductoController::class, 'misVentas'])->name('productos.misVentas');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/producto/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
});

Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias');
Route::get('/buscar', [BusquedaController::class, 'index'])->name('buscar');

Route::middleware(['auth'])->group(function () {
    Route::get('/tarjetas', [TarjetaController::class, 'index'])->name('tarjetas.index');
    Route::post('Perfil/tarjetas', [TarjetaController::class, 'store'])->name('tarjetas.store');
    Route::put('Perfil/tarjetas/{tarjeta}', [TarjetaController::class, 'update'])->name('tarjetas.update');
    Route::delete('Perfil/tarjetas/{tarjeta}', [TarjetaController::class, 'destroy'])->name('tarjetas.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/direcciones', [DireccionController::class, 'index'])->name('direcciones.index');
    Route::post('/direcciones', [DireccionController::class, 'store'])->name('direcciones.store');
    Route::put('/direcciones/{direccion}', [DireccionController::class, 'update'])->name('direcciones.update');
    Route::delete('/direcciones/{direccion}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cuenta', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('profile.perfil');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});


Route::middleware(['auth'])->group(function () {
    // Mostrar carrito
    Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito');

    // Agregar producto al carrito
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');

    // Eliminar producto del carrito
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');

    // Proceder al pago (opcional)
    Route::get('/carrito/pago', function () {
        return view('Publicaciones.pago');
    })->name('carrito.pago');
});


require __DIR__ . '/auth.php';
