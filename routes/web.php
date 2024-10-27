<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');

Route::post('/store', [EmpleadosController::class, 'store'])->name('myStore');

Route::get('/empleado/show/{id}', [EmpleadosController::class, 'show'])->name('myShow');

Route::delete('/empleado/delete/{id}', [EmpleadosController::class, 'destroy'])->name('myDestroy');

Route::get('/empleado/edit/{id}', [EmpleadosController::class, 'edit'])->name('myEdit');

Route::put('/empleado/update/{id}', [EmpleadosController::class, 'update'])->name('myUpdate');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes.store', [ClienteController::class, 'store'])->name('clientes.add');
Route::delete('/cliente/delete/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias.store', [CategoriaController::class, 'store'])->name('categorias.add');
Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categoria/edit/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categoria/update/{id}', [CategoriaController::class, 'update'])->name('categorias.update');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos.store', [ProductoController::class, 'store'])->name('productos.add');
Route::delete('/producto/delete/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::get('/producto/edit/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/producto/update/{id}', [ProductoController::class, 'update'])->name('productos.update');
