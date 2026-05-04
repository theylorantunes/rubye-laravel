<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $produtosEsgotados = Produto::where('estoque', '<=', 0)->count();
        $totalClientes = User::where('is_admin', false)->count();

        return view('admin.dashboard', compact('totalProdutos', 'produtosEsgotados', 'totalClientes'));
    }

    public function produtos()
    {
    // Puxa todos os produtos do banco (ordenados pelos mais novos)
    $produtos = \App\Models\Produto::latest()->get();
    return view('admin.produtos.index', compact('produtos'));

    }

    public function categorias() {
        $categorias = \App\Models\Categoria::all(); // Certifique-se que o Model existe
        return view('admin.categorias.index', compact('categorias'));
    }

    // Coleções
    public function colecoes() {
        $colecoes = \App\Models\Colecao::all(); // Certifique-se que o Model existe
        return view('admin.colecoes.index', compact('colecoes'));
    }

    // Pedidos
    public function pedidos() {
        // Aqui no futuro usaremos Order::with('user')->get();
        $pedidos = []; 
        return view('admin.pedidos.index', compact('pedidos'));
    }
}