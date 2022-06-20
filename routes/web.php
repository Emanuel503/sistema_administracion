<?php

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;

//Rutas de login
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

//Rutas de administrador
Route::get('/home', [App\Http\Controllers\LoginAdminController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class);

//Rutas de usuario
Route::resource('/home-user', LoginUserController::class);