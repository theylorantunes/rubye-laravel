@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-6 pt-32 pb-24 max-w-5xl">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-12">{{ __('Seu Carrinho') }}</h1>

    @if(session('carrinho'))
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2 space-y-8">
                @foreach(session('carrinho') as $id => $detalhes)
                    <div class="flex items-center justify-between border-b border-gray-100 pb-8">
                        <div class="flex items-center">
                            <img src="{{ $detalhes['imagem'] }}" class="w-20 h-24 object-cover bg-gray-100 p-2">
                            <div class="ml-6">
                                <h3 class="text-sm font-bold uppercase tracking-widest">{{ $detalhes['nome'] }}</h3>
                                <p class="text-xs text-gray-400 mt-1">R$ {{ number_format($detalhes['preco'], 2, ',', '.') }}</p>
                                
                                <form action="{{ route('carrinho.remover', $id) }}" method="POST" class="mt-4">
                                    @csrf @method('DELETE')
                                    <button class="text-[10px] font-bold uppercase tracking-tighter text-red-500 hover:underline">{{ __('Remover') }}</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-sm font-bold">
                            {{ $detalhes['quantidade'] }}x
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-gray-50 p-8 h-fit">
                <h2 class="text-lg font-black uppercase tracking-widest mb-6">{{ __('Resumo') }}</h2>
                <div class="flex justify-between mb-4 text-sm">
                    <span>{{ __('Subtotal') }}</span>
                    <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
                <div class="border-t border-gray-200 pt-4 flex justify-between font-black text-lg mb-8">
                    <span>TOTAL</span>
                    <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition">
                    {{ __('Finalizar Compra') }}
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <p class="text-gray-400 uppercase font-bold tracking-widest">{{ __('Seu carrinho está vazio') }}</p>
            <a href="{{ route('produtos.index') }}" class="inline-block mt-8 border-b-2 border-black pb-1 font-bold text-sm uppercase">{{ __('Ir para a loja') }}</a>
        </div>
    @endif
</div>
@endsection