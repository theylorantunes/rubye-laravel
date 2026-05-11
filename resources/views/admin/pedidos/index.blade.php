@extends('layouts.admin')

@section('conteudo')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ selectedPedido: null }" class="relative">
    
    <div class="mb-10">
        <h1 class="text-3xl font-black uppercase text-black italic">{{ __('Gestão de Pedidos') }}</h1>
    </div>

    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-100 pb-6">
        @foreach($contagem as $status => $total)
            <a href="{{ route('admin.pedidos.index', ['status' => $status]) }}" 
               class="px-4 py-2 text-[10px] font-black uppercase tracking-widest border {{ request('status', 'Todos') == $status ? 'bg-black text-white border-black' : 'bg-white text-gray-400 border-gray-200 hover:border-black hover:text-black' }} transition-all">
                {{ $status }} ({{ $total }})
            </a>
        @endforeach
    </div>

    @if(session('sucesso'))
        <div class="bg-black text-white p-4 mb-6 text-[10px] font-black uppercase tracking-widest italic">
            {{ session('sucesso') }}
        </div>
    @endif

    @if(session('erro'))
        <div class="bg-red-500 text-white p-4 mb-6 text-[10px] font-black uppercase tracking-widest italic">
            {{ session('erro') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse text-[11px] uppercase tracking-widest font-bold">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-400">
                    <th class="p-4">Pedido</th>
                    <th class="p-4">Cliente</th>
                    <th class="p-4">Data</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pedidos as $pedido)
                <tr class="hover:bg-gray-50 cursor-pointer transition-colors" 
                    data-pedido="{{ $pedido->toJson() }}"
                    @click="selectedPedido = JSON.parse($el.getAttribute('data-pedido'))">
                    
                    <td class="p-4 font-black text-black">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-gray-600">{{ $pedido->user->name ?? 'Cliente Removido' }}</td>
                    <td class="p-4 text-gray-400">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-4 font-black text-black">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 {{ $pedido->status == 'Cancelado' ? 'bg-red-500' : 'bg-black' }} text-white text-[9px] font-black italic">
                            {{ $pedido->status }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <span class="text-gray-300"><i class="fas fa-chevron-right"></i></span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-20 text-center text-gray-400">Nenhum pedido encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <template x-if="selectedPedido">
        <div class="fixed inset-0 z-50 flex justify-end">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="selectedPedido = null"></div>
            
            <div class="relative w-full max-w-lg bg-white h-full shadow-2xl overflow-y-auto p-8 border-l-4 border-black flex flex-col" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0">
                
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-2xl font-black uppercase italic text-black">
                        Pedido <span x-text="'#' + String(selectedPedido.id).padStart(5, '0')"></span>
                    </h2>
                    <button @click="selectedPedido = null" class="text-gray-400 hover:text-black">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="flex justify-between mb-10 relative">
                    <div class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-100 -z-10"></div>
                    @php $fluxo = ['Aguardando', 'Confirmado', 'Preparando', 'Enviado', 'Entregue']; @endphp
                    @foreach($fluxo as $etapa)
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-4 h-4 rounded-full border-2 border-white shadow-sm transition-colors duration-500"
                             :class="['Aguardando', 'Confirmado', 'Preparando', 'Enviado', 'Entregue'].indexOf('{{ $etapa }}') <= ['Aguardando', 'Confirmado', 'Preparando', 'Enviado', 'Entregue'].indexOf(selectedPedido.status == 'Pedido Recebido' ? 'Aguardando' : selectedPedido.status) ? (selectedPedido.status == 'Cancelado' ? 'bg-red-500' : 'bg-black') : 'bg-gray-200'"></div>
                        <span class="text-[8px] font-black uppercase tracking-tighter" 
                              :class="(selectedPedido.status == '{{ $etapa }}' || (selectedPedido.status == 'Pedido Recebido' && '{{ $etapa }}' == 'Aguardando')) ? 'text-black font-black' : 'text-gray-300'">
                            {{ $etapa }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="mb-8 grid grid-cols-2 gap-4 border-y border-gray-100 py-6">
                    <div>
                        <h4 class="text-[10px] font-black uppercase text-gray-400 mb-2">Cliente</h4>
                        <p class="text-xs font-bold uppercase text-black" x-text="selectedPedido.user?.name || 'Removido'"></p>
                        <p class="text-[10px] text-gray-400" x-text="selectedPedido.user?.email || ''"></p>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black uppercase text-gray-400 mb-2">Pagamento</h4>
                        <p class="text-xs font-bold uppercase italic text-black">Cartão de Crédito</p>
                    </div>
                </div>

                <div class="mb-10">
                    <h4 class="text-[10px] font-black uppercase text-gray-400 mb-4 italic">Itens do Pedido</h4>
                    <div class="space-y-3">
                        <template x-for="item in selectedPedido.itens" :key="item.id">
                            <div class="flex justify-between items-center text-xs border-b border-gray-50 pb-2">
                                <span class="font-bold uppercase text-gray-600" x-text="item.quantidade + 'x ' + (item.produto?.nome || 'Produto Excluído')"></span>
                                <span class="font-black text-black" x-text="'R$ ' + parseFloat(item.preco_unitario).toLocaleString('pt-BR', {minimumFractionDigits: 2})"></span>
                            </div>
                        </template>
                    </div>
                    <div class="mt-6 flex justify-between items-center text-xl font-black italic text-black border-t border-gray-100 pt-4">
                        <span>TOTAL</span>
                        <span x-text="'R$ ' + parseFloat(selectedPedido.total).toLocaleString('pt-BR', {minimumFractionDigits: 2})"></span>
                    </div>
                </div>

                <div class="space-y-3 mt-auto pt-6 border-t border-gray-100">
                    <form :action="'/admin/pedidos/' + selectedPedido.id + '/avancar'" method="POST" 
                          x-show="selectedPedido.status != 'Entregue' && selectedPedido.status != 'Cancelado'">
                        @csrf
                        <button type="submit" class="w-full bg-black text-white py-4 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                            Avançar para Próxima Etapa
                        </button>
                    </form>

                    <div class="grid grid-cols-2 gap-3">
                        <form :action="'/admin/pedidos/' + selectedPedido.id + '/cancelar'" method="POST" 
                              x-show="selectedPedido.status != 'Entregue' && selectedPedido.status != 'Cancelado'">
                            @csrf
                            <button type="submit" class="w-full border border-red-500 text-red-500 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                Cancelar
                            </button>
                        </form>
                        
                        <button type="button" onclick="alert('Notificação enviada ao e-mail do cliente!')" 
                                class="w-full border border-gray-200 text-gray-400 py-3 text-[10px] font-black uppercase tracking-widest hover:border-black hover:text-black transition-all"
                                :class="{'col-span-2': selectedPedido.status == 'Entregue' || selectedPedido.status == 'Cancelado'}">
                            Notificar
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </template>

</div>
@endsection