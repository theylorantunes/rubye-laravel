@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-5xl">
    
    <div class="text-center mb-20">
        <h4 class="text-sm text-gray-400 font-bold tracking-[0.2em] uppercase mb-4">{{ __('Fale Conosco') }}</h4>
        <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ __('Suporte RUBYE') }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24">
        
        <div class="w-full">
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Nome Completo') }}</label>
                    <input type="text" class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent" required>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('E-mail') }}</label>
                    <input type="email" class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Assunto') }}</label>
                    <select class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent text-gray-700">
                        <option value="pedidos">{{ __('Dúvida sobre Pedido') }}</option>
                        <option value="trocas">{{ __('Trocas e Devoluções') }}</option>
                        <option value="parcerias">{{ __('Parcerias / Imprensa') }}</option>
                        <option value="outros">{{ __('Outros Assuntos') }}</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Mensagem') }}</label>
                    <textarea rows="4" class="w-full border border-gray-300 p-4 focus:outline-none focus:border-black transition-colors bg-transparent resize-none" required></textarea>
                </div>

                <button type="submit" class="w-full bg-black text-white py-5 text-[13px] font-bold tracking-[0.15em] uppercase hover:bg-gray-800 transition-colors mt-4">
                    {{ __('Enviar Mensagem') }}
                </button>
            </form>
        </div>

        <div class="w-full flex flex-col justify-center space-y-12">
            <div>
                <h3 class="text-lg font-bold text-black uppercase mb-2">{{ __('Atendimento') }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Segunda a Sexta, das 09h às 18h.<br>
                    Não operamos em feriados nacionais.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-black uppercase mb-2">{{ __('E-mail Direto') }}</h3>
                <a href="mailto:contato@rubye.com" class="text-gray-600 text-sm hover:text-black transition-colors border-b border-transparent hover:border-black pb-1">
                    contato@rubye.com
                </a>
            </div>

            <div>
                <h3 class="text-lg font-bold text-black uppercase mb-2">{{ __('Redes Sociais') }}</h3>
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