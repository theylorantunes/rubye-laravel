@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-5xl">
    <div class="mb-10 md:mb-12">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Welcome Back') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black">{{ Auth::user()->name }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Menu Lateral Unificado e Dinâmico -->
        <div class="lg:col-span-1 border-b lg:border-b-0 lg:border-r border-gray-100 pb-6 lg:pb-0 lg:pr-6">
            <nav class="flex lg:flex-col gap-4 lg:space-y-4 text-[11px] font-black tracking-widest uppercase overflow-x-auto whitespace-nowrap scrollbar-none pt-1">
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Visão Geral') }}</a>
                <a href="{{ route('profile.pedidos') }}" class="{{ request()->routeIs('profile.pedidos') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Meus Pedidos') }}</a>
                <a href="{{ route('profile.notificacoes') }}" class="{{ request()->routeIs('profile.notificacoes') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Notificações') }}</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'text-black border-b-2 lg:border-b-0 lg:border-l-2 border-black pl-0 lg:pl-3 pb-1 lg:pb-0' : 'text-gray-400 hover:text-black transition-colors' }}">{{ __('Configurações') }}</a>
            </nav>
        </div>

        <!-- Conteúdo: Visão Geral -->
        <div class="lg:col-span-3 space-y-8">
            
            <div class="border border-gray-100 p-6 md:p-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-50 pb-4">
                    <h2 class="text-xs font-black uppercase tracking-widest text-black">{{ __('Account Summary') }}</h2>
                    <a href="{{ route('profile.edit') }}" class="text-[9px] text-gray-400 hover:text-black uppercase tracking-widest font-bold">{{ __('Edit') }}</a>
                </div>
                <div class="space-y-3 text-[11px] uppercase tracking-widest text-gray-500 font-bold">
                    <p><strong class="text-black">{{ __('Name') }}:</strong> <span class="normal-case font-medium">{{ Auth::user()->name }}</span></p>
                    <p><strong class="text-black">{{ __('Email') }}:</strong> <span class="normal-case font-medium">{{ Auth::user()->email }}</span></p>
                    <p><strong class="text-black">{{ __('Member since') }}:</strong> <span class="font-medium">{{ Auth::user()->created_at->format('d/m/Y') }}</span></p>
                </div>
            </div>

            <div class="border border-gray-100 p-6 md:p-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-50 pb-4">
                    <h2 class="text-xs font-black uppercase tracking-widest text-black">{{ __('Recent Orders') }}</h2>
                </div>
                @php
                    $recentOrders = Auth::user()->pedidos()->latest()->take(3)->get();
                @endphp
                @if($recentOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="flex justify-between items-center border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                                <div>
                                    <p class="text-[11px] font-black uppercase tracking-widest text-black">{{ __('Pedido') }} #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $order->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[11px] font-black text-black">R$ {{ number_format($order->total, 2, ',', '.') }}</p>
                                    <p class="text-[9px] font-black uppercase tracking-widest mt-1 {{ $order->status === 'Cancelado' ? 'text-red-500' : 'text-gray-400' }}">
                                        {{ __($order->status) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ __('Nenhum pedido recente.') }}</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection