<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResenaController;


// Route::group(['middleware' => ['auth', 'verified'], 'as' => 'admin.'], function() {

//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//     Route::resource('libros', LibroController::class);

// });

// landing
Route::get('/', [HomeController::class, 'index']);

// catalogo
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo');
// Route::get('/catalogo', [App\Http\Controllers\LibroController::class, 'catalogo'])->name('catalogo');
// Route::get('/catalogo', [LibroController::class, 'catalogo'])->name('catalogo');

// pagina libro
Route::get('/libro/{libro}', [LibroController::class, 'show'])->name('libro.show');
    
// reservas
// Route::post('/libros/{libro}/reservar', [LibroController::class, 'reservar'])->name('libros.reservar');
Route::get('/libros/{libro}/reservar', [LibroController::class, 'formReserva'])->name('libros.reservar.form');

// no poder reservar si no has iniciado sesion
Route::post('/libros/{libro}/reservar',
    [LibroController::class, 'reservar'])
    ->middleware('auth')
    ->name('libros.reservar');

// menu usuario, mis libros
Route::middleware(['auth'])->group(function () {
    Route::get('/mis-libros', [LibroController::class, 'misLibros'])
        ->middleware('auth')
        ->name('mis-libros');

});

// enlace de perfil en menu del usario logueado que vaya al creado por breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// cancelar reservas en mis libros
Route::delete(
    '/reservas/{reserva}',
    [LibroController::class, 'cancelarReserva']
)->name('reservas.cancelar');


// lector de pdf
Route::get('/lector/{libro}', [LibroController::class, 'lector'])
    ->middleware('auth')
    ->name('lector');

// ver resenas
Route::post('/libros/{libro}/resenas', [ResenaController::class, 'store'])
        ->name('resenas.store');


// dahsboard y crud
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     // Route::resource('libros', LibroController::class);
// });



// proteger rutas dashboard
// Route::middleware(['auth'])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::resource('libros', LibroController::class);
// });

// panel de administración aquí
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // libros
    Route::resource('libros', LibroController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('ejemplares', EjemplarController::class)->except(['create','store','destroy']);
    // reservas (solo imdex y delete)
    Route::get('/reservas', [ReservaController::class, 'index'])
        ->name('reservas.index');

    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])
        ->name('reservas.destroy');

    // user, solo index y eliminar
    Route::get('/usuarios', [UserController::class, 'index'])
        ->name('usuarios.index');

    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
        ->name('usuarios.destroy');

    // reseñas solo ver y eliminar, y para ver las resenas en los libros
    Route::get('/resenas', [ResenaController::class, 'index'])
        ->name('admin.resenas.index');

    Route::get('/resenas', [ResenaController::class, 'index'])
        ->name('resenas.index');

    Route::delete('/resenas/{resena}', [ResenaController::class, 'destroy'])
        ->name('resenas.destroy');

    // homa con .admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

/* Route::get('/', function () {
    return view('welcome');
}); */

// Auth::routes(['verify' => true]);

// Route::group(['middleware' => ['auth', 'verified'], 'as' => 'admin.'], function() {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     // Route::resource('users', UserController::class);
//     Route::resource('clubs', ClubsController::class);
//     Route::resource('players', PlayersController::class);

//     // Route::resource('clients', ClientController::class);
//     // Route::resource('cprojects', ProjectController::class);
//     // Route::resource('tasks', TaskController::class);
// });

require __DIR__.'/auth.php';


/* Route::get('/players', function() {
    return "Bienvenidos a la vista en la que se podrán ver los jugaodres";
}); */
// Route::get('/players', [PlayersController::class, 'index']);



/* Route::get('/players/create', function() {
    return "Esta es la página donde se crean nuevos jugadores";
}); */
// Route::get('/players/create', [PlayersController::class, 'create']);



// Route::get('/players/{nombre}', function($nombre) {
//     return "Bienvenido a la página de del jugador: " .$nombre;
// });



/* Route::get('/players/{nombre}/{club?}', function($nombre,$club=null) {
    if($club) {
        return "Bienvenido a la página de del jugador: " .$nombre . " que pertenece al club " .$club;

    } else {
        return "Bienvenido a la página de del jugador: " .$nombre;
    }
}); */
// Route::get('/players/{nombre}/{club?}', [PlayersController::class, 'help']);

