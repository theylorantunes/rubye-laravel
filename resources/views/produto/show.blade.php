@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 pt-6 md:pt-16 pb-24 max-w-5xl">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-20 items-center">
        
        <div class="bg-gray-100 aspect-square md:aspect-[4/5] flex items-center justify-center p-6 md:p-12 overflow-hidden relative group">
            <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" class="w-4/5 h-4/5 md:w-full md:h-full object-contain mix-blend-multiply drop-shadow-xl">
        </div>

        <div class="flex flex-col">
            
            <nav class="flex mb-4 text-[10px] md:text-[11px] uppercase tracking-widest font-bold text-gray-400">
                <a href="{{ route('produtos.index') }}" class="hover:text-black transition-colors">{{ __('Produtos') }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $produto->categoria->nome ?? __('Sem Categoria') }}</span>
            </nav>

            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black leading-tight mb-4 md:mb-6">
                {{ $produto->nome }}
            </h1>

            <p class="text-2xl md:text-3xl font-medium text-gray-900 mb-6 md:mb-8">
                R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </p>

            <div class="border-t border-b border-gray-100 py-6 mb-8">
                <p class="text-gray-600 leading-relaxed text-sm md:text-[15px]">
                    {{ $produto->descricao }}
                </p>
            </div>

            <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="space-y-6 md:space-y-8">
                @csrf
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    
                    <div class="w-full sm:w-24">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 text-left sm:text-center">{{ __('Quantidade') }}</label>
                        @php
                            $maxQtd = min(5, $produto->estoque > 0 ? $produto->estoque : 1);
                        @endphp
                        <input type="number" name="whitespace_fix" value="1" class="hidden">
                        <input type="number" name="quantidade" value="1" min="1" max="{{ $maxQtd }}"
                               {{ $produto->estoque <= 0 ? 'disabled' : '' }}
                               class="w-full border border-gray-300 py-4 text-center text-sm font-bold focus:outline-none focus:border-black transition-colors bg-transparent disabled:bg-gray-50 disabled:text-gray-400 h-12 md:h-auto rounded-none">
                    </div>
                    
                    <div class="flex-1">
                        @auth
                            @if($produto->estoque > 0)
                                <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-lg h-12 md:h-auto active:scale-[0.99] cursor-pointer">
                                    {{ __('Adicionar ao Carrinho') }}
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-gray-200 text-gray-400 py-4 text-xs font-black uppercase tracking-widest cursor-not-allowed h-12 md:h-auto">
                                    {{ __('Esgotado') }}
                                </button>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="flex items-center justify-center w-full border border-black text-black py-4 text-xs font-black tracking-[0.2em] uppercase hover:bg-black hover:text-white transition-colors h-12 md:h-auto">
                                <i class="fas fa-lock mr-2 text-xs"></i> {{ __('Entrar para Comprar') }}
                            </a>
                        @endguest
                    </div>
                    
                </div>
                
                @if($produto->estoque <= 5 && $produto->estoque > 0)
                    <p class="text-[10px] font-black text-red-500 tracking-widest uppercase text-center sm:text-left">
                        ⚠️ {{ __('Restam apenas') }} {{ $produto->estoque }} {{ __('unidades em estoque!') }}
                    </p>
                @endif
            </form>
            
        </div>
    </div>
</div>
@endsection