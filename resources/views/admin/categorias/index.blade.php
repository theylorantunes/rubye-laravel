@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Categorias') }}</h1>
</div>

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
                <th class="p-4 text-[10px] uppercase font-black text-gray-400">ID</th>
                <th class="p-4 text-[10px] uppercase font-black text-gray-400">Nome</th>
                <th class="p-4 text-[10px] uppercase font-black text-gray-400">Slug</th>
                <th class="p-4 text-[10px] uppercase font-black text-gray-400 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 uppercase text-xs font-bold tracking-widest">
            @foreach($categorias as $cat)
            <tr>
                <td class="p-4 text-gray-400">#{{ $cat->id }}</td>
                <td class="p-4">{{ $cat->nome }}</td>
                <td class="p-4 text-gray-400">{{ $cat->slug }}</td>
                <td class="p-4 text-right">
                    <button class="text-red-500 hover:underline">Remover</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection