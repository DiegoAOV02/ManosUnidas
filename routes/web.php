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

Route::get('/direcciones', function () {
    return view('Perfil/direcciones');
})->middleware(['auth', 'verified'])->name('direcciones');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
