@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-6xl">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">
        
        <div class="bg-gray-100 aspect-[4/5] flex items-center justify-center p-12 overflow-hidden relative group">
            <img src="{{ $produto->imagem }}" alt="{{ $produto->nome }}" class="w-full h-full object-contain mix-blend-multiply drop-shadow-xl group-hover:scale-105 transition-transform duration-700">
        </div>

        <div class="flex flex-col">
            
            <nav class="flex mb-6 text-[11px] uppercase tracking-widest font-bold text-gray-400">
                <a href="{{ route('produtos.index') }}" class="hover:text-black transition-colors">{{ __('Produtos') }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $produto->categoria->nome ?? __('Sem Categoria') }}</span>
            </nav>

            <h1 class="text-5xl font-black uppercase tracking-tighter text-black leading-none mb-6">
                {{ $produto->nome }}
            </h1>

            <p class="text-3xl font-medium text-gray-900 mb-8">
                R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </p>

            <div class="border-t border-b border-gray-100 py-8 mb-10">
                <p class="text-gray-600 leading-relaxed text-[15px]">
                    {{ $produto->descricao }}
                </p>
            </div>

            <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="space-y-8">
                @csrf
                <div class="flex items-center space-x-4">
                    
                    <div class="w-24">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">{{ __('Qtd') }}</label>
                        <input type="number" name="quantidade" value="1" min="1" max="{{ $produto->quantidade_estoque }}"
                               class="w-full border border-gray-300 py-4 text-center text-sm focus:outline-none focus:border-black transition-colors bg-transparent">
                    </div>
                    
                    <div class="flex-1 pt-6">
                        @auth
                            <button type="submit" class="w-full bg-black text-white py-4 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-lg">
                                {{ __('Adicionar ao Carrinho') }}
                            </button>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="flex items-center justify-center w-full border-2 border-black text-black py-4 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-black hover:text-white transition-colors">
                                <i class="fas fa-lock mr-2"></i> {{ __('Faça Login para Comprar') }}
                            </a>
                        @endguest
                    </div>
                    
                </div>
                
                @if($produto->quantidade_estoque <= 5 && $produto->quantidade_estoque > 0)
                    <p class="text-xs font-bold text-red-500 tracking-widest uppercase mt-4">
                        {{ __('Restam apenas') }} {{ $produto->quantidade_estoque }} {{ __('unidades!') }}
                    </p>
                @elseif($produto->quantidade_estoque <= 0)
                    <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mt-4">
                        {{ __('Esgotado') }}
                    </p>
                @endif
            </form>
            
        </div>
    </div>
</div>
@endsection