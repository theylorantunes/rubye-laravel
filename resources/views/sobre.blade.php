@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-6xl">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="w-full relative">
            <div class="aspect-[4/5] bg-gray-200 w-full overflow-hidden">
                <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?q=80&w=1000&auto=format&fit=crop" 
                     alt="Conceito Rubye" 
                     class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
            </div>
            <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-black -z-10 hidden md:block"></div>
        </div>

        <div class="w-full flex flex-col">
            <h4 class="text-sm text-gray-400 font-bold tracking-[0.2em] uppercase mb-4">{{ __('Nossa Essência') }}</h4>
            <h1 class="text-5xl font-black uppercase tracking-tight text-black leading-none mb-8">
                Construindo<br>o novo padrão.
            </h1>
            
            <div class="text-gray-600 text-[16px] leading-relaxed space-y-6 mb-10">
                <p>
                    {{ __('A RUBYE nasceu da necessidade de alinhar o minimalismo urbano com a mais alta qualidade de construção. Não somos apenas uma marca de roupas, somos uma estética de vida.') }}
                </p>
                <p>
                    {{ __('Cada peça é meticulosamente pensada para oferecer caimento perfeito, durabilidade extrema e um design que sobrevive às tendências passageiras.') }}
                </p>
            </div>

            <a href="{{ route('home') }}" class="inline-block bg-black text-white px-8 py-4 text-sm font-bold tracking-[0.15em] uppercase hover:bg-gray-800 transition-colors w-max">
                {{ __('Ver Coleção') }}
            </a>
        </div>
    </div>

</div>
@endsection