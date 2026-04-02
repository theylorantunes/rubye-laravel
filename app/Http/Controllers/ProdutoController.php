<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function show($id)
    {
        $produto = Produto::with(['categoria', 'imagens'])->findOrFail($id);

        return view('produto', [
            'produto' => $produto
        ]);
    }
}