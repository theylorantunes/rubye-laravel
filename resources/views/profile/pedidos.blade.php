@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-5xl">
    <div class="mb-10 md:mb-12">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Minha Conta') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black">{{ __('Meus Pedidos') }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 border-b lg:border-b-0 lg:border-r border-gray-100 pb-6 lg:pb-0 lg:pr-6">
            <nav class="flex lg:flex-col gap-4 lg:space-y-4 text-[11px] font-black tracking-widest uppercase overflow-x-auto whitespace-nowrap scrollbar-none pt-1">
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Visão Geral') }}</a>
                <a href="{{ route('profile.pedidos') }}" class="{{ request()->routeIs('profile.pedidos') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Meus Pedidos') }}</a>
                <a href="{{ route('profile.notificacoes') }}" class="{{ request()->routeIs('profile.notificacoes') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Notificações') }}</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Configurações') }}</a>
            </nav>
        </div>

        <div class="lg:col-span-3 space-y-6">
            @forelse($pedidos as $pedido)
                <div class="border border-gray-200 p-6 hover:border-black transition-all">
                    <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">{{ __('Pedido') }}</span>
                            <span class="font-black uppercase text-lg">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">{{ __('Data') }}</span>
                            <span class="font-bold text-sm uppercase">{{ $pedido->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">{{ __('Status') }}</span>
                            <span class="px-3 py-1 bg-black text-white text-[9px] font-black uppercase tracking-widest">
                                {{ __($pedido->status) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-1">{{ __('Total') }}</span>
                            <span class="font-black text-lg text-black">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <h5 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 italic">{{ __('Itens do Pedido') }}:</h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($pedido->itens as $item)
                                <div class="flex items-center space-x-4 bg-gray-50 p-3">
                                    <img src="{{ $item->produto->imagem }}" class="w-12 h-12 object-contain mix-blend-multiply">
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
                <div class="text-center py-24 border border-dashed border-gray-200">
                    <p class="text-gray-400 uppercase tracking-widest font-bold text-[11px]">{{ __('Você ainda não realizou nenhum pedido.') }}</p>
                    <a href="{{ route('produtos.index') }}" class="mt-4 inline-block border-b border-black pb-0.5 font-black text-[10px] uppercase tracking-widest">
                        {{ __('Ir para a loja') }}
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection