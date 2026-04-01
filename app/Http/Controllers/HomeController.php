<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Colecao;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::where('status', 'ativo')->orderBy('created_at', 'desc')->take(8)->get();
        $colecoes = Colecao::all();

        return view('home', [
            'mensagem' => 'Bem-vindo à página inicial do Rubye!',
            'produtos' => $produtos,
            'colecoes' => $colecoes
        ]);
    }
}