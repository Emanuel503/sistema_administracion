<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SolicitudesSalasController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\DependenciasTransporteController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\Permisos;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\RegistrosSalidasController;
use App\Http\Controllers\SolicitudesTransporteController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\SolicitudCombustibleController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', UsersController::class)->middleware('auth');
Route::resource('/salas', SalasController::class)->middleware('auth');
Route::resource('/solicitudes-sala', SolicitudesSalasController::class)->middleware('auth');
Route::resource('/actividades', ActividadesController::class)->middleware('auth');
Route::resource('/solicitudes-transporte', SolicitudesTransporteController::class)->middleware('auth');
Route::resource('/dependencias-transporte', DependenciasTransporteController::class)->middleware('auth');
Route::resource('/vehiculos', VehiculosController::class)->middleware('auth');
Route::resource('/lugares', LugaresController::class)->middleware('auth');
Route::resource('/permisos', Permisos::class)->middleware('auth');

Route::get('/transporte/reporte/', [App\Http\Controllers\TransporteController::class, 'reporte'])->name('transporte.reporte')->middleware('auth');
Route::post('/transporte/reporte/', [App\Http\Controllers\TransporteController::class, 'vehiculoPdf'])->name('transporte.vehiculoPdf')->middleware('auth');

Route::get('/transporte/pdf/{id}', [App\Http\Controllers\TransporteController::class, 'pdf'])->name('transporte.pdf')->middleware('auth');
Route::resource('/transporte', TransporteController::class)->middleware('auth');

Route::resource('/solicitud-combustible', SolicitudCombustibleController::class)->middleware('auth');
Route::resource('/registros-salida', RegistrosSalidasController::class)->middleware('auth');
Route::get('/calendario', [App\Http\Controllers\CalendarioController::class, 'calendar']);
Route::post('/calendario/actividad/{id}', [App\Http\Controllers\CalendarioController::class, 'actividad']);
Route::post('/calendario/salida/{id}', [App\Http\Controllers\CalendarioController::class, 'salida']);