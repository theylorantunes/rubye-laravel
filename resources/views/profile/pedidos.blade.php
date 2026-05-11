@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-8 lg:px-12 max-w-7xl pt-16 pb-24">
    <div class="mb-12">
        <h4 class="text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Minha Conta') }}</h4>
        <h1 class="text-5xl font-black uppercase tracking-tight text-black">{{ __('Meus Pedidos') }}</h1>
    </div>

    <div class="space-y-6">
        @forelse($pedidos as $pedido)
            <div class="border border-gray-200 p-6 hover:border-black transition-all">
                <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">Pedido</span>
                        <span class="font-black uppercase text-lg">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">Data</span>
                        <span class="font-bold text-sm uppercase">{{ $pedido->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">Status</span>
                        <span class="px-3 py-1 bg-black text-white text-[9px] font-black uppercase tracking-widest">
                            {{ $pedido->status }}
                        </span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">Total</span>
                        <span class="font-black text-lg text-black">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h5 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 italic">Itens do Pedido:</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($pedido->itens as $item)
                            <div class="flex items-center space-x-4 bg-gray-50 p-3">
                                <img src="{{ asset($item->produto->imagem) }}" class="w-12 h-12 object-contain mix-blend-multiply">
                                <div>
                                    <p class="text-[10px] font-black uppercase text-black leading-tight">{{ $item->produto->nome }}</p>
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">{{ $item->quantidade }}x R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-24 border-2 border-dashed border-gray-100">
                <p class="text-gray-400 uppercase tracking-widest font-bold text-sm">{{ __('Você ainda não realizou nenhum pedido.') }}</p>
                <a href="{{ route('produtos.index') }}" class="mt-4 inline-block border-b-2 border-black pb-1 font-black text-[11px] uppercase tracking-widest">
                    {{ __('Ir para a loja') }}
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection