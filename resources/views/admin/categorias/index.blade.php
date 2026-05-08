@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Categorias') }}</h1>
    <p class="text-sm text-gray-500 uppercase font-bold tracking-widest mt-2">{{ __('Gerencie as divisões da sua vitrine') }}</p>
</div>

@if(session('sucesso'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline text-xs font-bold uppercase tracking-widest">{{ session('sucesso') }}</span>
    </div>
@endif

<div class="bg-white p-6 border border-gray-200 mb-8 rounded-sm">
    <form action="{{ route('admin.categorias.store') }}" method="POST" class="flex gap-4 items-end">
        @csrf
        <div class="flex-1">
            <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Novo Nome de Categoria') }}</label>
            <input type="text" name="nome" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0 uppercase tracking-widest">
        </div>
        <button type="submit" class="bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            {{ __('Adicionar') }}
        </button>
    </form>
</div>

<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">ID</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">Nome</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400">Slug</th>
                <th class="p-4 text-[10px] uppercase font-black tracking-widest text-gray-400 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-xs font-bold tracking-widest uppercase">
            @foreach($categorias as $cat)
            <tr class="hover:bg-gray-50 transition-colors {{ $cat->ativo ? '' : 'opacity-50' }}">
                <td class="p-4 text-gray-400">#{{ $cat->id }}</td>
                <td class="p-4 text-black">{{ $cat->nome }}</td>
                <td class="p-4 text-gray-400">{{ $cat->slug }}</td>
                <td class="p-4 text-right">
                    <div class="flex justify-end items-center space-x-3">
                        <a href="{{ route('admin.categorias.toggle', $cat->id) }}" 
                           class="text-[10px] font-black uppercase px-3 py-1 text-white {{ $cat->ativo ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                            {{ $cat->ativo ? __('Desativar') : __('Ativar') }}
                        </a>
                        <a href="{{ route('admin.categorias.edit', $cat->id) }}" class="text-gray-400 hover:text-black transition-colors" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection