<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function show($id)
    {
        $produto = Produto::with('categoria')->findOrFail($id);


        $relacionados = Produto::where('categoria_id', $produto->categoria_id)
                                ->where('id', '!=', $produto->id)
                                ->where('ativo', true)
                                ->inRandomOrder()
                                ->take(4)
                                ->get();
        
        return view('produto.show', compact('produto', 'relacionados'));
    }
}