@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24 max-w-5xl">
    <div class="mb-10 md:mb-12">
        <h4 class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase mb-2">{{ __('Minha Conta') }}</h4>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tight text-black">{{ __('Central de Notificações') }}</h1>
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

        <!-- Conteúdo -->
        <div class="lg:col-span-3 space-y-4">
            @php $hasNotifications = false; @endphp

            @auth
                @if(Auth::user()->email_verified_at)
                    @php $hasNotifications = true; @endphp
                    <div class="bg-white border border-gray-200 p-5 flex gap-4 shadow-sm relative overflow-hidden">
                        <div class="w-1.5 bg-black absolute left-0 top-0 h-full"></div>
                        <div class="text-gray-400 text-sm mt-0.5"><i class="fas fa-user-shield"></i></div>
                        <div class="flex-1 text-xs uppercase tracking-wider font-bold">
                            <div class="flex justify-between items-start">
                                <h3 class="font-black text-black text-[11px] md:text-xs">{{ __('Conta Verificada com Sucesso') }}</h3>
                                <span class="text-[9px] text-gray-400 font-mono">{{ Auth::user()->email_verified_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-gray-500 font-medium normal-case mt-2 leading-relaxed">
                                {{ __('Seu endereço de e-mail') }} <strong>{{ Auth::user()->email }}</strong> {{ __('foi validado via Resend. Sua conta está totalmente segura e pronta para compras.') }}
                            </p>
                        </div>
                    </div>
                @endif
            @endauth

            @foreach($pedidos as $pedido)
                @php $hasNotifications = true; @endphp
                <div class="bg-white border border-gray-200 p-5 flex gap-4 shadow-sm relative">
                    <div class="w-1.5 bg-gray-300 absolute left-0 top-0 h-full"></div>
                    <div class="text-gray-400 text-sm mt-0.5"><i class="fas fa-file-invoice"></i></div>
                    <div class="flex-1 text-xs uppercase tracking-wider font-bold">
                        <div class="flex justify-between items-start">
                            <h3 class="font-black text-black text-[11px] md:text-xs">{{ __('Pedido Recebido') }} #{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</h3>
                            <span class="text-[9px] text-gray-400 font-mono">{{ $pedido->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="text-gray-500 font-medium normal-case mt-2 leading-relaxed">
                            {{ __('Recebemos o seu pedido na RUBYE Store no valor de') }} <strong>R$ {{ number_format($pedido->total, 2, ',', '.') }}</strong>. {{ __('O gateway de pagamento está aguardando a compensação.') }}
                        </p>
                    </div>
                </div>

                @if($pedido->status != 'Pedido Recebido')
                    <div class="bg-white border border-gray-200 p-5 flex gap-4 shadow-sm relative">
                        @php
                            $corStatus = match($pedido->status) {
                                'Pagamento Confirmado' => 'bg-emerald-500',
                                'Cancelado' => 'bg-red-500',
                                default => 'bg-black'
                            };
                            $iconeStatus = match($pedido->status) {
                                'Pagamento Confirmado' => 'fa-check-circle',
                                'Cancelado' => 'fa-times-circle',
                                default => 'fa-box'
                            };
                        @endphp
                        <div class="w-1.5 {{ $corStatus }} absolute left-0 top-0 h-full"></div>
                        <div class="text-black text-sm mt-0.5"><i class="fas {{ $iconeStatus }}"></i></div>
                        <div class="flex-1 text-xs uppercase tracking-wider font-bold">
                            <div class="flex justify-between items-start">
                                <h3 class="font-black text-black text-[11px] md:text-xs">{{ __('Atualização') }}: {{ __($pedido->status) }}</h3>
                                <span class="text-[9px] text-gray-400 font-mono">{{ $pedido->updated_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-gray-500 font-medium normal-case mt-2 leading-relaxed">
                                {{ __('O status do seu pedido') }} <strong>#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</strong> {{ __('foi alterado para') }} <strong>{{ __($pedido->status) }}</strong> {{ __('no painel administrativo.') }}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach

            @if(!$hasNotifications)
                <div class="text-center py-16 bg-gray-50 border border-dashed border-gray-200">
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">{{ __('Você não possui nenhuma notificação no momento.') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection