@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 py-32 max-w-md flex flex-col justify-center min-h-[60vh]">
    <div class="bg-white border border-gray-200 p-8 shadow-sm">
        <h1 class="text-2xl font-black uppercase tracking-tighter text-black mb-4 ">
            {{ __('Esqueceu sua senha?') }}
        </h1>
        
        <p class="text-xs text-gray-500 uppercase tracking-wider leading-relaxed mb-6">
            {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá escolher uma nova.') }}
        </p>

        @if (session('status'))
            <div class="mb-6 p-4 bg-gray-50 border border-black text-xs font-bold uppercase tracking-widest text-black">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                    {{ __('E-mail') }}
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 py-3 px-4 text-sm focus:outline-none focus:border-black transition-colors bg-transparent @error('email') border-red-500 @enderror">
                
                @error('email')
                    <p class="text-[11px] text-red-600 font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors shadow-lg cursor-pointer">
                    {{ __('Enviar Link de Redefinição') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection