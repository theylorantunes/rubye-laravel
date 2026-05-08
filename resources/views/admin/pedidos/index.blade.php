@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Gestão de Pedidos') }}</h1>
    <p class="text-sm text-gray-500 uppercase font-bold tracking-widest mt-2">{{ __('Acompanhe as vendas e status de entrega') }}</p>
</div>

<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Pedido') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Cliente') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Data') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Total') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400 text-right">{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-xs uppercase tracking-widest">
            @forelse($pedidos as $pedido)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-4 font-black text-black">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td class="p-4 font-bold text-gray-600">{{ $pedido->user->name ?? __('Cliente Removido') }}</td>
                <td class="p-4 text-gray-400 font-bold">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-4 font-black text-black">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                <td class="p-4 text-right">
                    @if($pedido->status == 'pendente')
                        <span class="px-3 py-1 bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase border border-yellow-100">{{ __('Pendente') }}</span>
                    @elseif($pedido->status == 'pago')
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase border border-green-100">{{ __('Pago') }}</span>
                    @elseif($pedido->status == 'enviado')
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase border border-blue-100">{{ __('Enviado') }}</span>
                    @else
                        <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[10px] font-black uppercase border border-gray-200">{{ $pedido->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan=\"5\" class=\"p-20 text-center text-gray-400 uppercase text-xs font-bold tracking-widest\">
                    {{ __('Nenhum pedido realizado ainda.') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection