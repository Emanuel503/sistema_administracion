<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\ActividadesController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/actividades/calendario', [App\Http\Controllers\ActividadesController::class, 'calendar']);
Route::resource('/users', UsersController::class)->middleware('auth');
Route::resource('/solicitudes-sala', SalasController::class)->middleware('auth');
Route::resource('/actividades', ActividadesController::class)->middleware('auth');
