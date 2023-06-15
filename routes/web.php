<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Página de inicio
Route::get(('/'), [LoginController::class, 'index'])->name('return');

Auth::routes();

// Registro y reestablecimiento de contraseñas
Route::get('register',[LoginController::class, 'register'])->name('user.register');
Route::post('save_user',[LoginController::class, 'save'])->name('user.save');
Route::get('restore',[LoginController::class, 'reset']) ->name('user.restore');

// Inicio
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::put('change/{user}',[HomeController::class, 'changePassword'])->name('user.change');
Route::post('change.image',[HomeController::class, 'image'])->name('user.image');
Route::get('/tutorials', [HomeController::class, 'tutorials'])->name('tutorials');

//Usuarios
Route::resource('users', UserController::class)->except(['show']);
