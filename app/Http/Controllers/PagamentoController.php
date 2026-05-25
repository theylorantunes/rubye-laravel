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
                                    ->where('status', 'pedido recebido')
                                    ->latest()
                                    ->first();

        if (!$pedido) {
            return back()->with('error', 'Nenhum carrinho em andamento.');
        }

        $totalCarrinho = $pedido->itens->sum(function($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        $cliente = Http::withToken(env('ABACATEPAY_API_KEY'));

        if (app()->environment('local')) {
            $cliente->withoutVerifying();
        }


        $response = $cliente->post('https://api.abacatepay.com/v2/transparents/create', [
            'method' => 'PIX',
            'data' => [
                'amount' => $totalCarrinho * 100, // Convertendo para centavos
                'description' => 'Pedido TCC RUBYE',
                'customer' => [
                    'name' => auth()->user()->name ?? 'Cliente Teste',
                    'email' => auth()->user()->email ?? 'teste@rubye.com',
                    'taxId' => '564.034.148-36',
                    'cellphone' => '(11) 99999-9999'
                ]
            ]
        ]);

        if ($response->successful() && $response->json('success') === true) {
            $dadosPix = $response->json('data');
            

            return view('pagamento', ['pix' => $dadosPix]);
        }

        return back()->with('error', 'Erro ao gerar o PIX.');
    }

    public function simular($id)
    {
        $cliente = Http::withToken(env('ABACATEPAY_API_KEY'));

        if (app()->environment('local')) {
            $cliente->withoutVerifying();
        }


        $response = $cliente->post('https://api.abacatepay.com/v2/transparents/simulate-payment?id=' . $id);

        if ($response->successful() && $response->json('success') === true) {
            return redirect()->route('checkout.sucesso');
        }

        return back()->with('error', 'Erro ao simular o pagamento.');
    }
}