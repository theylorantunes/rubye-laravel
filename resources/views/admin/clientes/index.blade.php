@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black ">{{ __('Base de Clientes') }}</h1>
</div>

<div class="bg-white border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse text-[11px] uppercase tracking-widest font-bold">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-400">
                <th class="p-4">{{ __('Cliente') }}</th>
                <th class="p-4">{{ __('E-mail') }}</th>
                <th class="p-4 text-center">{{ __('Pedidos') }}</th>
                <th class="p-4 text-right">{{ __('Total Gasto (LTV)') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($clientes as $cliente)
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-black">{{ $cliente->name }}</td>
                <td class="p-4 text-gray-500">{{ $cliente->email }}</td>
                <td class="p-4 text-center text-black">{{ $cliente->pedidos_count }}</td>
                <td class="p-4 text-right font-black text-black">
                    R$ {{ number_format($cliente->ltv_total, 2, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-20 text-center text-gray-400">{{ __('Nenhum cliente registrado.') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection