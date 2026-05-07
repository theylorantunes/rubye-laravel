@extends('layouts.admin')

@section('conteudo')
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black uppercase tracking-tight text-black">{{ __('Gestão de Produtos') }}</h1>
        <p class="text-sm text-gray-500 uppercase font-bold tracking-widest mt-2">{{ __('Visualize e gerencie seu estoque') }}</p>
    </div>
    
    <a href="{{ route('admin.produtos.create') }}" class="bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
        <i class="fas fa-plus mr-2"></i> {{ __('Novo Produto') }}
    </a>
</div>

<div class="mb-8">
    <form action="{{ route('admin.produtos.index') }}" method="GET" class="flex-1">
        <select name="categoria" onchange="this.form.submit()" 
                class="w-full bg-white border border-gray-200 text-xs font-bold uppercase tracking-widest p-3 focus:ring-0 focus:border-black transition-all">
            
            <option value="">{{ __('Todas as Categorias') }}</option>
            
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nome }}
                </option>
            @endforeach

        </select>
    </form>
</div>

<div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Imagem') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Nome') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Preço') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">{{ __('Estoque') }}</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400 text-right">{{ __('Ações') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($produtos as $produto)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-4">
                    <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" class="w-12 h-12 object-cover rounded-sm border border-gray-100">
                </td>
                <td class="p-4">
                    <p class="font-bold text-sm uppercase tracking-tight">{{ $produto->nome }}</p>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $produto->categoria->nome ?? 'Sem Categoria' }}</p>
                </td>
                <td class="p-4 font-mono text-sm">
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </td>
                <td class="p-4">
                    @if($produto->estoque > 0)
                        <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-sm border border-green-100">
                            {{ $produto->estoque }} {{ __('em estoque') }}
                        </span>
                    @else
                        <span class="px-2 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase rounded-sm border border-red-100">
                            {{ __('Esgotado') }}
                        </span>
                    @endif
                </td>
                <td class="p-4 text-right">
                    <div class="flex justify-end space-x-2">
                        <button class="text-gray-400 hover:text-black transition-colors" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-gray-400 hover:text-red-600 transition-colors" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-20 text-center text-gray-400 uppercase text-xs font-bold tracking-widest">
                    {{ __('Nenhum produto cadastrado até o momento.') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection