@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-6xl">
    
    <div class="text-center mb-16">
        <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Linhas Exclusivas') }}</h4>
        <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ __('Coleções') }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($categorias as $categoria)
            <a href="#" class="group relative block aspect-[4/3] overflow-hidden bg-gray-200">
                
                <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?q=80&w=800&auto=format&fit=crop" 
                     alt="{{ $categoria->nome }}" 
                     class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
                
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-500"></div>

                <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                    <h2 class="text-3xl md:text-4xl font-black uppercase tracking-widest mb-4">
                        {{ $categoria->nome }}
                    </h2>
                    <span class="text-xs font-bold tracking-[0.3em] uppercase border-b border-white pb-1 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                        {{ __('Explorar') }}
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full py-24 text-center">
                <p class="text-gray-400 uppercase tracking-widest font-bold text-sm">{{ __('Nenhuma coleção cadastrada.') }}</p>
            </div>
        @endforelse
    </div>

</div>
@endsection