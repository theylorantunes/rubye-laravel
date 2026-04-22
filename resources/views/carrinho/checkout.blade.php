@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-6xl">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-12">{{ __('Finalizar Compra') }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.finalizar') }}" method="POST" class="space-y-12">
                @csrf

                <div>
                    <h2 class="text-lg font-black uppercase tracking-widest border-b border-gray-200 pb-4 mb-6">{{ __('Endereço de Entrega') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Rua e Número') }}</label>
                            <input type="text" required class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Cidade') }}</label>
                            <input type="text" required class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('CEP') }}</label>
                            <input type="text" required class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-black uppercase tracking-widest border-b border-gray-200 pb-4 mb-6">{{ __('Pagamento') }}</h2>
                    <div class="bg-gray-50 p-6 border border-gray-200 mb-6 flex items-center gap-4">
                        <input type="radio" checked class="text-black focus:ring-black">
                        <span class="text-sm font-bold uppercase tracking-widest">{{ __('Cartão de Crédito') }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Número do Cartão') }}</label>
                            <input type="text" placeholder="0000 0000 0000 0000" class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Validade') }}</label>
                            <input type="text" placeholder="MM/AA" class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('CVV') }}</label>
                            <input type="text" placeholder="123" class="w-full border-b border-gray-300 py-3 focus:outline-none focus:border-black transition-colors bg-transparent">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-5 text-[13px] font-bold tracking-[0.2em] uppercase hover:bg-gray-800 transition-colors shadow-lg mt-8">
                    {{ __('Confirmar Pagamento') }}
                </button>
            </form>
        </div>

        <div class="bg-gray-50 p-8 h-fit border border-gray-100">
            <h2 class="text-lg font-black uppercase tracking-widest border-b border-gray-200 pb-4 mb-6">{{ __('Seu Pedido') }}</h2>
            <div class="space-y-4 mb-6">
                @foreach($carrinho as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $item['quantidade'] }}x {{ $item['nome'] }}</span>
                        <span class="font-bold">R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-gray-200 pt-4 flex justify-between font-black text-xl">
                <span>TOTAL</span>
                <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
            </div>
        </div>

    </div>
</div>
@endsection