<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Colecao;


class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $query = Produto::where('ativo', true);

        // Textos Padrão (Sem filtros)
        $titulo = 'Linha Completa';
        $subtitulo = 'Todos os Produtos';

        if ($request->has('categoria') && $request->categoria != 'all') {
            $categoria = Categoria::where('slug', $request->categoria)->first();
            if ($categoria) {
                $titulo = 'Categoria';
                $subtitulo = $categoria->nome;
            }
            $query->whereHas('categoria', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        if ($request->has('colecao')) {
            $colecaoId = $request->colecao;
            $colecao = Colecao::find($colecaoId);
            if ($colecao) {
                $titulo = 'Coleção Exclusiva';
                $subtitulo = $colecao->nome;
            }
            $query->whereHas('colecoes', function ($q) use ($colecaoId) {
                $q->where('colecoes.id', $colecaoId); 
            });
        }

        $produtos = $query->latest()->paginate(12)->appends($request->all());

        return view('produtos', compact('produtos', 'categorias', 'titulo', 'subtitulo'));
    }
}