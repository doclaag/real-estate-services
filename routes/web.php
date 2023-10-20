<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Create Account
Route::middleware(['auth'])->group(function () {
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Dashboard
Route::get('/dashboard/{user:username}', function () {
    return view('dashboard');
})->name('dashboard');


// Project
Route::get('/{user:username}/proyectos', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/{user:username}/crear-proyecto', [ProjectController::class, 'create'])->name('projects.create'); // Cambiado a "create"
Route::post('/{user:username}/crear-proyecto', [ProjectController::class, 'store']);

Route::get('/{user:username}/proyectos/editar/{project}', [ProjectController::class, 'edit'])->name('projects.edit'); // Cambiado a "proyectos"
Route::patch('/{user:username}/proyectos/{project}', [ProjectController::class, 'update'])->name('projects.update'); // Usar "patch" en lugar de "put"
Route::delete('/{user:username}/proyectos/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
