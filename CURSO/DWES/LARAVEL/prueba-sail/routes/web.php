<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get("/hola", function() {
    return "Hola, mundo";
});*/

Route::get('/hola', [HolaController::class, 'index']);
Route::get('/hola/{nombre}', [HolaController::class, 'show']);