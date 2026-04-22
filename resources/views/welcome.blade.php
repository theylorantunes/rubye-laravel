@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 flex flex-col items-center text-center min-h-[60vh] justify-center">
    
    <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-4">{{ __('Nova Coleção') }}</h4>
    <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter text-black mb-8 leading-none">
        A Nova Era <br> do Básico
    </h1>
    
    <p class="text-gray-500 mb-12 max-w-lg mx-auto text-sm leading-relaxed">
        {{ __('Descubra a coleção Minimalist. Peças essenciais com design atemporal, algodão premium e caimento impecável para o seu dia a dia.') }}
    </p>
    
    <a href="{{ route('produtos.index') }}" class="bg-black text-white px-12 py-5 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-xl">
        {{ __('Explorar Produtos') }}
    </a>

</div>
@endsection