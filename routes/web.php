<?php

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

// rota p/ ver users
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');

//rota p/ mostrar o formulário de registo
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');

//rota p/ guardar o utilizador
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');

//rota do login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');





