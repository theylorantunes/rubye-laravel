@extends('layouts.admin')

@section('conteudo')
<div class="mb-10">
    <a href="{{ route('admin.produtos.index') }}" class="text-[10px] uppercase font-black text-gray-400 hover:text-black mb-4 block transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> {{ __('Voltar para a listagem') }}
    </a>
    <h1 class="text-3xl font-black uppercase text-black tracking-tighter">{{ __('Novo Produto') }}</h1>
</div>

<form action="{{ url('admin/produtos/salvar') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 border border-gray-200 rounded-sm shadow-sm">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2 space-y-8">
            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Nome do Produto</label>
                <input type="text" name="nome" required class="w-full border-gray-200 focus:border-black focus:ring-0 uppercase font-bold text-sm py-3">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Preço (R$)</label>
                    <input type="number" step="0.01" name="preco" required class="w-full border-gray-200 focus:border-black focus:ring-0 font-mono py-3">
                </div>
                <div>
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Estoque Inicial</label>
                    <input type="number" name="estoque" required class="w-full border-gray-200 focus:border-black focus:ring-0 py-3">
                </div>
            </div>

            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Categoria Principal</label>
                <select name="categoria_id" required class="w-full border-gray-200 focus:border-black focus:ring-0 uppercase font-black text-[10px] py-3">
                    <option value="">{{ __('Selecione uma categoria') }}</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="space-y-8 lg:border-l lg:pl-12 border-gray-100">
            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Foto do Produto</label>
                <div class="border-2 border-dashed border-gray-100 p-6 text-center hover:border-black transition-colors cursor-pointer relative">
                    <input type="file" name="imagem" class="absolute inset-0 opacity-0 cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-gray-300 text-2xl mb-2"></i>
                    <p class="text-[10px] uppercase font-black text-gray-400">Clique para subir</p>
                </div>
            </div>

            <div>
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-400 block mb-3">Participa de Coleções?</label>
                <div class="space-y-3 bg-gray-50 p-4 border border-gray-100">
                    @foreach($colecoes as $col)
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="colecoes[]" value="{{ $col->id }}" class="rounded-none border-gray-300 text-black focus:ring-0">
                            <span class="text-[10px] uppercase font-bold text-gray-600 group-hover:text-black transition-colors">{{ $col->nome }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="mt-12 w-full bg-black text-white py-5 text-xs font-black uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-lg">
        {{ __('Cadastrar Produto no Sistema') }}
    </button>
</form>
@endsection