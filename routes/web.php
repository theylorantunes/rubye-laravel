<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;

// rotas públicas

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/produto/{id}', [ProdutoController::class, 'show']);

Route::get('/carrinho', function () {
    return 'Página do Carrinho de Compras';
});

// rotas admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return 'Painel de Controle do Administrador';
    });
    Route::get('/produtos', function () {
        return 'Lista de Produtos para o Admin gerenciar';
    });
});

// Rotas Institucionais
Route::get('/produtos', [App\Http\Controllers\ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/colecoes', [App\Http\Controllers\CategoriaController::class, 'index'])->name('colecoes.index');
Route::view('/sobre-nos', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');