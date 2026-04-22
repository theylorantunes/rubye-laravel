@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-8 lg:px-12 max-w-7xl pt-16 pb-24">
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
        <div>
            <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Shop All') }}</h4>
            <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ __('Produtos') }}</h1>
        </div>
        
        <div class="flex space-x-8 text-xs font-bold uppercase tracking-widest text-gray-400">
            <span class="text-black border-b-2 border-black pb-1 cursor-pointer">{{ __('Todos') }}</span>
            <span class="hover:text-black transition-colors cursor-pointer">{{ __('Camisetas') }}</span>
            <span class="hover:text-black transition-colors cursor-pointer">{{ __('Acessórios') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
        @forelse($produtos as $produto)
        <a href="{{ route('produto.show', $produto->id) }}" class="group flex flex-col">
            
            <div class="relative bg-gray-100 aspect-[4/5] flex items-center justify-center p-8 overflow-hidden mb-6">
                <img src="{{ $produto->imagem }}" alt="{{ $produto->nome }}" 
                    class="object-contain w-full h-full mix-blend-multiply group-hover:scale-105 transition-transform duration-700">

                <div class="absolute top-4 right-4 z-10">
                    @if($produto->estoque > 0)
                        <span class="text-[9px] font-black text-green-600 uppercase tracking-widest bg-white/90 px-3 py-1.5 shadow-sm">
                            {{ __('Em Estoque') }}
                        </span>
                    @else
                        <span class="text-[9px] font-black text-red-500 uppercase tracking-widest bg-white/90 px-3 py-1.5 shadow-sm">
                            {{ __('Esgotado') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex justify-between items-start">
                <div class="pr-4">
                    <h2 class="text-[13px] font-black uppercase tracking-widest text-black mb-1 leading-tight">
                        {{ $produto->nome }}
                    </h2>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">
                        {{ $produto->categoria->nome ?? __('Geral') }}
                    </p>
                </div>
                <span class="text-[14px] font-medium text-gray-900 whitespace-nowrap">
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </span>
            </div>
        </a>
        @empty
            <div class="col-span-full py-24 text-center">
                <p class="text-gray-400 uppercase tracking-widest font-bold text-sm">{{ __('Nenhum produto encontrado.') }}</p>
            </div>
        @endforelse
    </div>
</div>
@endsection