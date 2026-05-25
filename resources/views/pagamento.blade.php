@extends('layouts.main')

@section('conteudo')
     <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-lg shadow-md text-center">
        <h2 class="text-2xl font-bold mb-4">Pagamento via PIX</h2>
        <p class="text-gray-600 mb-6">Escaneie o QR Code abaixo pelo aplicativo do seu banco:</p>

        <div class="flex justify-center mb-6">
            <img src="{{ $pix['brCodeBase64'] }}" alt="QR Code PIX" class="w-64 h-64 border p-2 rounded-md">
        </div>

        <div class="mb-6">
            <p class="font-semibold mb-2">Ou use o Pix Copia e Cola:</p>
            <input type="text" value="{{ $pix['brCode'] }}" readonly 
                   class="w-full p-2 border rounded text-sm text-gray-500 bg-gray-50 text-center"
                   onclick="this.select(); document.execCommand('copy'); alert('Copiado!')">
        </div>

        <form action="/checkout/simular/{{ $pix['id'] }}" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="w-full bg-green-800 text-black px-4 py-3 rounded-md font-bold hover:bg-green-700">
                Simular Pagamento (Apenas TCC)
            </button>
        </form>
    </div>
@endsection
