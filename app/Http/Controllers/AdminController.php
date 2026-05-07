<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $produtosEsgotados = Produto::where('estoque', '<=', 0)->count();
        $totalClientes = User::where('is_admin', false)->count();

        return view('admin.dashboard', compact('totalProdutos', 'produtosEsgotados', 'totalClientes'));
    }

    public function produtos(\Illuminate\Http\Request $request)
    {

        $categorias = \App\Models\Categoria::all();


        $query = \App\Models\Produto::query();
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $produtos = $query->with('categoria')->latest()->get();
        

        return view('admin.produtos.index', compact('produtos', 'categorias'));
    }

    public function produtosCreate()
    {
        // Precisamos buscar categorias e coleções para preencher os selects/checkboxes do form
        $categorias = \App\Models\Categoria::all();
        $colecoes = \App\Models\Colecao::all();

        return view('admin.produtos.create', compact('categorias', 'colecoes'));
    }

    public function produtosStore(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'imagem' => 'nullable|image|max:2048'
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $imageName = time() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('img/produtos'), $imageName);
            $dados['imagem'] = 'img/produtos/' . $imageName;
        }


        $produto = \App\Models\Produto::create($dados);

        if ($request->has('colecoes')) {
            $produto->colecoes()->attach($request->colecoes);
        }

        return redirect()->route('admin.produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function categorias() {
        $categorias = \App\Models\Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function categoriasStore(\Illuminate\Http\Request $request)
    {
        $request->validate(['nome' => 'required|unique:categorias|max:255']);

        \App\Models\Categoria::create([
            'nome' => $request->nome,
            'slug' => Str::slug($request->nome)
        ]);

        return redirect()->back()->with('success', 'Categoria criada com sucesso!');
    }    

    // colecoes
    public function colecoes()
    {
        $colecoes = \App\Models\Colecao::all();
        return view('admin.colecoes.index', compact('colecoes')); 
    }

    public function colecoesStore(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'nullable',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $dados = $request->all();

        // logica para salvar a imagem
        if ($request->hasFile('imagem')) {
            $imageName = time() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('img/colecoes'), $imageName);
            $dados['imagem'] = 'img/colecoes/' . $imageName;
        }

        \App\Models\Colecao::create($dados);

        return redirect()->back()->with('success', 'Coleção criada com sucesso!');
    }

    // Pedidos
    public function pedidos() {
        // Aqui no futuro usaremos Order::with('user')->get();
        $pedidos = []; 
        return view('admin.pedidos.index', compact('pedidos'));
    }
}