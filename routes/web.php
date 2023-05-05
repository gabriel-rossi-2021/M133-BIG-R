<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\UpdateController;
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

// ROUTE POUR LA VUE INDEX
Route::get('/', [IndexController::class, 'index'])->name('vue_index');

// ROUTE POUR LA VUE CONNEXION
Route::get('/connexion', [AuthController::class, 'index'])->name('vue_connexion');
Route::post('/connexion', [AuthController::class, 'store'])->name('store_connexion');

// ROUTE POUR LA VUE COMPTE
Route::get('/compte', [CompteController::class, 'index'])->name('vue_conpte'); // NE PAS OUBLIER ->middleware('auth')

// ROUTE POUR LA VUE UPDATECOMPTE
Route::get('/update', [UpdateController::class, 'index'])->name('vue_update'); // NE PAS OUBLIER ->middleware('auth')
Route::POST('/update', [UpdateController::class, 'update'])->name('vue_update-form'); // NE PAS OUBLIER ->middleware('auth')
