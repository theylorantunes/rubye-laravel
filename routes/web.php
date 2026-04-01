<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;

// rotas públicas

Route::get('/', [HomeController::class, 'index']);

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