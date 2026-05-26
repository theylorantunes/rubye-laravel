<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PagamentoController extends Controller
{
    public function gerarCheckout(Request $request)
    {
        $pedido = \App\Models\Pedido::where('user_id', auth()->id())
                                    ->where('status', 'Pedido Recebido')
                                    ->latest()
                                    ->first();

        $totalCarrinho = 0;

        if ($pedido) {
            $totalCarrinho = $pedido->total;
        } else {
            $itensCarrinho = session()->get('carrinho') ?? session()->get('cart') ?? [];

            if (!empty($itensCarrinho)) {
                foreach ($itensCarrinho as $item) {
                    $qtd = $item['quantidade'] ?? $item['qtd'] ?? 1;
                    $preco = $item['preco'] ?? $item['preco_unitario'] ?? $item['price'] ?? 0;
                    $totalCarrinho += ($qtd * $preco);
                }
            }

            if ($totalCarrinho > 0) {
                $pedido = \App\Models\Pedido::create([
                    'user_id' => auth()->id(),
                    'total' => $totalCarrinho,
                    'status' => 'Pedido Recebido',
                ]);
            }
        }

        


        if ($totalCarrinho <= 0 || !$pedido) {
            return back()->with('error', 'Seu carrinho está vazio ou não foi encontrado.');
        }

        if ($pedido->total <= 0) {
            $pedido->total = $totalCarrinho;
        }
        $cliente = Http::withToken(env('ABACATEPAY_API_KEY'));

        if (app()->environment('local')) {
            $cliente->withoutVerifying();
        }

        $response = $cliente->post('https://api.abacatepay.com/v2/transparents/create', [
            'method' => 'PIX',
            'data' => [
                'amount' => $pedido->total * 100,
                'description' => 'Pedido TCC RUBYE #' . $pedido->id,
                'customer' => [
                    'name' => auth()->user()->name ?? 'Cliente Teste',
                    'email' => auth()->user()->email ?? 'teste@rubye.com',
                    'taxId' => '47475423026',
                    'cellphone' => '(11) 99999-9999'
                ]
            ]
        ]);

        if (!$response->successful()) {
            dd('A API do AbacatePay rejeitou a requisição:', $response->status(), $response->json());
        }

        if ($response->successful()) {
            $dadosPix = $response->json('data') ?? $response->json();

            $pedido->update([
                'status' => 'Pagamento em Análise'
            ]);

            session()->forget('carrinho');
            session()->forget('cart');

            return view('pagamento', ['pix' => $dadosPix]);
        }

        return back()->with('error', 'Erro inesperado ao gerar o PIX.');
    }

    public function simular(Request $request, $id)
    {
        $pedido = \App\Models\Pedido::where('user_id', auth()->id())
                                    ->where('status', 'Pagamento em Análise')
                                    ->latest()
                                    ->first();

        if ($pedido) {
            $pedido->update([
                'status' => 'Pagamento Confirmado'
            ]);
            
            return redirect()->route('checkout.sucesso')->with('success', 'Pagamento simulado com sucesso!');
        }

        return redirect()->route('home')->with('error', 'Pedido não encontrado para simulação.');
    }
}