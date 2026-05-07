@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Coleções') }}</h1>
</div>

<div class="bg-white p-6 border border-gray-200 mb-8 rounded-sm">
    <form action="{{ route('admin.colecoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Nome da Coleção') }}</label>
                <input type="text" name="nome" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0 uppercase tracking-widest">
            </div>
            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Imagem de Capa') }}</label>
                <input type="file" name="imagem" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-black file:uppercase file:bg-black file:text-white hover:file:bg-gray-800">
            </div>
            <div class="md:col-span-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Descrição (Opcional)') }}</label>
                <textarea name="descricao" rows="2" class="w-full border-gray-200 text-sm focus:border-black focus:ring-0"></textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            {{ __('Criar Coleção') }}
        </button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($colecoes as $colecao)
    <div class="bg-white border border-gray-200 rounded-sm p-4 flex items-center space-x-4">
        @if($colecao->imagem)
            <img src="{{ asset($colecao->imagem) }}" class="w-16 h-16 object-cover grayscale">
        @endif
        <div>
            <h3 class="font-black uppercase text-sm tracking-tight">{{ $colecao->nome }}</h3>
            <p class="text-[10px] text-gray-400 uppercase font-bold">{{ $colecao->descricao ?? 'Sem descrição' }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection