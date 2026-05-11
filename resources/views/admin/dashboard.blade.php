@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Dashboard') }}</h1>
    <p class="text-sm text-gray-500 uppercase font-bold tracking-widest mt-2">{{ __('Visão geral do seu império') }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <div class="bg-white border border-gray-200 p-6">
        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-2">Faturamento Total</span>
        <span class="text-2xl font-black text-black">R$ {{ number_format($totalVendas, 2, ',', '.') }}</span>
    </div>
    <div class="bg-white border border-gray-200 p-6">
        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-2">Total de Pedidos</span>
        <span class="text-2xl font-black text-black">{{ $qtdPedidos }}</span>
    </div>
    <div class="bg-white border border-gray-200 p-6">
        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-2">Produtos Ativos</span>
        <span class="text-2xl font-black text-black">{{ $qtdProdutos }}</span>
    </div>
    <div class="bg-white border border-gray-200 p-6 {{ $estoqueBaixo->count() > 0 ? 'bg-red-50 border-red-100' : '' }}">
        <span class="text-[10px] font-black uppercase tracking-widest {{ $estoqueBaixo->count() > 0 ? 'text-red-400' : 'text-gray-400' }} block mb-2">Estoque Crítico</span>
        <span class="text-2xl font-black {{ $estoqueBaixo->count() > 0 ? 'text-red-600' : 'text-black' }}">{{ $estoqueBaixo->count() }}</span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white border border-gray-200 p-8">
        <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-8 border-b pb-4 italic">Vendas nos últimos 7 dias</h3>
        <canvas id="vendasChart" height="120"></canvas>
    </div>

    <div class="bg-white border border-gray-200 p-8">
        <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-6 border-b pb-4 italic">Alerta de Estoque</h3>
        <div class="space-y-4">
            @forelse($estoqueBaixo as $prod)
                <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                    <span class="text-[10px] font-bold uppercase text-gray-600">{{ $prod->nome }}</span>
                    <span class="text-[10px] font-black text-red-600 bg-red-50 px-2 py-1">{{ $prod->estoque }} UN</span>
                </div>
            @empty
                <p class="text-[10px] text-gray-400 uppercase font-bold italic">Tudo sob controle.</p>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('vendasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($vendasSeteDias->pluck('data')) !!},
            datasets: [{
                label: 'Vendas (R$)',
                data: {!! json_encode($vendasSeteDias->pluck('total')) !!},
                borderColor: '#000',
                backgroundColor: 'rgba(0, 0, 0, 0.05)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection