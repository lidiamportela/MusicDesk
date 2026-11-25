<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');

//rota de homepage
Route::get('/home', [UtilController::class, 'loadHomepage'])->name('home');

//rota do dashboard p/ auth.
Route::get('/dashboard', [DashboardController::class, 'home'])
    ->middleware('auth')
    ->name('dashboard.home');


//*** Serviços de Admin ***
Route::middleware(['auth', 'admin'])->group(function () {

    // Criar bandas
    Route::get('/bands/create', [BandController::class, 'create'])
        ->name('bands.create');

    // Guardar bandas
    Route::post('/bands', [BandController::class, 'store'])
        ->name('bands.store');

    // Apagar bandas
    Route::delete('/bands/{band}', [BandController::class, 'destroy'])
        ->name('bands.destroy');


    // Criar álbuns
    Route::get('/bands/{band}/albums/create', [AlbumController::class, 'create'])
        ->name('albums.create');

    // Guardar álbuns
    Route::post('/bands/{band}/albums', [AlbumController::class, 'store'])
        ->name('albums.store');

    // Apagar álbuns
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])
        ->name('albums.destroy');

});


//*** Serviços de users auth. ***

Route::middleware('auth')->group(function () {

//rota p/ ver users
Route::get('/users', [UserController::class, 'allUsers'])
    ->name('users.all');

//rota p/ ver/editar users
Route::get('/edit-users/{id}', [UserController::class, 'editUsers'])
    ->name('users.edit');

//rota de atualizar users
Route::put('/update-user/{id}', [UserController::class, 'updateUser'])
    ->name('users.update');


//rota p/ editar bandas (pág de edição)
Route::get('/bands/{band}/edit', [BandController::class, 'edit'])
    ->name('bands.edit');

//rota p/ atualizar bandas
Route::put('/bands/{band}', [BandController::class, 'update'])
    ->name('bands.update');


//rota p/ editar álbum
Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])
    ->name('albums.edit');

//rota p/ atualizar álbum
Route::put('/albums/{album}', [AlbumController::class, 'update'])
    ->name('albums.update');
});


//***  Visível p/ todos ***

//rota de registo
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');

//rota p/ guardar o utilizador
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');

//rota do login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


//rota p/ ver bandas
Route::get('/bands', [BandController::class, 'index'])->name('bands.index-band');

//rota p/ ver álbuns de uma banda
Route::get('/bands/{band}/albums', [AlbumController::class, 'index'])->name('bands.albums');


//*** Exports ***/
Route::get('/bands/{band}/export/pdf', [BandController::class, 'exportPdf'])->name('bands.export.pdf');
Route::get('/bands/{band}/export/csv', [BandController::class, 'exportCsv'])->name('bands.export.csv');
Route::get('/bands/{band}/export/json', [BandController::class, 'exportJson'])->name('bands.export.json');


//rota fallback
Route::fallback(function(){
    return view('utils.fallback');
});
