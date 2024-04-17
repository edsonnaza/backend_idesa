<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\debtController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\categoriaController;
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // Obtiene el usuario autenticado
    $user = $request->user();

    // Devuelve una instancia de UserResource con la información del usuario
    return new UserResource($user);
   // return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
    // Rutas protegidas que requieren autenticación

    // Rutas para Proveedores
    Route::get('/proveedores', [proveedorController::class, 'index']);

    Route::get('/proveedores/{id}', [proveedorController::class, 'show']);

    Route::post('/proveedores', [proveedorController::class, 'store']);

    Route::put('/proveedores/{id}', [proveedorController::class, 'update']);

    Route::patch('/proveedores/{id}', [proveedorController::class, 'updatePartial']);

    Route::delete('/proveedores/{id}', [proveedorController::class, 'destroy']);


    // Rutas para Categorias
    Route::get('/categorias', [categoriaController::class, 'index']);

    Route::get('/categorias/{id}', [categoriaController::class, 'show']);

    Route::post('/categorias', [categoriaController::class, 'store']);

    Route::put('/categorias/{id}', [categoriaController::class, 'update']);

    Route::patch('/categorias/{id}', [categoriaController::class, 'updatePartial']);

    Route::delete('/categorias/{id}', [categoriaController::class, 'destroy']);

    // Rutas para Productos
    Route::get('/productos', [ProductoController::class, 'index']);

    Route::get('/productos/{id}', [ProductoController::class, 'show']);

    Route::post('/productos', [ProductoController::class, 'store']);

    Route::put('/productos/{id}', [ProductoController::class, 'update']);

    Route::patch('/productos/{id}', [ProductoController::class, 'updatePartial']);

    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

    
    // Rutas para Debts
    Route::get('/debts', [debtController::class, 'index']);

    Route::get('/debts/{id}', [debtController::class, 'show']);

    Route::post('/debts', [debtController::class, 'store']);

    Route::put('/debts/{id}', [debtController::class, 'update']);

    Route::patch('/debts/{id}', [debtController::class, 'updatePartial']);

    Route::delete('/debts/{id}', [debtController::class, 'destroy']);
});