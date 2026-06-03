@extends('layouts.admin') <!-- Adapte para o nome do seu layout base, se for diferente -->

@section('conteudo')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <!-- Header -->
<a href="{{ url('admin/produtos') }}" class="text-[10px] md:text-xs text-gray-400 font-bold tracking-[0.2em] uppercase hover:text-black transition-colors mb-4 inline-block">
        &larr; VOLTAR PARA A LISTAGEM
    </a>
    <h1 class="text-3xl font-black uppercase tracking-tight text-black mb-8">NEW PRODUCT</h1>

    <form action="{{ route('admin.produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Grid Principal (2 Colunas) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- ========================================== -->
            <!-- COLUNA ESQUERDA (Info Básica + Coleções) -->
            <!-- ========================================== -->
            <div class="lg:col-span-8 flex flex-col gap-6">

                <!-- Bloco 1: Informações e Descrição -->
                <div class="bg-white border border-gray-200 p-6 sm:p-8">
                    
                    <!-- Nome -->
                    <div class="mb-6">
                        <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">NOME DO PRODUTO</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required 
                               class="w-full border border-gray-200 p-3 text-sm focus:outline-none focus:border-black transition-colors">
                    </div>

                    <!-- Preço e Estoque -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">PREÇO (R$)</label>
                            <input type="number" step="0.01" name="preco" value="{{ old('preco') }}" required 
                                   class="w-full border border-gray-200 p-3 text-sm focus:outline-none focus:border-black transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">ESTOQUE INICIAL</label>
                            <input type="number" name="estoque" value="{{ old('estoque') }}" required 
                                   class="w-full border border-gray-200 p-3 text-sm focus:outline-none focus:border-black transition-colors">
                        </div>
                    </div>

                    <!-- Descrição (CAMPO ADICIONADO) -->
                    <div>
                        <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">DESCRIÇÃO</label>
                        <textarea name="descricao" rows="6" required 
                                  class="w-full border border-gray-200 p-3 text-sm focus:outline-none focus:border-black transition-colors resize-y">{{ old('descricao') }}</textarea>
                    </div>
                </div>

                <!-- Bloco 2: Coleções -->
                <div class="bg-white border border-gray-200 p-6 sm:p-8">
                    <label class="block text-[10px] font-black tracking-[0.2em] text-black uppercase mb-4 border-b border-gray-100 pb-4">
                        PARTICIPA DE COLEÇÕES?
                    </label>
                    
                    <!-- Adapte a variável $colecoes conforme o seu Controller envia -->
                    <div class="flex flex-col gap-4 mt-4">
                        @foreach($colecoes as $colecao)
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="colecoes[]" value="{{ $colecao->id }}" 
                                   class="w-4 h-4 accent-black border-gray-300">
                            <span class="text-xs font-bold tracking-widest text-gray-700 uppercase">{{ $colecao->nome }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- COLUNA DIREITA (Imagem, Categoria, Submit) -->
            <!-- ========================================== -->
            <div class="lg:col-span-4 flex flex-col gap-6">

                <!-- Bloco 3: Imagem Principal -->
                <div class="bg-white border border-gray-200 p-6 sm:p-8">
                    <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-4 text-center">
                        FOTO DO PRODUTO
                    </label>

                    <!-- Área de Preview -->
                    <div class="w-full bg-gray-50 aspect-square border border-dashed border-gray-300 flex items-center justify-center mb-6 overflow-hidden relative">
                        <div class="text-center text-gray-400" id="image-placeholder">
                            <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                            <p class="text-[10px] font-bold tracking-widest uppercase">Sem Imagem</p>
                        </div>
                        <img id="image-preview" src="" class="hidden absolute inset-0 w-full h-full object-contain p-2">
                    </div>

                    <!-- Input nativo idêntico ao da tela de edição -->
                    <div class="flex items-center">
                        <input type="file" name="imagem" accept="image/*" required onchange="previewImage(event)"
                               class="w-full text-xs text-gray-500 
                                      file:mr-4 file:py-3 file:px-4 
                                      file:border-0 file:rounded-none
                                      file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                      file:bg-black file:text-white 
                                      hover:file:bg-gray-800 transition-colors cursor-pointer">
                    </div>
                </div>

                <!-- Bloco 4: Categoria -->
                <div class="bg-white border border-gray-200 p-6 sm:p-8">
                    <label class="block text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-4">
                        CATEGORIA PRINCIPAL
                    </label>
                    <div class="relative">
                        <select name="categoria_id" required 
                                class="w-full border border-gray-200 p-3 text-xs font-bold tracking-widest uppercase focus:outline-none focus:border-black transition-colors bg-white appearance-none cursor-pointer">
                            <option value="" disabled selected>SELECIONE...</option>
                            <!-- Adapte a variável $categorias conforme o seu Controller envia -->
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Bloco 5: Botão Salvar -->
                <button type="submit" class="w-full bg-black text-white px-6 py-5 text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm">
                    CADASTRAR PRODUTO NO SISTEMA
                </button>

            </div>
        </div>
    </form>
</div>

<!-- Script para exibir a imagem assim que o usuário selecioná-la do PC -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection