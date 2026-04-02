@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-[120px] pb-24 max-w-5xl">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
        
        <div class="w-full">
            <div class="relative bg-gray-300 w-full aspect-square flex items-center justify-center p-8 overflow-hidden">
                
                <button class="absolute left-4 bg-black/10 hover:bg-black/20 rounded-full w-8 h-8 flex items-center justify-center transition cursor-pointer z-10">
                    <i class="fas fa-chevron-left text-gray-700 text-sm"></i>
                </button>

                <img src="https://classofficial.com.br/cdn/shop/files/12631_2.jpg?v=1773075157&width=713" 
                     alt="{{ $produto->nome }}" 
                     class="max-w-full max-h-full object-contain mix-blend-multiply drop-shadow-lg">

                <button class="absolute right-4 bg-black/10 hover:bg-black/20 rounded-full w-8 h-8 flex items-center justify-center transition cursor-pointer z-10">
                    <i class="fas fa-chevron-right text-gray-700 text-sm"></i>
                </button>

                <div class="absolute bottom-6 flex space-x-2">
                    <span class="w-2.5 h-2.5 bg-white rounded-full shadow-sm"></span>
                    <span class="w-2.5 h-2.5 bg-white/50 rounded-full shadow-sm"></span>
                    <span class="w-2.5 h-2.5 bg-white/50 rounded-full shadow-sm"></span>
                </div>
            </div>
        </div>

        <div class="w-full flex flex-col">
            
            <p class="text-[13px] text-gray-400 font-bold tracking-[0.15em] uppercase mb-2">
                {{ $produto->categoria->nome ?? __('Sem Categoria') }}
            </p>
            
            <h1 class="text-[36px] font-black uppercase tracking-tight text-black leading-tight mb-6">
                {{ $produto->nome }}
            </h1>
            
            <p class="text-[26px] font-medium text-gray-800 mb-8">
                R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </p>

            <hr class="border-gray-200 mb-6">

            <div class="text-[15px] text-gray-600 mb-6 leading-relaxed">
                {{ $produto->descricao }}
            </div>

            <hr class="border-gray-200 mb-8">

            <div class="mb-8">
                <label class="block text-sm text-gray-500 mb-2">{{ __('Quantidade:') }}</label>
                <input type="number" value="1" min="1" max="{{ $produto->quantidade_estoque }}" 
                       class="w-24 border border-gray-200 p-2.5 text-center text-[15px] focus:outline-none focus:border-black transition-colors">
            </div>

            <button class="w-full bg-black text-white py-4 text-[13px] font-bold tracking-[0.15em] uppercase hover:bg-gray-800 transition-colors cursor-pointer shadow-md">
                {{ __('Adicionar ao Carrinho') }}
            </button>
            
        </div>

    </div>
</div>
@endsection