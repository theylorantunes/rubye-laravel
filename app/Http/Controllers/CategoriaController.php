<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = \App\Models\Categoria::all();
        $colecoes = \App\Models\Colecao::all(); 

        return view('colecoes', compact('categorias', 'colecoes'));
    }
}