<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SolicitudesSalasController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\PlacasVehiculosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\SolicitudesTransporteController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class)->middleware('auth');
Route::resource('/salas', SalasController::class)->middleware('auth');
Route::resource('/solicitudes-sala', SolicitudesSalasController::class)->middleware('auth');
Route::resource('/actividades', ActividadesController::class)->middleware('auth');
Route::resource('/solicitudes-transporte', SolicitudesTransporteController::class)->middleware('auth');
Route::resource('/dependencias-transporte', SolicitudesTransporteController::class)->middleware('auth');
Route::resource('/placas-vehiculos', PlacasVehiculosController::class)->middleware('auth');
Route::resource('/lugares', LugaresController::class)->middleware('auth');
Route::get('/calendario', [App\Http\Controllers\CalendarioController::class, 'calendar']);
Route::post('/calendario/edit/{id}', [App\Http\Controllers\CalendarioController::class, 'edit']);
