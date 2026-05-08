<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $total = 0;
        foreach($carrinho as $item) { $total += $item['preco'] * $item['quantidade']; }

        return view('carrinho.index', compact('carrinho', 'total'));
    }

    public function adicionar(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if(isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
        } else {

            $carrinho[$id] = [
                "nome" => $produto->nome,
                "quantidade" => 1,
                "preco" => $produto->preco,
                "imagem" => $produto->imagem
            ];
        }

        session()->put('carrinho', $carrinho);
        return redirect()->route('carrinho.index')->with('sucesso', 'Produto adicionado!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);
        if(isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        $carrinho = session()->get('carrinho', []);
        
        if(empty($carrinho)) {
            return redirect()->route('produtos.index');
        }

        $total = 0;
        foreach($carrinho as $item) { $total += $item['preco'] * $item['quantidade']; }

        return view('carrinho.checkout', compact('carrinho', 'total'));
    }

    public function finalizar(\Illuminate\Http\Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        
        if(empty($carrinho)) {
            return redirect()->route('produtos.index');
        }

        $total = 0;
        foreach($carrinho as $item) { 
            $total += $item['preco'] * $item['quantidade']; 
        }

        $pedido = \App\Models\Pedido::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'Pedido Recebido', 
        ]);

        foreach($carrinho as $produto_id => $item) {
            
            \App\Models\PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $produto_id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'], 
            ]);

            $produto = \App\Models\Produto::find($produto_id);
            if ($produto) {

                $produto->decrement('estoque', $item['quantidade']); 
            }
        }
        
        session()->forget('carrinho');
        

        return view('carrinho.sucesso', compact('pedido'));
    }
}