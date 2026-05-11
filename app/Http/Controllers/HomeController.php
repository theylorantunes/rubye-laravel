<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Colecao;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $colecoes = Colecao::latest()->take(3)->get();

        $produtos = Produto::where('ativo', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('colecoes', 'produtos'));
    }
}