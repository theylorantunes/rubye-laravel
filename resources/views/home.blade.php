@extends('layouts.main')

@section('conteudo')
    <div class="relative w-full h-[600px] overflow-hidden bg-black" id="hero-carousel">
        
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100">
            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-60" alt="Coleção Minimalist">
        </div>
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="https://images.unsplash.com/photo-1434389678278-be43e4be2ab8?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-60" alt="Qualidade Premium">
        </div>
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-60" alt="Design Atemporal">
        </div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center z-10">
            <h4 class="text-xs text-gray-300 font-bold tracking-[0.2em] uppercase mb-4">{{ __('Nova Coleção') }}</h4>
            <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter text-white mb-8 leading-none">
                {{ __('A Nova Era do Básico') }}
            </h1>
            <a href="{{ route('produtos.index') }}" class="bg-white text-black px-10 py-4 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-200 transition-colors shadow-lg">
                {{ __('Explorar Coleção') }}
            </a>
        </div>
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('#hero-carousel .slide');
            
            if(slides.length > 1) {
                setInterval(() => {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');
                    
                    currentSlide = (currentSlide + 1) % slides.length;
                    
                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                }, 4000);
            }
        });
    </script>

@endsection