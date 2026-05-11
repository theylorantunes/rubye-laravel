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
    Route::get('/meus-pedidos', [ProfileController::class, 'pedidos'])->name('profile.pedidos');

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
    Route::get('/produtos/editar/{id}', [AdminController::class, 'produtosEdit'])->name('admin.produtos.edit');
    Route::post('/produtos/update/{id}', [AdminController::class, 'produtosUpdate'])->name('admin.produtos.update');
    Route::get('/produtos/status/{id}', [AdminController::class, 'produtosToggle'])->name('admin.produtos.toggle');
    Route::post('/pedidos/{id}/status', [\App\Http\Controllers\AdminController::class, 'atualizarStatusPedido'])->name('admin.pedidos.status');
    Route::post('/pedidos/{id}/avancar', [AdminController::class, 'avancarStatus'])->name('admin.pedidos.avancar');
    Route::post('/pedidos/{id}/cancelar', [AdminController::class, 'cancelarPedido'])->name('admin.pedidos.cancelar');

    // Gestão de Categorias
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias.index');
    Route::post('/categorias/salvar', [AdminController::class, 'categoriasStore'])->name('admin.categorias.store');
    Route::get('/categorias/editar/{id}', [AdminController::class, 'categoriasEdit'])->name('admin.categorias.edit');
    Route::post('/categorias/update/{id}', [AdminController::class, 'categoriasUpdate'])->name('admin.categorias.update');
    Route::get('/categorias/status/{id}', [AdminController::class, 'categoriasToggle'])->name('admin.categorias.toggle');

    // Gestão de Coleções (CRUD Admin)
    Route::get('/colecoes', [AdminController::class, 'colecoes'])->name('admin.colecoes.index');
    Route::post('/colecoes/salvar', [AdminController::class, 'colecoesStore'])->name('admin.colecoes.store');
    Route::get('/colecoes/editar/{id}', [AdminController::class, 'colecoesEdit'])->name('admin.colecoes.edit');
    Route::post('/colecoes/update/{id}', [AdminController::class, 'colecoesUpdate'])->name('admin.colecoes.update');
    Route::delete('/colecoes/excluir/{id}', [AdminController::class, 'colecoesDestroy'])->name('admin.colecoes.destroy');

    // Gestão de Pedidos
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos.index');

});

require __DIR__.'/auth.php';