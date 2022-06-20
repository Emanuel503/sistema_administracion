<?php

use App\Http\Controllers\RegisterUsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home/users', function () {
    return view('administrador.users');
});

Route::get('/home/users', [RegisterUsersController::class, 'index'])->name('users');


Route::resource('/users', UserController::class);