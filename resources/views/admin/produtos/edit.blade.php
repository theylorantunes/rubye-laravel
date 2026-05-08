@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <a href="{{ route('admin.produtos.index') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i> {{ __('Voltar para Produtos') }}
    </a>
    <h1 class="text-3xl font-black uppercase text-black">{{ __('Editar Produto') }}</h1>
</div>

<form action="{{ route('admin.produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 border border-gray-200 rounded-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Nome do Produto') }}</label>
                        <input type="text" name="nome" value="{{ $produto->nome }}" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0 uppercase tracking-widest">
                    </div>
                    
                    <div>
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Preço (R$)') }}</label>
                        <input type="number" step="0.01" name="preco" value="{{ $produto->preco }}" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0">
                    </div>

                    <div>
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Estoque Atual') }}</label>
                        <input type="number" name="estoque" value="{{ $produto->estoque }}" required class="w-full border-gray-200 text-sm focus:border-black focus:ring-0">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-2">{{ __('Descrição') }}</label>
                        <textarea name="descricao" rows="5" class="w-full border-gray-200 text-sm focus:border-black focus:ring-0">{{ $produto->descricao }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 border border-gray-200 rounded-sm">
                <h3 class="text-[10px] uppercase font-black tracking-widest text-black mb-6 border-b pb-4">{{ __('Vincular às Coleções') }}</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($colecoes as $colecao)
                        <label class="flex items-center space-x-3 p-3 border border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors">
                            <input type="checkbox" name="colecoes[]" value="{{ $colecao->id }}" 
                                {{ $produto->colecoes->contains($colecao->id) ? 'checked' : '' }}
                                class="rounded-none border-gray-300 text-black focus:ring-0">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-600">{{ $colecao->nome }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-8 border border-gray-200 rounded-sm text-center">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-4">{{ __('Imagem Principal') }}</label>
                <div class="mb-6 bg-gray-50 p-4">
                    <img src="{{ asset($produto->imagem) }}" class="max-h-64 mx-auto mix-blend-multiply">
                </div>
                <input type="file" name="imagem" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-black file:uppercase file:bg-black file:text-white hover:file:bg-gray-800">
            </div>

            <div class="bg-white p-8 border border-gray-200 rounded-sm">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-4">{{ __('Categoria') }}</label>
                <select name="categoria_id" class="w-full border-gray-200 text-xs font-bold uppercase tracking-widest focus:ring-0 focus:border-black">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ $produto->categoria_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-black text-white py-4 text-xs font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-lg">
                {{ __('Salvar Alterações') }}
            </button>
        </div>

    </div>
</form>
@endsection