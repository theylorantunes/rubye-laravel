@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-6xl">
    
    <div class="mb-16">
        <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Bem-vindo de volta') }}</h4>
        <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ Auth::user()->name }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        
        <div class="lg:col-span-1 border-r border-gray-100 pr-8 hidden md:block">
            <nav class="flex flex-col space-y-6 text-[13px] font-bold tracking-[0.15em] uppercase">
                <a href="{{ route('dashboard') }}" class="text-black border-b border-black w-max pb-1">{{ __('Visão Geral') }}</a>
                <a href="#" class="text-gray-400 hover:text-black transition-colors">{{ __('Meus Pedidos') }}</a>
                <a href="#" class="text-gray-400 hover:text-black transition-colors">{{ __('Endereços') }}</a>
                <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-black transition-colors">{{ __('Configurações') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="pt-8 mt-8 border-t border-gray-100">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors cursor-pointer flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Sair da Conta') }}
                    </button>
                </form>
            </nav>
        </div>

        <div class="lg:col-span-3">
            
            <div class="bg-gray-50 p-10 border border-gray-100 mb-8 flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-black uppercase tracking-widest text-black mb-6">{{ __('Resumo da Conta') }}</h2>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>{{ __('Nome') }}:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>{{ __('E-mail') }}:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>{{ __('Membro desde') }}:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-[11px] font-bold uppercase tracking-widest text-gray-400 hover:text-black underline underline-offset-4">
                    {{ __('Editar') }}
                </a>
            </div>

            <div class="border border-gray-100 p-10">
                <h2 class="text-xl font-black uppercase tracking-widest text-black mb-6">{{ __('Últimos Pedidos') }}</h2>
                
                <div class="flex flex-col items-center justify-center py-12 text-center bg-white">
                    <i class="fas fa-box-open text-4xl text-gray-200 mb-4"></i>
                    <p class="text-[12px] font-bold uppercase tracking-widest text-gray-400 mb-6">
                        {{ __('Você ainda não fez nenhum pedido.') }}
                    </p>
                    <a href="{{ route('home') }}" class="inline-block bg-black text-white px-8 py-4 text-xs font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors">
                        {{ __('Ir para a Loja') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection