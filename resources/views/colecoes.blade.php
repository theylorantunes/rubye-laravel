@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 pt-12 md:pt-24 pb-16 md:pb-24 max-w-6xl">
    
    <div class="text-center mb-10 md:text-center md:mb-16">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-1.5 md:mb-2">{{ __('Linhas Exclusivas') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black leading-none">{{ __('Coleções') }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
        @forelse($colecoes as $colecao)
            <a href="{{ route('produtos.index', ['colecao' => $colecao->id]) }}" class="group relative block aspect-[1/1] md:aspect-[4/3] overflow-hidden bg-gray-200 transition-transform active:scale-[0.99]">
                
                <img src="{{ $colecao->imagem ? $colecao->imagem : 'https://images.unsplash.com/photo-1617137968427-85924c800a22?q=80&w=800' }}" 
                    alt="{{ $colecao->nome }}" 
                    class="w-full h-full object-cover grayscale md:group-hover:grayscale-0 md:group-hover:scale-105 transition-all duration-700 ease-out">
                
                <div class="absolute inset-0 bg-black/40 md:bg-black/30 md:group-hover:bg-black/40 transition-colors duration-500"></div>

                <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-4">
                    <h2 class="text-2xl md:text-4xl font-black uppercase tracking-widest mb-1 md:mb-2 px-2">
                        {{ $colecao->nome }}
                    </h2>
                    
                    @if($colecao->descricao)
                        <p class="text-[9px] md:text-[10px] uppercase tracking-widest mb-4 opacity-80 font-bold px-4 max-w-xs leading-relaxed">
                            {{ $colecao->descricao }}
                        </p>
                    @endif

                    <span class="text-[10px] md:text-xs font-bold tracking-[0.3em] uppercase border-b border-white pb-1 opacity-90 md:opacity-0 md:translate-y-4 md:group-hover:opacity-100 md:group-hover:translate-y-0 transition-all duration-500">
                        {{ __('Explorar') }}
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full py-16 text-center bg-gray-50 border">
                <p class="text-gray-400 uppercase tracking-widest font-bold text-xs">{{ __('Nenhuma coleção cadastrada.') }}</p>
            </div>
        @endforelse
    </div>

</div>
@endsection