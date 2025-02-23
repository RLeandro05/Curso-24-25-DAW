<?php

use App\Http\Controllers\TenistasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Ruta para mostrar tenistas
Route::get("indexTenistas", [TenistasController::class, "index"])->name("index.indexTenistas");

//Ruta para mostrar el formulario de añadir
Route::get("indexTenistas/create", [TenistasController::class, "create"])->name("create.createTenistas");

//Ruta para añadir un tenista
Route::post("indexTenistas", [TenistasController::class, "store"])->name("store.storeTenistas");

//Ruta para mostrar el formulario de editar
Route::get("indexTenistas/{tenista}/edit", [TenistasController::class, "edit"])->name("edit.editTenistas");

//Ruta para editar un tenista
Route::put("indexTenistas/{tenista}", [TenistasController::class, "update"])->name("update.updateTenistas");

//Ruta para eliminar un tenista
Route::delete("indexTenistas/{tenista}", [TenistasController::class, "destroy"])->name("destroy.destroyTenistas");