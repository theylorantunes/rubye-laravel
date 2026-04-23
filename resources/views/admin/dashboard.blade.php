@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase tracking-tight text-black">{{ __('Painel de Controle') }}</h1>
    <p class="text-sm text-gray-500 uppercase font-bold tracking-widest mt-2">{{ __('Visão geral da sua loja') }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    
    <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm flex items-center justify-between">
        <div>
            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">{{ __('Total de Produtos') }}</p>
            <h2 class="text-3xl font-black">{{ $totalProdutos }}</h2>
        </div>
        <div class="w-12 h-12 bg-gray-50 flex items-center justify-center text-gray-400 rounded-full">
            <i class="fas fa-box text-xl"></i>
        </div>
    </div>

    <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm flex items-center justify-between">
        <div>
            <p class="text-[10px] text-red-400 uppercase font-bold tracking-widest mb-1">{{ __('Esgotados') }}</p>
            <h2 class="text-3xl font-black text-red-500">{{ $produtosEsgotados }}</h2>
        </div>
        <div class="w-12 h-12 bg-red-50 flex items-center justify-center text-red-400 rounded-full">
            <i class="fas fa-exclamation-triangle text-xl"></i>
        </div>
    </div>

    <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-sm flex items-center justify-between">
        <div>
            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">{{ __('Clientes Registrados') }}</p>
            <h2 class="text-3xl font-black">{{ $totalClientes }}</h2>
        </div>
        <div class="w-12 h-12 bg-gray-50 flex items-center justify-center text-gray-400 rounded-full">
            <i class="fas fa-users text-xl"></i>
        </div>
    </div>

</div>

<div class="bg-white border border-gray-100 shadow-sm rounded-sm p-8 text-center py-20">
    <i class="fas fa-tools text-4xl text-gray-200 mb-4"></i>
    <h3 class="text-lg font-black uppercase tracking-widest mb-2">{{ __('Pronto para Gerenciar') }}</h3>
    <p class="text-sm text-gray-500 max-w-md mx-auto">{{ __('Nas próximas etapas, iremos construir a tabela de gestão de produtos com opções de criar, editar e excluir itens diretamente do banco de dados.') }}</p>
</div>
@endsection