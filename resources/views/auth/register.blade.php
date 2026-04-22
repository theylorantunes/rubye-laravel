@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-32 max-w-md">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black uppercase tracking-tight text-black">{{ __('Cadastrar') }}</h1>
        <p class="text-sm text-gray-500 mt-3">{{ __('Crie sua conta RUBYE') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Nome Completo') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div>
            <label for="email" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('E-mail') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div>
            <label for="password" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Senha') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Confirmar Senha') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-800">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
        </div>

        <button type="submit" class="w-full bg-black text-white py-5 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-lg mt-8">
            {{ __('Cadastrar') }}
        </button>
    </form>

    <div class="text-center mt-12 border-t border-gray-100 pt-8">
        <p class="text-sm text-gray-600">
            {{ __('Já possui uma conta?') }} 
            <a href="{{ route('login') }}" class="font-bold text-black hover:text-gray-600 transition-colors uppercase tracking-widest text-[11px] ml-2 underline underline-offset-4">
                {{ __('Entrar') }}
            </a>
        </p>
    </div>

</div>
@endsection