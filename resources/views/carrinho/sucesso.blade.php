@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 py-32 flex flex-col items-center justify-center min-h-[60vh] text-center">
    
    <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mb-8 shadow-lg shadow-green-500/30">
        <i class="fas fa-check text-4xl text-white"></i>
    </div>

    <h1 class="text-5xl font-black uppercase tracking-tighter text-black mb-4">{{ __('Pedido Confirmado!') }}</h1>
    <p class="text-gray-500 max-w-md mx-auto mb-10 leading-relaxed">
        {{ __('Obrigado por comprar na RUBYE. O seu pedido fictício foi processado com sucesso e o carrinho foi esvaziado.') }}
    </p>

    <a href="{{ route('home') }}" class="border-b-2 border-black pb-1 font-bold text-sm uppercase tracking-widest hover:text-gray-500 hover:border-gray-500 transition-colors">
        {{ __('Voltar para a Home') }}
    </a>
</div>
@endsection