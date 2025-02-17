<?php
/*
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HolaController;*/

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\userPruebaControler;
use App\Http\Controllers\ActividadesController;
use App\Models\Task;*/
/*
Route::get('/hola/{nombre}', [HolaController::class, 'index']);
*/

Route::get('/', function () {
    return view("welcome");
});


//Route::get('/tasks', [TaskController::class, 'index']);

Route::get("tasks", [TaskController::class, "index"])->name(name:"tasks.index");

Route::get("tasks/create", [TaskController::class, "create"])->name(name:"tasks.create");

Route::post('tasks', [TaskController::class, "store"])->name(name:"tasks.store");

/*
Route::get('/pruebalayout', function () {
    return view("pruebalayout");
});*/


/*
Route::get('/layout', function () {
    return view("layouts/app");
});*/

//Route::view('/layout', 'layouts/app')

/*
Route::get('/tasks', function () {
    $tasks=Task::all();
    dump($tasks);
});*/

/*
Route::get('/tasks', function () {
    $tasks=Task::take(10)->all();
    dump($tasks);
});
*/

/*
Route::get('/tasks', function () {
    $tasks=Task::take(10)->get(['original'=>'name']); // get o take
    dump($tasks); // Detiene la ejecución del script 
});
*/



/*
Route::get('/hola/{nombre}', [HolaController::class, 'show']);


//BlogController

Route::get('/index', [BlogController::class, 'index'])->name('blog.index');
Route::get('/show/{nombreBlog}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/create/{nombreBlog}', [BlogController::class, 'create'])->name('blog.create');

Route::get('contactos', function () {
    return "Sección de contactos";
});

/*
Route::get('/', function () {
    echo "<p><a href='/contactos'>Contactos 1 </a></p>";
    echo "<p><a href='/contactos'>Contactos 2 </a></p>";
    echo "<p><a href='/contactos'>Contactos 3 </a></p>";
    echo "<p><a href='/contactos'>Contactos 4 </a></p>";
    echo "<p><a href='/contactos'>Contactos 5 </a></p>";
});*/


/*
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('dashboard', function () {
        return "Dashboard admin";
    });
});


Route::get('/login', function () {
    return 'Página de login';
})->name('login');


//Route::view('/welcome', 'hola');
Route::view('/welcome', 'hola', ['nombre' => 'Taylor']);
    
Route::get('/quienesSomos/{nombre?}', [userPruebaControler::class, 'quienesSomos']);

Route::get('/actividades', [ActividadesController::class, 'actividades'])->name('actividades');*/