@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-32 max-w-md">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black uppercase tracking-tight text-black">{{ __('Entrar') }}</h1>
        <p class="text-sm text-gray-500 mt-3">{{ __('Acesse sua conta RUBYE') }}</p>
    </div>

    <x-auth-session-status class="mb-4 text-green-600 text-sm font-bold text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf
        
        <div>
            <label for="email" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('E-mail') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div>
            <label for="password" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Senha') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:ring-black" name="remember">
                <span class="ml-2 text-xs text-gray-600">{{ __('Lembrar de mim') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-gray-500 hover:text-black transition-colors underline underline-offset-4" href="{{ route('password.request') }}">
                    {{ __('Esqueci minha senha') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-black text-white py-5 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-lg mt-8">
            {{ __('Entrar') }}
        </button>
    </form>

    <div class="text-center mt-12 border-t border-gray-100 pt-8">
        <p class="text-sm text-gray-600">
            {{ __('Não tem uma conta?') }} 
            <a href="{{ route('register') }}" class="font-bold text-black hover:text-gray-600 transition-colors uppercase tracking-widest text-[11px] ml-2 underline underline-offset-4">
                {{ __('Cadastrar') }}
            </a>
        </p>
    </div>

</div>
@endsection