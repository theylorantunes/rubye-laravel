@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 py-32 max-w-md flex flex-col justify-center min-h-[60vh]">
    <div class="bg-white border border-gray-200 p-8 shadow-sm">
        <h1 class="text-2xl font-black uppercase tracking-tighter text-black mb-6 ">
            {{ __('Atualizar Senha') }}
        </h1>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                    {{ __('E-mail') }}
                </label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                       class="w-full border border-gray-200 bg-gray-50 py-3 px-4 text-sm text-gray-500 cursor-not-allowed font-mono outline-none">
                
                @error('email')
                    <p class="text-[11px] text-red-600 font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                    {{ __('Nova Senha') }}
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full border border-gray-300 py-3 px-4 text-sm focus:outline-none focus:border-black transition-colors bg-transparent @error('password') border-red-500 @enderror">
                
                @error('password')
                    <p class="text-[11px] text-red-600 font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                    {{ __('Confirmar Senha') }}
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full border border-gray-300 py-3 px-4 text-sm focus:outline-none focus:border-black transition-colors bg-transparent">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors shadow-lg cursor-pointer">
                    {{ __('Redefinir Senha') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection