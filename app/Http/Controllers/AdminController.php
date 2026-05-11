<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Colecao;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // =========================================================================
    // 1. DASHBOARD
    // =========================================================================

    public function index()
    {
        // Métricas para os Cards (considerando os status de cancelamento)
        $totalVendas = Pedido::whereNotIn('status', ['Pedido Cancelado', 'Cancelado'])->sum('total');
        $qtdPedidos = Pedido::count();
        $qtdProdutos = Produto::count();
        $estoqueBaixo = Produto::where('estoque', '<', 5)->get();

        // Dados para o Gráfico (Vendas nos últimos 7 dias)
        $vendasSeteDias = Pedido::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as data, SUM(total) as total')
            ->groupBy('data')
            ->orderBy('data')
            ->get();

        return view('admin.dashboard', compact('totalVendas', 'qtdPedidos', 'qtdProdutos', 'estoqueBaixo', 'vendasSeteDias'));
    }


    // =========================================================================
    // 2. GESTÃO DE PRODUTOS
    // =========================================================================

    public function produtos(Request $request)
    {
        $categorias = Categoria::all();

        $query = Produto::query();
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $produtos = $query->with('categoria')->latest()->get();

        return view('admin.produtos.index', compact('produtos', 'categorias'));
    }

    public function produtosCreate()
    {
        $categorias = Categoria::all();
        $colecoes = Colecao::all();

        return view('admin.produtos.create', compact('categorias', 'colecoes'));
    }

    public function produtosStore(Request $request)
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

        $produto = Produto::create($dados);

        if ($request->has('colecoes')) {
            $produto->colecoes()->attach($request->colecoes);
        }

        return redirect()->route('admin.produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function produtosEdit($id) 
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $colecoes = Colecao::all();
        return view('admin.produtos.edit', compact('produto', 'categorias', 'colecoes'));
    }

    public function produtosUpdate(Request $request, $id) 
    {
        $produto = Produto::findOrFail($id);
        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            if ($produto->imagem && file_exists(public_path($produto->imagem))) {
                unlink(public_path($produto->imagem));
            }
            $nomeImagem = time() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('img/produtos'), $nomeImagem);
            $dados['imagem'] = 'img/produtos/' . $nomeImagem;
        }

        $produto->update($dados);
        
        if ($request->has('colecoes')) {
            $produto->colecoes()->sync($request->colecoes);
        } else {
            $produto->colecoes()->detach();
        }

        return redirect()->route('admin.produtos.index')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function produtosToggle($id) 
    {
        $produto = Produto::findOrFail($id);
        $produto->ativo = !$produto->ativo;
        $produto->save();
        return back()->with('sucesso', 'Status do produto atualizado!');
    }


    // =========================================================================
    // 3. GESTÃO DE CATEGORIAS
    // =========================================================================

    public function categorias() 
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function categoriasStore(Request $request)
    {
        $request->validate(['nome' => 'required|unique:categorias|max:255']);

        Categoria::create([
            'nome' => $request->nome,
            'slug' => Str::slug($request->nome)
        ]);

        return redirect()->back()->with('success', 'Categoria criada com sucesso!');
    }    

    public function categoriasEdit($id) 
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function categoriasUpdate(Request $request, $id) 
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return redirect()->route('admin.categorias.index')->with('sucesso', 'Categoria atualizada!');
    }

    public function categoriasToggle($id) 
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->ativo = !$categoria->ativo;
        $categoria->save();
        return back()->with('sucesso', 'Status da categoria atualizado!');
    }


    // =========================================================================
    // 4. GESTÃO DE COLEÇÕES
    // =========================================================================

    public function colecoes()
    {
        $colecoes = Colecao::all();
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

        if ($request->hasFile('imagem')) {
            $imageName = time() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('img/colecoes'), $imageName);
            $dados['imagem'] = 'img/colecoes/' . $imageName;
        }

        Colecao::create($dados);

        return redirect()->back()->with('success', 'Coleção criada com sucesso!');
    }

    public function colecoesEdit($id) 
    {
        $colecao = Colecao::findOrFail($id);
        return view('admin.colecoes.edit', compact('colecao'));
    }

    public function colecoesUpdate(Request $request, $id) 
    {
        $colecao = Colecao::findOrFail($id);
        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            if ($colecao->imagem && file_exists(public_path($colecao->imagem))) {
                unlink(public_path($colecao->imagem));
            }
            $nomeImagem = time() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('img/colecoes'), $nomeImagem);
            $dados['imagem'] = 'img/colecoes/' . $nomeImagem;
        }

        $colecao->update($dados);
        return redirect()->route('admin.colecoes.index')->with('sucesso', 'Coleção atualizada!');
    }

    public function colecoesDestroy($id) 
    {
        $colecao = Colecao::findOrFail($id);

        if ($colecao->imagem && file_exists(public_path($colecao->imagem))) {
            unlink(public_path($colecao->imagem));
        }
        $colecao->delete();
        return back()->with('sucesso', 'Coleção removida com sucesso!');
    }


    // =========================================================================
    // 5. GESTÃO DE PEDIDOS (Novo Fluxo: Stepper, Avançar e Cancelar)
    // =========================================================================

    public function pedidos(Request $request)
    {
        $query = Pedido::with(['user', 'itens.produto'])->latest();

        // Filtro por Status
        if ($request->has('status') && $request->status !== 'Todos') {
            $query->where('status', $request->status);
        }

        $pedidos = $query->get();
        
        // Contagem dinâmica para exibir nos botões de filtro no topo
        $contagem = [
            'Todos' => Pedido::count(),
            'Aguardando' => Pedido::where('status', 'Aguardando')->count(),
            'Confirmado' => Pedido::where('status', 'Confirmado')->count(),
            'Preparando' => Pedido::where('status', 'Preparando')->count(),
            'Enviado' => Pedido::where('status', 'Enviado')->count(),
            'Entregue' => Pedido::where('status', 'Entregue')->count(),
            'Cancelado' => Pedido::where('status', 'Cancelado')->count(),
        ];

        return view('admin.pedidos.index', compact('pedidos', 'contagem'));
    }

    public function avancarStatus($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        // Sequência exata de evolução solicitada
        $fluxo = ['Aguardando', 'Confirmado', 'Preparando', 'Enviado', 'Entregue'];
        
        // Interoperabilidade: Se o pedido possuir um status legado do banco (ex: "Pedido Recebido"),
        // injetamos temporariamente na lógica como "Aguardando" para permitir que avance de forma fluida.
        $statusAtual = $pedido->status;
        if (!in_array($statusAtual, $fluxo) && $statusAtual !== 'Cancelado') {
            $statusAtual = 'Aguardando';
        }

        $posicaoAtual = array_search($statusAtual, $fluxo);
        
        // Verifica se o status existe na lista e se não é o último (Entregue)
        if ($posicaoAtual !== false && $posicaoAtual < count($fluxo) - 1) {
            $pedido->status = $fluxo[$posicaoAtual + 1];
            $pedido->save();
            return back()->with('sucesso', 'Pedido avançado para: ' . $pedido->status);
        }

        return back()->with('erro', 'Não é possível avançar este pedido para a próxima etapa.');
    }

    public function cancelarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        // O cancelamento atua como estado terminal acessível antes da entrega final
        if ($pedido->status !== 'Entregue') {
            $pedido->status = 'Cancelado';
            $pedido->save();
            return back()->with('sucesso', 'Pedido cancelado com sucesso.');
        }

        return back()->with('erro', 'Pedidos já entregues não podem ser cancelados.');
    }
}