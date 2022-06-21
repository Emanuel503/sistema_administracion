<?php

use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\LoginUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalasController;

//Rutas de login
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', [LoginUserController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class);
Route::resource('/solicitudes-sala', SalasController::class);
Route::resource('/actividades', ActividadesController::class);
