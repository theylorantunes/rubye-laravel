@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-6xl">

    <h1 class="text-2xl md:text-4xl font-black uppercase tracking-tighter text-black mb-8 md:mb-12">
        {{ __('Finalizar Compra') }}
    </h1>

    <div class="flex flex-col-reverse lg:flex-row gap-8 lg:gap-12">
        
        <div class="w-full lg:w-2/3">
            <form action="{{ route('carrinho.finalizar') }}" method="POST" id="checkout-form" class="space-y-8 md:space-y-12">
                @csrf

                <div class="bg-white border border-gray-200 p-5 md:p-8">
                    <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-5 border-b border-gray-100 pb-3">
                        1. {{ __('Endereço de Entrega') }}
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Nome Completo') }}</label>
                            <input type="text" name="nome" required class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">CEP</label>
                            <input type="text" name="cep" required 
                                oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{5})(\d)/, '$1-$2').substring(0, 9)"
                                placeholder="00000-000"
                                class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Rua e Número') }}</label>
                            <input type="text" name="endereco" required class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-5 md:p-8">
                    <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-5 border-b border-gray-100 pb-3">
                        2. {{ __('Pagamento') }}
                    </h2>
                    
                    <div class="space-y-5 md:space-y-6">
                        <div>
                            <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Número do Cartão') }}</label>
                            <input type="text" name="cartao" required 
                                    oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').substring(0, 19)"
                                    placeholder="0000 0000 0000 0000"
                                    class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none focus:outline-none focus:border-black bg-transparent transition-colors font-mono">
                        </div>

                        <div class="grid grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">{{ __('Validade') }}</label>
                                <input type="text" name="validade" required 
                                    oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{2})(\d)/, '$1/$2').substring(0, 5)"
                                    placeholder="MM/AA"
                                    class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none text-center focus:outline-none focus:border-black bg-transparent transition-colors font-mono">
                            </div>
                            <div>
                                <label class="block text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">CVV</label>
                                <input type="text" name="cvv" required 
                                    oninput="this.value = this.value.replace(/\D/g, '').substring(0, 3)"
                                    placeholder="123"
                                    class="w-full border border-gray-300 py-3 px-4 text-sm md:text-base rounded-none text-center focus:outline-none focus:border-black bg-transparent transition-colors font-mono">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 border border-gray-200 p-6 md:p-8 sticky top-24">
                <h2 class="text-xs md:text-sm font-black uppercase tracking-widest text-black mb-4 border-b border-gray-200 pb-3">
                    {{ __('Seu Pedido') }}
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

                <form action="{{ route('checkout.pagar') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-all active:scale-[0.98] shadow-lg cursor-pointer border-none">
                        Finalizar Compra
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection