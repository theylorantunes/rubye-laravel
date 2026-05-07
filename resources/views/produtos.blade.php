@extends('layouts.main')

@section('conteudo')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="container mx-auto px-8 lg:px-12 max-w-7xl pt-16 pb-24">

    <div class="mb-12">
        <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Shop All') }}</h4>
        <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ __('Produtos') }}</h1>
    </div>

    <div class="w-full border-b border-gray-100 mb-16">
        <div class="swiper swiper-categorias overflow-hidden">
            <div class="swiper-wrapper flex items-center py-4">
                
                <div class="swiper-slide !w-auto mr-10">
                    <a href="{{ route('produtos.index') }}" 
                       class="text-[10px] font-black uppercase tracking-[0.3em] {{ !request('categoria') ? 'text-black border-b-2 border-black' : 'text-gray-400' }} pb-3 transition-all inline-block">
                        {{ __('All') }}
                    </a>
                </div>
                
                @foreach($categorias as $cat)
                    <div class="swiper-slide !w-auto mr-10">
                        <a href="{{ route('produtos.index', ['categoria' => $cat->id]) }}" 
                           class="text-[10px] font-black uppercase tracking-[0.3em] {{ request('categoria') == $cat->id ? 'text-black border-b-2 border-black' : 'text-gray-400' }} pb-3 transition-all hover:text-black inline-block">
                            {{ $cat->nome }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- GRID DE PRODUTOS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">

        @if(request()->filled('busca'))
            <div class="col-span-full mb-8 border-l-2 border-black pl-4">
                <p class="text-sm text-gray-500 uppercase font-bold tracking-widest">
                    {{ __('Resultados para') }}: <span class="text-black">{{ request('busca') }}</span>
                </p>
            </div>
        @endif
        
        @forelse($produtos as $produto)
        <a href="{{ route('produto.show', $produto->id) }}" class="group flex flex-col">
            
            <div class="relative bg-gray-100 aspect-[4/5] flex items-center justify-center p-8 overflow-hidden mb-6">
                {{-- Correção da Imagem: Usando asset() para evitar fotos quebradas --}}
                <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" 
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
                <a href="{{ route('produtos.index') }}" class="border-b-2 border-black pb-1 font-bold text-[11px] uppercase tracking-widest mt-4 inline-block">
                    {{ __('Ver todos os produtos') }}
                </a>
            </div>
        @endforelse
    </div>
</div>

{{-- Scripts do Swiper --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiperCat = new Swiper('.swiper-categorias', {
            slidesPerView: 'auto', 
            spaceBetween: 0,
            freeMode: true, 
            mousewheel: {
                forceToAxis: true,
            },
            watchSlidesProgress: true,
        });
    });
</script>
@endsection