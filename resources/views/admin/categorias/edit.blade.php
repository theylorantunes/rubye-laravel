@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <a href="{{ route('admin.categorias.index') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i> {{ __('Voltar para Categorias') }}
    </a>
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Editar Categoria') }}</h1>
</div>

<div class="bg-white p-8 border border-gray-200 rounded-sm max-w-2xl">
    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Nome da Categoria') }}</label>
            <input type="text" name="nome" value="{{ $categoria->nome }}" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0 uppercase tracking-widest">
        </div>

        <button type="submit" class="bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            {{ __('Salvar Alterações') }}
        </button>
    </form>
</div>
@endsection