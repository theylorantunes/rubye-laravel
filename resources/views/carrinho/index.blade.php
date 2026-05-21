@extends('layouts.main')

@section('conteudo')
<div x-data="{ showDeleteModal: false, formId: null }" class="container mx-auto px-4 md:px-6 py-24 max-w-5xl">
    
    <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-black mb-12 ">
        {{ __('Seu Carrinho') }}
    </h1>

    @if(session('sucesso'))
        <div class="bg-black text-white p-4 mb-6 text-[10px] font-black uppercase tracking-widest ">
            {{ session('sucesso') }}
        </div>
    @endif

    @if(session('erro'))
        <div class="bg-red-500 text-white p-4 mb-6 text-[10px] font-black uppercase tracking-widest ">
            {{ session('erro') }}
        </div>
    @endif

    @if(count($carrinho) > 0)
        
        <div class="hidden md:block bg-white border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-[10px] uppercase font-black tracking-widest text-gray-400">
                        <th class="p-4 w-24">{{ __('Produto') }}</th>
                        <th class="p-4">{{ __('Detalhes') }}</th>
                        <th class="p-4 text-center">{{ __('Quantidade') }}</th>
                        <th class="p-4 text-right">{{ __('Subtotal') }}</th>
                        <th class="p-4 text-center">{{ __('Remover') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs font-bold uppercase tracking-widest text-black">
                    @foreach($carrinho as $id => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <div class="w-16 h-20 bg-gray-100 flex items-center justify-center p-2">
                                    <img src="{{ asset($item['imagem']) }}" alt="{{ $item['nome'] }}" class="w-full h-full object-contain mix-blend-multiply">
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="text-sm font-black text-black">{{ $item['nome'] }}</p>
                                <p class="text-gray-400 mt-1">R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center border border-gray-200 bg-white">
                                        
                                        <form id="form-desk-{{ $id }}" action="{{ route('carrinho.atualizar', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="quantidade" value="{{ $item['quantidade'] - 1 }}">
                                            <button type="submit" 
                                                    @click.prevent="if ({{ $item['quantidade'] }} === 1) { formId = 'form-desk-{{ $id }}'; showDeleteModal = true; } else { $el.closest('form').submit(); }"
                                                    class="px-3 py-2 text-gray-400 hover:text-black hover:bg-gray-100 transition-colors w-8 flex justify-center items-center cursor-pointer font-black text-sm">
                                                -
                                            </button>
                                        </form>

                                        <span class="w-8 text-center text-xs font-black">{{ $item['quantidade'] }}</span>

                                        <form action="{{ route('carrinho.atualizar', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="whitespace_fix" value="1">
                                            <input type="hidden" name="quantidade" value="{{ $item['quantidade'] + 1 }}">
                                            <button type="submit" class="px-3 py-2 text-gray-400 hover:text-black hover:bg-gray-100 transition-colors w-8 flex justify-center items-center cursor-pointer font-black text-sm">
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-right font-black">
                                R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('carrinho.remover', $id) }}" method="POST" class="inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="block md:hidden space-y-4">
            @foreach($carrinho as $id => $item)
                <div class="bg-white border border-gray-200 p-4 flex gap-4 relative">
                    <div class="w-20 h-24 bg-gray-50 border border-gray-100 flex items-center justify-center p-2 shrink-0">
                        <img src="{{ asset($item['imagem']) }}" alt="{{ $item['nome'] }}" class="w-full h-full object-contain mix-blend-multiply">
                    </div>

                    <div class="flex flex-col justify-between flex-1 text-xs uppercase tracking-widest font-bold">
                        <div>
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-black text-black text-xs line-clamp-2 leading-tight">{{ $item['nome'] }}</h3>
                                <form action="{{ route('carrinho.remover', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                            <p class="text-gray-400 text-[10px] mt-1">un: R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                        </div>

                        <div class="flex justify-between items-end mt-4">
                            
                            <div class="flex items-center border border-gray-200 bg-white">
                                <form id="form-mob-{{ $id }}" action="{{ route('carrinho.atualizar', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="quantidade" value="{{ $item['quantidade'] - 1 }}">
                                    <button type="submit" 
                                            @click.prevent="if ({{ $item['quantidade'] }} === 1) { formId = 'form-mob-{{ $id }}'; showDeleteModal = true; } else { $el.closest('form').submit(); }"
                                            class="px-3 py-1.5 text-gray-400 hover:text-black w-8 text-center font-black text-sm cursor-pointer">
                                        -
                                    </button>
                                </form>

                                <span class="w-6 text-center text-[11px] font-black text-black">{{ $item['quantidade'] }}</span>

                                <form action="{{ route('carrinho.atualizar', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="quantidade" value="{{ $item['quantidade'] + 1 }}">
                                    <button type="submit" class="px-3 py-1.5 text-gray-400 hover:text-black w-8 text-center font-black text-sm cursor-pointer">
                                        +
                                    </button>
                                </form>
                            </div>

                            <span class="font-black text-black text-right">
                                R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex flex-col items-end border-t border-gray-100 pt-8">
            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">{{ __('Total do Carrinho') }}</p>
            <p class="text-3xl md:text-4xl font-black  text-black tracking-tighter mb-8">
                R$ {{ number_format($total, 2, ',', '.') }}
            </p>
            
            <a href="{{ route('checkout') }}" class="w-full md:w-auto text-center bg-black text-white px-12 py-4 text-xs font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors shadow-lg">
                {{ __('Finalizar Compra') }}
            </a>
        </div>

    @else
        <div class="text-center py-20 bg-gray-50 border border-gray-100">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">{{ __('Seu carrinho está vazio.') }}</p>
            <a href="{{ route('produtos.index') }}" class="inline-block mt-6 border-b-2 border-black pb-1 text-[10px] font-black uppercase tracking-widest hover:text-gray-500 hover:border-gray-500 transition-colors">
                {{ __('Continuar Comprando') }}
            </a>
        </div>
    @endif

    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" 
         x-cloak
         style="display: none;">
        
        <div @click.away="showDeleteModal = false" 
             class="bg-white border-t-4 border-black w-full max-w-sm p-8 shadow-2xl text-center">
            
            <h3 class="text-sm font-black uppercase tracking-wider text-black  mb-8">
                {{ __('Quer remover o produto do carrinho?') }}
            </h3>

            <div class="flex gap-4 text-xs font-black uppercase tracking-widest">
                <button type="button" @click="document.getElementById(formId).submit(); showDeleteModal = false;" 
                        class="flex-1 bg-black text-white py-4 hover:bg-gray-800 transition-colors cursor-pointer">
                    {{ __('Sim') }}
                </button>
                <button type="button" @click="showDeleteModal = false" 
                        class="flex-1 border border-gray-200 text-gray-400 py-4 hover:border-black hover:text-black transition-colors cursor-pointer">
                    {{ __('Cancelar') }}
                </button>
            </div>
        </div>
    </div>

</div>
@endsection