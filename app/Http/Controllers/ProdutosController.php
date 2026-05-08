<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $categorias = \App\Models\Categoria::all();


        $query = \App\Models\Produto::query();

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $produtos = Produto::where('ativo', true)
            ->when($request->categoria, function($q) use ($request) {
                return $q->where('categoria_id', $request->categoria);
            })
            ->get();

        return view('produtos', compact('produtos', 'categorias'));
    }
}