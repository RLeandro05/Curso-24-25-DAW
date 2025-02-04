<?php

//use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\HolaController;

use App\Http\Middleware\FirstMiddleware; 
use App\Http\Middleware\SecondMiddleware;

/*Route::get('/', function () {
    return view('welcome');
});

Route::get("/hola", function() {
    return "Hola, mundo";
});

/Route::get('/hola', [HolaController::class, 'index']);
Route::get('/hola/{nombre}', [HolaController::class, 'show']);

//BlogController
// Mostrar todos los artículos del blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

// Mostrar un artículo específico
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

// Mostrar el formulario para crear un nuevo artículo
Route::get('/blog/crear', [BlogController::class, 'create'])->name('blog.create');*/

/*Route::get("contactos", function() {
    return "Sección de contactos";
})->name("contactos");*/

Route::middleware('first')->group(function () {
    Route::get('user/profile', function () {
        return "Dashboard del usuario con middlewares 'first' y 'second'.";
    });
    Route::get('user/', function () {
        return "Ajustes del usuario con middlewares 'first' y 'second'.";
    });
}); 
   