@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24">
    
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
            <a href="{{ route('produto.show', $produto->id) }}" class="group">
                <div class="relative bg-gray-100 aspect-[3/4] overflow-hidden mb-6 flex items-center justify-center p-8">
                    <img src="{{ $produto->imagem ?? 'https://dummyimage.com/600x800/cccccc/333333.png&text=RUBYE' }}" 
                         alt="{{ $produto->nome }}" 
                         class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    
                    @if($produto->quantidade_estoque <= 0)
                        <div class="absolute inset-0 bg-white/60 flex items-center justify-center">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase bg-black text-white px-4 py-2">Sold Out</span>
                        </div>
                    @endif
                </div>
                
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-[13px] font-bold uppercase tracking-tight text-black mb-1 group-hover:underline">
                            {{ $produto->nome }}
                        </h3>
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">
                            {{ $produto->categoria->nome ?? 'Uncategorized' }}
                        </p>
                    </div>
                    <p class="text-[13px] font-medium text-gray-900">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>
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