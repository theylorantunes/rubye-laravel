<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;

class PagamentoController extends Controller
{
    public function gerarCheckout(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) return redirect()->route('produtos.index');

        $cpfLimpo = preg_replace('/\D/', '', $request->input('cpf'));
        $telefoneLimpo = preg_replace('/\D/', '', $request->input('telefone'));
        
        $metodoFrontend = $request->input('metodo_pagamento');
        $metodoApi = $metodoFrontend === 'CREDIT_CARD' ? 'CARD' : $metodoFrontend;

        $totalCarrinho = 0;
        foreach ($carrinho as $id => $item) {
            $totalCarrinho += $item['preco'] * $item['quantidade'];
        }

        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'total' => $totalCarrinho,
            'status' => 'Pedido Recebido', 
        ]);

        foreach ($carrinho as $id => $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
            ]);
            $produto = Produto::find($id);
            if ($produto) $produto->decrement('estoque', $item['quantidade']);
        }


        if ($metodoFrontend === 'PIX') {


            $response = Http::withoutVerifying()
                ->withToken(env('ABACATEPAY_API_KEY'))
                ->post('https://api.abacatepay.com/v2/transparents/create', [
                    'method' => 'PIX',
                    'data' => [
                        'amount' => (int) round($totalCarrinho * 100),
                        'externalId' => (string) $pedido->id,
                        'customer' => [
                            'name' => $request->input('nome'),
                            'email' => $request->input('email'),
                            'taxId' => $cpfLimpo,
                            'cellphone' => $telefoneLimpo,
                        ]
                    ]
                ]);

            if ($response->successful()) {
                session()->forget('carrinho');
                $dados = $response->json();
                
                return view('carrinho.pix', [
                    'qrCodeBase64' => $dados['data']['brCodeBase64'],
                    'copiaECola' => $dados['data']['brCode'],
                    'pedido' => $pedido
                ]);
            } else {
                $pedido->update(['status' => 'Cancelado']);
                dd(['ERRO_API_PIX_V2' => $response->json()]);
            }

        } else {
            

            $produtoAbacate = Http::withoutVerifying()
                ->withToken(env('ABACATEPAY_API_KEY'))
                ->post('https://api.abacatepay.com/v2/products/create', [
                    'externalId' => 'pedido-' . $pedido->id,
                    'name' => 'Pedido #' . str_pad($pedido->id, 5, '0', STR_PAD_LEFT) . ' - RUBYE Store',
                    'price' => (int) round($totalCarrinho * 100),
                    'currency' => 'BRL',
                    'description' => 'Compra na RUBYE Store contendo ' . count($carrinho) . ' item(ns).'
                ]);

            if ($produtoAbacate->successful()) {
                

                $idProdutoCriado = $produtoAbacate->json()['data']['id'];

                $response = Http::withoutVerifying()
                    ->withToken(env('ABACATEPAY_API_KEY'))
                    ->post('https://api.abacatepay.com/v2/checkouts/create', [
                        'frequency' => 'ONE_TIME',
                        'methods' => [$metodoApi],
                        'items' => [
                            [
                                'id' => $idProdutoCriado,
                                'quantity' => 1
                            ]
                        ], 
                        'returnUrl' => route('checkout.sucesso'),
                        'completionUrl' => route('checkout.sucesso'),
                        'customer' => [
                            'name' => $request->input('nome'),
                            'email' => $request->input('email'),
                            'taxId' => $cpfLimpo,
                            'cellphone' => $telefoneLimpo,
                        ]
                    ]);

                if ($response->successful()) {
                    session()->forget('carrinho');
                    $dados = $response->json();
                    return redirect()->away($dados['data']['url']);
                } else {
                    $pedido->update(['status' => 'Cancelado']);
                    dd(['ERRO_GERAR_LINK_V2' => $response->json()]);
                }

            } else {
                $pedido->update(['status' => 'Cancelado']);
                dd(['ERRO_CRIAR_PRODUTO_V2' => $produtoAbacate->json()]);
            }
        }
    }

    public function simular($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => 'Pagamento Confirmado']);
        return redirect()->route('checkout.sucesso');
    }
}