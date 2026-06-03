@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-6xl">

    <h1 class="text-2xl md:text-4xl font-black uppercase tracking-tighter text-black mb-8 md:mb-12">
        {{ __('Finalizar Compra') }}
    </h1>

    @if(session('erro'))
        <div class="mb-8 p-4 bg-red-500 text-white text-[10px] font-black uppercase tracking-widest shadow-lg">
            ⚠️ {{ session('erro') }}
        </div>
    @endif

    <form action="{{ route('checkout.pagar') }}" method="POST" x-data="{ metodo_pagamento: 'CREDIT_CARD' }" class="m-0">
        @csrf

        <div class="flex flex-col-reverse lg:flex-row gap-8 lg:gap-12">
            <div class="w-full lg:w-2/3 space-y-8 md:space-y-12">
                
                <div class="bg-white border border-gray-200 p-5 md:p-8">
                    <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-5 border-b border-gray-100 pb-3">
                        1. {{ __('Dados do Cliente e Entrega') }}
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Nome Completo') }}</label>
                            <input type="text" name="nome" value="{{ Auth::user()->name ?? '' }}" required class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('E-mail') }}</label>
                            <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('CPF') }}</label>
                            <input type="text" name="cpf" required 
                                oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4').substring(0, 14)"
                                placeholder="000.000.000-00"
                                class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Celular') }}</label>
                            <input type="text" name="telefone" required 
                                oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3').substring(0, 15)"
                                placeholder="(00) 00000-0000"
                                class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">CEP</label>
                            <input type="text" name="cep" required 
                                oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{5})(\d)/, '$1-$2').substring(0, 9)"
                                placeholder="00000-000"
                                class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-5 md:p-8">
                    <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-5 border-b border-gray-100 pb-3">
                        2. {{ __('Método de Pagamento') }}
                    </h2>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <button type="button" @click="metodo_pagamento = 'CREDIT_CARD'" 
                                :class="metodo_pagamento === 'CREDIT_CARD' ? 'bg-black text-white border-black' : 'bg-white text-gray-400 border-gray-200'"
                                class="border-2 p-4 flex flex-col items-center justify-center gap-2 transition-colors cursor-pointer rounded-none font-black text-[11px] tracking-widest uppercase">
                            <i class="far fa-credit-card text-lg"></i>
                            <span>{{ __('Cartão de Crédito') }}</span>
                        </button>
                        <button type="button" @click="metodo_pagamento = 'PIX'" 
                                :class="metodo_pagamento === 'PIX' ? 'bg-black text-white border-black' : 'bg-white text-gray-400 border-gray-200'"
                                class="border-2 p-4 flex flex-col items-center justify-center gap-2 transition-colors cursor-pointer rounded-none font-black text-[11px] tracking-widest uppercase">
                            <i class="fas fa-qrcode text-lg"></i>
                            <span>{{ __('PIX Dinâmico') }}</span>
                        </button>
                    </div>

                    <input type="hidden" name="metodo_pagamento" :value="metodo_pagamento">
                    
                    <div x-show="metodo_pagamento === 'CREDIT_CARD'" x-cloak class="bg-gray-50 p-5 text-center border border-gray-200 text-gray-500 font-medium text-xs normal-case leading-relaxed mt-4">
                        <i class="fas fa-shield-alt text-xl text-black mb-3 block"></i>
                        {{ __('Para sua segurança e conformidade com as normas internacionais PCI-DSS, os dados do seu cartão serão preenchidos diretamente no ambiente criptografado da AbacatePay na próxima etapa.') }}
                    </div>

                    <div x-show="metodo_pagamento === 'PIX'" x-cloak class="bg-gray-50 p-5 text-center border border-gray-200 text-gray-500 font-medium text-xs normal-case leading-relaxed mt-4">
                        <i class="fas fa-bolt text-xl text-black mb-3 block"></i>
                        {{ __('O código de pagamento Copia e Cola e o QR Code serão gerados imediatamente na próxima tela. Você não sairá da loja.') }}
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-gray-50 border border-gray-200 p-6 md:p-8 sticky top-24">
                    <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-4 border-b border-gray-200 pb-3">
                        {{ __('Resumo do Pedido') }}
                    </h2>

                    <div class="max-h-40 overflow-y-auto divide-y divide-gray-100 pr-2 space-y-2 mb-4 scrollbar-none">
                        @foreach($carrinho as $item)
                            <div class="flex justify-between items-center text-[11px] font-bold uppercase tracking-widest py-1">
                                <span class="text-gray-500 truncate pr-4">{{ $item['quantidade'] }}x {{ $item['nome'] }}</span>
                                <span class="text-black whitespace-nowrap">R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-end">
                            <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">{{ __('Total') }}</span>
                            <span class="text-xl md:text-2xl font-black text-black tracking-tighter">
                                R$ {{ number_format($total, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-all active:scale-[0.98] shadow-lg cursor-pointer border-none">
                        {{ __('Finalizar Compra') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection