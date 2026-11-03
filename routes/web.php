<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\VentaController;

// Tienda Principal
Route::get('/', [TiendaController::class, 'index'])->name('tienda.index');

// Clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// Videojuegos
Route::get('/inventario', [VideojuegoController::class, 'index'])->name('videojuegos.index');
Route::post('/inventario', [VideojuegoController::class, 'store'])->name('videojuegos.store');
Route::delete('/inventario/{id}', [VideojuegoController::class, 'destroy'])->name('videojuegos.destroy');

// Ventas & Cancelaciones
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::post('/ventas/{id}/cancelar', [VentaController::class, 'cancelar'])->name('ventas.cancelar');