<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        // busca todas as categorias 
        $categorias = Categoria::all();
        
        return view('colecoes', compact('categorias'));
    }
}