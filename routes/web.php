<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (A Loja)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/produto/{id}', [ProdutoController::class, 'show'])->name('produto.show');

// Tela pública de coleções
Route::get('/colecoes', [CategoriaController::class, 'index'])->name('colecoes.public');

Route::view('/sobre-nos', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação (Breeze) e Carrinho
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Carrinho e Checkout
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::get('/checkout', [CarrinhoController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/finalizar', [CarrinhoController::class, 'finalizar'])->name('checkout.finalizar');
});

/*
|--------------------------------------------------------------------------
| Rotas Administrativas (O Painel) - Protegidas
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard Principal
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Gestão de Produtos
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos.index');
    Route::get('/produtos/novo', [AdminController::class, 'produtosCreate'])->name('admin.produtos.create');
    Route::post('/produtos/salvar', [AdminController::class, 'produtosStore'])->name('admin.produtos.store');

    // Gestão de Categorias
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias.index');
    Route::post('/categorias/salvar', [AdminController::class, 'categoriasStore'])->name('admin.categorias.store');

    // Gestão de Coleções (CRUD Admin)
    Route::get('/colecoes', [AdminController::class, 'colecoes'])->name('admin.colecoes.index');
    Route::post('/colecoes/salvar', [AdminController::class, 'colecoesStore'])->name('admin.colecoes.store');

    // Gestão de Pedidos
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos.index');

});

require __DIR__.'/auth.php';