<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SaidaEstoqueController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RelatorioController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('categorias', CategoriaController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('unidades', UnidadeController::class);

Route::resource('produtos', ProdutoController::class);

Route::resource('saidas_estoque', SaidaEstoqueController::class);

Route::get('/saidas_estoque/{id}/qrcode', [SaidaEstoqueController::class, 'showQrCode'])->name('saidas_estoque.qrcode');

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios');

Route::get('/relatorios/{tipo}', [RelatorioController::class, 'gerarPDF'])->name('relatorios.gerar');