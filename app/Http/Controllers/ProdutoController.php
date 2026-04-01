<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function show($id)
    {
        $produto = Produto::with(['categoria', 'imagens'])->findOrFail($id);

        return response()->json([
            'mensagem' => 'Detalhes do Produto localizados!',
            'produto' => $produto
        ]);
    }
}