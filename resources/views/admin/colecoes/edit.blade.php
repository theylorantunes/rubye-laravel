@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <a href="{{ route('admin.colecoes.index') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i> {{ __('Voltar para Coleções') }}
    </a>
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Editar Coleção') }}</h1>
</div>

<div class="bg-white p-8 border border-gray-200 rounded-sm max-w-4xl">
    <form action="{{ route('admin.colecoes.update', $colecao->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Nome da Coleção') }}</label>
                    <input type="text" name="nome" value="{{ $colecao->nome }}" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0 uppercase tracking-widest">
                </div>
                
                <div>
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Descrição') }}</label>
                    <textarea name="descricao" rows="4" class="w-full border-gray-200 text-sm focus:border-black focus:ring-0">{{ $colecao->descricao }}</textarea>
                </div>
            </div>

            <div class="space-y-6">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block">{{ __('Capa Atual') }}</label>
                @if($colecao->imagem)
                    <img src="{{ asset($colecao->imagem) }}" class="w-full h-48 object-cover grayscale mb-4">
                @endif
                
                <div>
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Substituir Imagem') }}</label>
                    <input type="file" name="imagem" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-black file:uppercase file:bg-black file:text-white hover:file:bg-gray-800">
                </div>
            </div>
        </div>

        <button type="submit" class="mt-8 bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            {{ __('Atualizar Coleção') }}
        </button>
    </form>
</div>
@endsection