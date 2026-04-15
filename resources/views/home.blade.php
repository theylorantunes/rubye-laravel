@extends('layouts.main')

@section('conteudo')
    <div class="w-full h-[50vh] md:h-[70vh] bg-black relative">
        <img src="https://placehold.co/1920x800/222/555?text=BANNER+RUBYE" alt="Campanha Rubye" class="w-full h-full object-cover opacity-90">
    </div>

    <div class="container mx-auto px-4 mt-20 max-w-5xl">
        
        <h2 class="text-3xl font-black text-center mb-16 tracking-[0.2em] uppercase text-black">{{ __('Destaques') }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-16">
            
            @if($produtos->isEmpty())
                <p class="text-center col-span-2 text-gray-500 py-10">Nenhum produto em destaque no momento.</p>
            @else
                @foreach($produtos as $produto)
                    <a href="/produto/{{ $produto->id }}" class="group block cursor-pointer">
                        
                        <div class="bg-[#F6F6F6] aspect-square flex items-center justify-center mb-5 relative overflow-hidden">
                            <img src="{{ $produto->imagem ?? 'https://placehold.co/500x500/transparent/333?text=CAMISETA' }}" 
                                 alt="{{ $produto->nome }}" 
                                 class="w-[85%] h-[85%] object-contain group-hover:scale-105 transition-transform duration-700 ease-out">
                        </div>
                        
                        <h3 class="text-[15px] font-bold uppercase tracking-wider text-black mb-2">{{ $produto->nome }}</h3>
                        <p class="text-[14px] text-gray-500 font-medium">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                    </a>
                @endforeach
            @endif

        </div>

        <div class="flex justify-center mt-20">
            <a href="/produtos" class="border border-black px-14 py-4 text-xs font-bold tracking-[0.2em] uppercase text-black hover:bg-black hover:text-white transition-colors duration-300">
                {{ __('Ver tudo') }}
            </a>
        </div>

    </div>
@endsection