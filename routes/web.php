<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');


//rota do dashboard
Route::get('/dashboard', [DashboardController::class, 'home'])
    ->middleware('auth')
    ->name('dashboard.home');


//rota de homepage
Route::get('/home', [UtilController::class, 'loadHomepage'])->name('home');  //nome q eu dou a este caminho p/ q possa chamar interna/


//rota p/ ver users
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');

//rota p/ mostrar o formulário de registo
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');

//rota p/ ver/editar users
Route::get('/edit-users/{id}', [UserController::class, 'editUsers'])
    ->middleware('auth')
    ->name('users.edit');

//rota de atualizar users
Route::put('/update-user/{id}', [UserController::class, 'updateUser'])
    ->middleware('auth')
    ->name('users.update');

//rota p/ guardar o utilizador
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');

//rota do login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');



//rota p/ ver bandas
Route::get('/bands', [BandController::class, 'index'])->name('bands.index-band');

//rota p/ adicionar bandas
Route::get('/bands/create', [BandController::class, 'create'])
    ->middleware('auth')
    ->name('bands.create');

//rota para guardar bandas
Route::post('/bands', [BandController::class, 'store'])
    ->middleware('auth')
    ->name('bands.store');

//rota p/ editar bandas (pág de edição)
Route::get('/bands/{band}/edit', [BandController::class, 'edit'])
    ->middleware('auth')
    ->name('bands.edit');

//rota p/ atualizar bandas
Route::put('/bands/{band}', [BandController::class, 'update'])
    ->middleware('auth')
    ->name('bands.update');

//rota p/ apagar bandas
Route::delete('/bands/{band}', [BandController::class, 'destroy'])
    ->middleware('auth')
    ->name('bands.destroy');

//rota p/ ver álbuns de uma banda
Route::get('/bands/{band}/albums', [AlbumController::class, 'index'])->name('bands.albums');



//rota p/ mostrar o formulário de novo álbum
Route::get('/bands/{band}/albums/create', [AlbumController::class, 'create'])
    ->middleware('auth')
    ->name('albums.create');

//rota p/ guardar álbum
Route::post('/bands/{band}/albums', [AlbumController::class, 'store'])
    ->middleware('auth')
    ->name('albums.store');

//rota p/ mostrar o form. de edição do álbum
Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])
    ->middleware('auth')
    ->name('albums.edit');

//rota p/ atualizar álbum
Route::put('/albums/{album}', [AlbumController::class, 'update'])
    ->middleware('auth')
    ->name('albums.update');

//rota p/ apagar álbum
Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])
    ->middleware('auth')
    ->name('albums.destroy');



//rota fallback
Route::fallback(function(){
    return view('utils.fallback');
});
