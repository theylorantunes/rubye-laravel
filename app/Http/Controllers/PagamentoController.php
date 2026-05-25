<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class PagamentoController extends Controller
{
    public function gerarCheckout(Request $request)
    {
        $valorFixo = 150.00;

        $cliente = Http::withToken(env('ABACATEPAY_API_KEY'));

        if (app()->environment('local')) {
            $cliente->withoutVerifying();
        }


        $response = $cliente->post('https://api.abacatepay.com/v2/transparents/create', [
            'method' => 'PIX',
            'data' => [
                'amount' => $valorFixo * 100, // 15000 centavos
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