<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/// Redirige a la página de login por defecto
Route::get('/', function () {
    return redirect()->route('login');
});

// Muestra el formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Procesa el login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Otras rutas
Route::get('/Welcome', function () {
    return view('welcome');
})->name('Welcome');

Route::get('/Rutas', function () {
    return view('rutas');
})->name('Rutas');

Route::get('/Leyendas', function () {
    return view('leyendas');
})->name('Leyendas');

