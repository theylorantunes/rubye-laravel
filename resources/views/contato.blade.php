@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 pt-12 md:pt-24 pb-16 md:pb-24 max-w-5xl">
    
    <div class="text-center mb-12 md:mb-20">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2 md:mb-4">{{ __('Fale Conosco') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black leading-none">{{ __('Suporte RUBYE') }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24">
        
        <div class="w-full order-1">
            <form action="#" method="POST" class="space-y-5 md:space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">{{ __('Nome Completo') }}</label>
                    <input type="text" class="w-full border-b border-gray-300 py-2.5 text-sm md:text-base focus:outline-none focus:border-black transition-colors bg-transparent rounded-none" required>
                </div>
                
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">{{ __('E-mail') }}</label>
                    <input type="email" class="w-full border-b border-gray-300 py-2.5 text-sm md:text-base focus:outline-none focus:border-black transition-colors bg-transparent rounded-none" required>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">{{ __('Assunto') }}</label>
                    <select class="w-full border-b border-gray-300 py-2.5 text-sm focus:outline-none focus:border-black transition-colors bg-transparent text-gray-700 rounded-none cursor-pointer">
                        <option value="pedidos">{{ __('Dúvida sobre Pedido') }}</option>
                        <option value="trocas">{{ __('Trocas e Devoluções') }}</option>
                        <option value="parcerias">{{ __('Parcerias / Imprensa') }}</option>
                        <option value="outros">{{ __('Outros Assuntos') }}</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">{{ __('Mensagem') }}</label>
                    <textarea rows="4" class="w-full border border-gray-300 p-3 text-sm focus:outline-none focus:border-black transition-colors bg-transparent rounded-none resize-none" required></textarea>
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black tracking-[0.15em] uppercase hover:bg-gray-800 transition-all active:scale-[0.98] mt-2 border-none">
                    {{ __('Enviar Mensagem') }}
                </button>
            </form>
        </div>

        <div class="w-full flex flex-col justify-start md:justify-center space-y-8 md:space-y-12 order-2 mt-4 md:mt-0">
            <div class="border-l-2 border-black pl-4">
                <h3 class="text-sm md:text-base font-black text-black uppercase mb-1.5">{{ __('Atendimento') }}</h3>
                <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                    Segunda a Sexta, das 09h às 18h.<br>
                    Não operamos em feriados nacionais.
                </p>
            </div>

            <div class="border-l-2 border-black pl-4">
                <h3 class="text-sm md:text-base font-black text-black uppercase mb-1.5">{{ __('E-mail Direto') }}</h3>
                <a href="mailto:contato@rubye.com" class="text-gray-500 text-xs md:text-sm hover:text-black transition-colors border-b border-gray-300 hover:border-black pb-0.5 font-bold">
                    contato@rubye.com
                </a>
            </div>

            <div class="border-l-2 border-black pl-4">
                <h3 class="text-sm md:text-base font-black text-black uppercase mb-3">{{ __('Redes Sociais') }}</h3>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-black transition-colors text-xl">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-black transition-colors text-xl">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-black transition-colors text-xl">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection