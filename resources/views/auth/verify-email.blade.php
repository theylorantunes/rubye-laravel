<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-[40vh] text-center px-4">
        
        <!-- Logo da Marca -->
        <div class="mb-8 select-none">
            <span class="text-5xl font-black tracking-widest uppercase font-logo text-black block">RUBYE</span>
            <span class="text-[9px] uppercase tracking-[0.3em] text-gray-400 block -mt-1 font-sans font-bold">Verificação de Conta</span>
        </div>

        <div class="mb-6 text-xs text-gray-500 uppercase tracking-wider leading-relaxed max-w-sm">
            {{ __('Obrigado por se cadastrar na RUBYE! Antes de explorarmos a loja, confirme seu endereço de e-mail clicando no link que acabamos de enviar para você.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-8 p-4 bg-black text-white text-[10px] font-black uppercase tracking-widest w-full max-w-sm shadow-md">
                {{ __('Um novo link de verificação foi enviado para o e-mail cadastrado.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col items-center gap-6 w-full max-w-sm">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full m-0">
                @csrf
                <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-all active:scale-[0.98] shadow-lg cursor-pointer border-none">
                    {{ __('Reenviar E-mail de Verificação') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full m-0">
                @csrf
                <button type="submit" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-red-600 transition-colors underline underline-offset-4 bg-transparent border-none cursor-pointer">
                    {{ __('Sair da Conta') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>