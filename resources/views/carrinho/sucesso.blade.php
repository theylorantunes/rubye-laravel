@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 py-16 md:py-32 flex flex-col items-center justify-center min-h-[60vh] text-center max-w-md">
    
    <div class="w-16 h-16 md:w-24 md:h-24 bg-green-500 rounded-full flex items-center justify-center mb-6 md:mb-8 shadow-lg shadow-green-500/20 animate-bounce">
        <i class="fas fa-check text-2xl md:text-4xl text-white"></i>
    </div>

    <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter text-black mb-3 md:mb-4">
        {{ __('Pedido Confirmado!') }}
    </h1>
    
    <p class="text-gray-500 text-xs md:text-sm mb-8 md:mb-10 leading-relaxed px-2">
        {{ __('Obrigado por comprar na RUBYE. O seu pedido fictício foi processado com sucesso e o carrinho foi esvaziado.') }}
    </p>

    <a href="{{ route('home') }}" class="border-b-2 border-black pb-1 font-black text-xs uppercase tracking-widest hover:text-gray-500 hover:border-gray-500 transition-colors">
        {{ __('Voltar para a Home') }}
    </a>
</div>
@endsection