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
}