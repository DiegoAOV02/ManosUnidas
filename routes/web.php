<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/publicacion', function () {
    return view('Publicaciones/publicacion');
})->middleware(['auth', 'verified'])->name('publicacion');

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

Route::get('/misVentas', function () {
    return view('ventas/misVentas');
})->middleware(['auth', 'verified'])->name('misVentas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
