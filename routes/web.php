<?php

use App\Http\Controllers\ActividadesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalasController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', [LoginUserController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class);
Route::resource('/solicitudes-sala', SalasController::class);
Route::resource('/actividades', ActividadesController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class)->middleware('auth');
Route::resource('/solicitudes-sala', SalasController::class)->middleware('auth');
Route::resource('/actividades', ActividadesController::class)->middleware('auth');
