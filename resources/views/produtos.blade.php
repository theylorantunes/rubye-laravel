@extends('layouts.main')

@section('conteudo')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="container mx-auto px-4 md:px-8 max-w-7xl pt-10 md:pt-16 pb-24">

    <div class="text-center mb-8 md:text-center">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-1">{{ $titulo ?? 'Linha Completa' }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black leading-none">{{ $subtitulo ?? 'Produtos' }}</h1>
    </div>

    <div class="w-full border-b border-gray-100 mb-10 md:mb-16">
        <div class="swiper swiper-categorias overflow-hidden">
            <div class="swiper-wrapper flex items-center py-3">
                
                <div class="swiper-slide !w-auto mr-6 md:mr-10">
                    <a href="{{ route('produtos.index') }}" 
                       class="text-[10px] font-black uppercase tracking-[0.2em] {{ !request('categoria') ? 'text-black border-b-2 border-black font-black' : 'text-gray-400' }} pb-2 transition-all inline-block">
                        {{ __('Todos') }}
                    </a>
                </div>
                
                @foreach($categorias as $cat)
                    <div class="swiper-slide !w-auto mr-6 md:mr-10">
                        <a href="{{ route('produtos.index', ['categoria' => $cat->id]) }}" 
                           class="text-[10px] font-black uppercase tracking-[0.2em] {{ request('categoria') == $cat->id ? 'text-black border-b-2 border-black font-black' : 'text-gray-400' }} pb-2 transition-all hover:text-black inline-block">
                            {{ $cat->nome }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 md:gap-x-8 gap-y-10 md:gap-y-16">

        @if(request()->filled('busca'))
            <div class="col-span-full mb-4 border-l-2 border-black pl-3">
                <p class="text-[11px] md:text-sm text-gray-500 uppercase font-bold tracking-widest">
                    {{ __('Resultados para') }}: <span class="text-black">"{{ request('busca') }}"</span>
                </p>
            </div>
        @endif
        
        @forelse($produtos as $produto)
        <a href="{{ route('produto.show', $produto->id) }}" class="group flex flex-col transition-transform active:scale-[0.99]">
            
            <div class="relative bg-gray-100 aspect-[4/5] flex items-center justify-center p-4 md:p-8 overflow-hidden mb-4">
                <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" 
                    class="object-contain w-full h-full mix-blend-multiply group-hover:scale-105 transition-transform duration-700 ease-out">

                <div class="absolute top-2 right-2 md:top-4 md:right-4 z-10">
                    @if($produto->estoque > 0)
                        <span class="text-[8px] md:text-[9px] font-black text-green-600 uppercase tracking-widest bg-white/90 px-2 py-1 md:px-3 md:py-1.5 shadow-sm">
                            {{ __('Estoque') }}
                        </span>
                    @else
                        <span class="text-[8px] md:text-[9px] font-black text-red-500 uppercase tracking-widest bg-white/90 px-2 py-1 md:px-3 md:py-1.5 shadow-sm">
                            {{ __('Esgotado') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between items-start gap-1 md:gap-4">
                <div class="pr-2 w-full">
                    <h2 class="text-[11px] md:text-[13px] font-black uppercase tracking-wider text-black line-clamp-1 leading-tight mb-0.5">
                        {{ $produto->nome }}
                    </h2>
                    <p class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">
                        {{ $produto->categoria->nome ?? __('Geral') }}
                    </p>
                </div>
                <span class="text-[12px] md:text-[14px] font-bold text-gray-900 whitespace-nowrap mt-1 md:mt-0">
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </span>
            </div>
        </a>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-gray-400 uppercase tracking-widest font-bold text-xs">{{ __('Nenhum produto encontrado.') }}</p>
                <a href="{{ route('produtos.index') }}" class="border-b-2 border-black pb-1 font-bold text-[10px] uppercase tracking-widest mt-4 inline-block">
                    {{ __('Ver todos os produtos') }}
                </a>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.swiper-categorias', {
            slidesPerView: 'auto', 
            spaceBetween: 0,
            freeMode: true, 
            watchSlidesProgress: true,
        });
    });
</script>
@endsection