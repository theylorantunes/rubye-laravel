@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-5xl">
    <div class="mb-10 md:mb-12">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Minha Conta') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black">{{ __('Configurações') }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Menu Lateral Unificado e Dinâmico -->
        <div class="lg:col-span-1 border-b lg:border-b-0 lg:border-r border-gray-100 pb-6 lg:pb-0 lg:pr-6">
            <nav class="flex lg:flex-col gap-4 lg:space-y-4 text-[11px] font-black tracking-widest uppercase overflow-x-auto whitespace-nowrap scrollbar-none pt-1">
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Visão Geral') }}</a>
                <a href="{{ route('profile.pedidos') }}" class="{{ request()->routeIs('profile.pedidos') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Meus Pedidos') }}</a>
                <a href="{{ route('profile.notificacoes') }}" class="{{ request()->routeIs('profile.notificacoes') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Notificações') }}</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Configurações') }}</a>
            </nav>
        </div>

        <!-- Conteúdo Form Customizado -->
        <div class="lg:col-span-3 space-y-10">
            
            <div class="bg-white border border-gray-100 p-6 md:p-8">
                <h2 class="text-xs font-black uppercase tracking-widest text-black mb-6 border-b border-gray-50 pb-4">{{ __('Informações Cadastrais') }}</h2>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5 m-0">
                    @csrf
                    @method('patch')
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Nome') }}</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full border border-gray-300 p-3 text-sm font-bold rounded-none focus:outline-none focus:border-black transition-colors bg-transparent">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('E-mail') }}</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full border border-gray-300 p-3 text-sm font-bold rounded-none focus:outline-none focus:border-black transition-colors bg-transparent">
                    </div>
                    <button type="submit" class="bg-black text-white px-8 py-3.5 text-[10px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm">{{ __('Salvar Alterações') }}</button>
                </form>
            </div>

            <div class="bg-white border border-gray-100 p-6 md:p-8">
                <h2 class="text-xs font-black uppercase tracking-widest text-black mb-6 border-b border-gray-50 pb-4">{{ __('Alterar Senha') }}</h2>
                
                @if (session('status') === 'password-updated')
                    <div class="mb-4 p-3 bg-black text-white text-[10px] font-black uppercase tracking-widest">
                        {{ __('Senha atualizada com sucesso.') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5 m-0">
                    @csrf
                    @method('put')
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Senha Atual') }}</label>
                        <input type="password" name="current_password" required class="w-full border border-gray-300 p-3 text-sm font-bold rounded-none focus:outline-none focus:border-black transition-colors bg-transparent">
                        @error('current_password', 'updatePassword')
                            <span class="text-[9px] text-red-500 font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Nova Senha') }}</label>
                            <input type="password" name="password" required class="w-full border border-gray-300 p-3 text-sm font-bold rounded-none focus:outline-none focus:border-black transition-colors bg-transparent">
                            @error('password', 'updatePassword')
                                <span class="text-[9px] text-red-500 font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Confirmar Nova Senha') }}</label>
                            <input type="password" name="password_confirmation" required class="w-full border border-gray-300 p-3 text-sm font-bold rounded-none focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                    </div>
                    <button type="submit" class="bg-black text-white px-8 py-3.5 text-[10px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm">{{ __('Atualizar Senha') }}</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection