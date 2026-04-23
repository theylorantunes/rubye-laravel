<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
{
    // pesquisa de produtos pela barra de pesquisa
    $query = \App\Models\Produto::query();

    if ($request->filled('busca')) {

        $query->where('nome', 'like', '%' . $request->busca . '%');
    }

    $produtos = $query->get(); 

    return view('produtos', compact('produtos')); 
    }
}