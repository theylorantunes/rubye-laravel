@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 py-16 md:py-24 max-w-2xl text-center">
    <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Pagamento Gerado') }}</h4>
    <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black mb-8">{{ __('Escaneie o QR Code') }}</h1>
    
    <p class="text-gray-500 font-medium text-sm md:text-base mb-10 leading-relaxed">
        {{ __('Abra o aplicativo do seu banco e escaneie o código abaixo para finalizar o pagamento do seu pedido') }} <strong class="text-black">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</strong>.
    </p>

    <div class="flex justify-center mb-10">
        <div class="p-4 bg-white border border-gray-200 shadow-sm inline-block">
            <img src="{{ $qrCodeBase64 }}" alt="QR Code PIX" class="w-64 h-64 object-contain">
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-200 p-6 flex flex-col items-center">
        <span class="text-[10px] font-black uppercase tracking-widest text-black mb-3">{{ __('Pix Copia e Cola') }}</span>
        <div class="w-full relative">
            <input type="text" value="{{ $copiaECola }}" id="pix-code" readonly 
                   class="w-full bg-white border border-gray-300 p-4 text-xs font-mono text-center focus:outline-none focus:border-black transition-colors cursor-pointer" 
                   onclick="this.select(); document.execCommand('copy'); alert('Código copiado!');">
        </div>
        <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400 mt-3">{{ __('Clique no código para copiar') }}</span>
    </div>

    <div class="mt-12 pt-8 border-t border-dashed border-gray-300">
        <div class="bg-black border border-gray-800 p-6 flex flex-col items-center text-left">
            <h3 class="text-xs font-black uppercase tracking-widest text-white mb-3">
                <i class="fas fa-code text-green-400 mr-2"></i> Ferramenta de Simulação (TCC)
            </h3>
            <p class="text-gray-400 text-[11px] font-medium normal-case mb-6 text-center">
                Para fins de demonstração acadêmica, clique no botão abaixo para simular o recebimento do Webhook da AbacatePay e aprovar o pedido instantaneamente.
            </p>
            <form action="{{ route('checkout.simular', $pedido->id) }}" method="POST" class="w-full m-0">
                @csrf
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-black py-4 text-xs font-black uppercase tracking-widest transition-colors shadow-sm border-none cursor-pointer">
                    Simular Pagamento Confirmado <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection