@extends('layouts.main')

@section('conteudo')
<div class="container mx-auto px-4 pt-12 pb-24 max-w-md">
    <div class="bg-white border border-gray-200 p-6 md:p-8 text-center shadow-sm">
        
        <div class="mb-6">
            <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-wallet text-lg"></i>
            </div>
            <h2 class="text-2xl font-black uppercase tracking-tight text-black">Pagamento via PIX</h2>
            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mt-1">Quase pronto! Escolha como pagar abaixo:</p>
        </div>

        <div class="bg-gray-50 border border-gray-200 p-4 mb-8 rounded-sm text-left" x-data="{ copied: false }">
            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">
                <i class="fas fa-copy mr-1"></i> Pix Copia e Cola
            </label>
            <div class="flex flex-col gap-2">
                <textarea id="pixCode" readonly class="w-full p-3 border border-gray-200 text-xs text-gray-600 bg-white font-mono rounded-none resize-none focus:outline-none focus:border-black h-16">{{ $pix['brCode'] }}</textarea>
                
                <button type="button" 
                        onclick="const txt = document.getElementById('pixCode'); txt.select(); txt.setSelectionRange(0, 99999); navigator.clipboard.writeText(txt.value); this.innerText = 'COPIADO!'; this.classList.add('bg-green-700'); setTimeout(() => { this.innerText = 'COPIAR CÓDIGO PIX'; this.classList.remove('bg-green-700'); }, 2000);" 
                        class="w-full bg-black text-white py-3.5 text-xs font-black tracking-widest uppercase transition-colors active:scale-[0.98] duration-100 cursor-pointer">
                    COPIAR CÓDIGO PIX
                </button>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6 mb-6">
            <button onclick="document.getElementById('qr-container').classList.toggle('hidden')" class="block md:hidden mx-auto text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors underline underline-offset-4 mb-4">
                Mostrar QR Code para Escanear
            </button>
            
            <div id="qr-container" class="hidden md:block space-y-4">
                <p class="text-xs text-gray-500 font-medium">Se estiver no computador, escaneie com o app do seu banco:</p>
                <div class="flex justify-center">
                    <img src="{{ $pix['brCodeBase64'] }}" alt="QR Code PIX" class="w-56 h-56 border p-2 bg-white mix-blend-multiply">
                </div>
            </div>
        </div>

        <form action="/checkout/simular/{{ $pix['id'] }}" method="POST" class="mt-8 border-t border-gray-100 pt-6">
            @csrf
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 text-xs font-black uppercase tracking-[0.2em] transition-colors shadow-md active:scale-[0.98]">
                Simular Pagamento (Apenas TCC)
            </button>
        </form>
        
    </div>
</div>
@endsection