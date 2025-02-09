<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/categorias', [CategoriaController::class,'index']);
Route::resource('categorias', CategoriaController::class);

Route::get('/clientes', [ClienteController::class, 'index']);
Route::resource('clientes', ClienteController::class);
