<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// rota inicial
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rotas publicas
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/produto/{id}', [App\Http\Controllers\ProdutoController::class, 'show'])->name('produto.show');

Route::get('/colecoes', [CategoriaController::class, 'index'])->name('colecoes.index');
Route::view('/sobre-nos', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');

// rotas breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// carrinho

Route::middleware('auth')->group(function () {
    
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');

    Route::get('/checkout', [CarrinhoController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/finalizar', [CarrinhoController::class, 'finalizar'])->name('checkout.finalizar');

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // rota: /admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
});

require __DIR__.'/auth.php';