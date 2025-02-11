<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/categorias', [CategoriaController::class,'index']);
Route::resource('categorias', CategoriaController::class);

Route::get('/clientes', [ClienteController::class, 'index']);
Route::resource('clientes', ClienteController::class);

Route::get('/unidades', [UnidadeController::class,'index']);
Route::resource('unidades', UnidadeController::class);
