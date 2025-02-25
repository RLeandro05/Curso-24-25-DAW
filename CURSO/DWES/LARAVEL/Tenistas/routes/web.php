<?php

use App\Http\Controllers\TenistaController;
use App\Http\Controllers\TitulosController;
use App\Http\Controllers\TorneoController;
use App\Models\Tenista;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::view('/pruebaLayout', 'pruebaLayout');
Route::get('/pruebaLayout', function () {
    return view('pruebaLayout', [
        'slot' => 'Este es el slot',
        'header' => 'header'
    ]);
});



/* Ruta para el principio */
Route::get('/tenistasProfesionales/estadisticasPepi', function () {
    return view('index');
})->name('index');




/* Tenistas */

//Ruta para listar tenistas
Route::get('/tenistasProfesionales/estadisticasPepi/tenistas',[TenistaController::class,'index'])->name('tenistas.index');

//Ruta para ver los títulos de un tenista
Route::get('/tenistasProfesionales/estadisticasPepi/tenistas/{tenista}/titulos', [TenistaController::class, 'titulosTenista'])->name('tenistas.titulos');

//Ruta para crear un tenista
Route::get('/tenistasProfesionales/estadisticasPepi/tenistas/create',[TenistaController::class,'create'])->name('tenistas.create');
Route::post('/tenistasProfesionales/estadisticasPepi/tenistas/store',[TenistaController::class,'store'])->name('tenistas.store');

//Rutas para editar y actualizar un tenista
Route::get('/tenistasProfesionales/estadisticasPepitenistas/{tenista}/edit',[TenistaController::class,'edit'])->name('tenistas.edit');
Route::put('/tenistasProfesionales/estadisticasPepitenistas/{tenista}',[TenistaController::class,'update'])->name('tenistas.update');

//Ruta para borrar un tenista
Route::delete('/tenistasProfesionales/estadisticasPepitenistas/{tenista}',[TenistaController::class,'destroy'])->name('tenistas.destroy');





/* Torneos */

Route::get('/tenistasProfesionales/estadisticasPepi/torneos', [TorneoController::class, 'index'])->name('torneos.index'); // Listar torneos
Route::get('/tenistasProfesionales/estadisticasPepi/torneos/create', [TorneoController::class, 'create'])->name('torneos.create'); // Formulario de creación
Route::post('/tenistasProfesionales/estadisticasPepi/torneos/store', [TorneoController::class, 'store'])->name('torneos.store'); // Guardar nuevo torneo
Route::get('/tenistasProfesionales/estadisticasPepi/torneos/{torneo}', [TorneoController::class, 'show'])->name('torneos.show'); // Ver detalles (opcional)
Route::get('/tenistasProfesionales/estadisticasPepi/torneos/{torneo}/edit', [TorneoController::class, 'edit'])->name('torneos.edit'); // Formulario de edición
Route::put('/tenistasProfesionales/estadisticasPepi/torneos/{torneo}', [TorneoController::class, 'update'])->name('torneos.update'); // Actualizar torneo
Route::delete('/tenistasProfesionales/estadisticasPepi/torneos/{torneo}', [TorneoController::class, 'destroy'])->name('torneos.destroy'); // Eliminar torneo






/* Rutas para Títulos */
Route::get('/tenistasProfesionales/estadisticasPepi/titulos', [TitulosController::class, 'index'])->name('titulos.index');
Route::get('/tenistasProfesionales/estadisticasPepi/titulos/create', [TitulosController::class, 'create'])->name('titulos.create');
Route::post('/tenistasProfesionales/estadisticasPepi/titulos/store', [TitulosController::class, 'store'])->name('titulos.store');
Route::get('/tenistasProfesionales/estadisticasPepi/titulos/{titulo}', [TitulosController::class, 'show'])->name('titulos.show');
Route::get('/tenistasProfesionales/estadisticasPepi/titulos/{anno}/{tenista_id}/{torneo_id}/edit', [TitulosController::class, 'edit'])->name('titulos.edit');
Route::put('/tenistasProfesionales/estadisticasPepi/titulos/{anno}/{tenista_id}/{torneo_id}', [TitulosController::class, 'update'])->name('titulos.update');
Route::delete('/tenistasProfesionales/estadisticasPepi/titulos/{anno}/{tenista_id}/{torneo_id}', [TitulosController::class, 'destroy'])->name('titulos.destroy');
