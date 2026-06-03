@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 py-16 md:py-24 max-w-2xl text-center">
    <div class="mb-8 flex justify-center">
        <div class="w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center text-white text-4xl shadow-lg">
            <i class="fas fa-check"></i>
        </div>
    </div>
    
    <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Muito Obrigado!') }}</h4>
    <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black mb-6">{{ __('Pagamento Confirmado') }}</h1>
    
    <p class="text-gray-500 font-medium text-sm md:text-base mb-10 leading-relaxed">
        {{ __('Seu pedido foi processado com sucesso. Você receberá as atualizações de envio no seu e-mail e na central de notificações do perfil.') }}
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('profile.pedidos') }}" class="bg-black text-white px-8 py-4 text-[10px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm">
            {{ __('Ver Meus Pedidos') }}
        </a>
        <a href="{{ route('produtos.index') }}" class="bg-white border border-black text-black px-8 py-4 text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-colors">
            {{ __('Continuar Comprando') }}
        </a>
    </div>
</div>
@endsection