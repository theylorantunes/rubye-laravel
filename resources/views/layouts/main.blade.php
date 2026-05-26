<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUBYE Store</title>
    @vite(['resources/css/app.css'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Pirata+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-logo { font-family: 'Pirata One', cursive; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-gray-900 flex flex-col min-h-screen">
    
    <header class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm">
        <div class="container mx-auto px-4 md:px-6 py-4 md:py-6 flex justify-between items-center max-w-7xl">
            
            <a href="/" class="text-4xl md:text-6xl font-logo font-black tracking-widest text-black select-none transition-transform active:scale-95">
                RUBYE
            </a>

            <form action="{{ route('produtos.index') }}" method="GET" class="hidden md:flex flex-1 max-w-2xl mx-12 relative">
                <input type="text" name="busca" value="{{ request('busca') }}" 
                    placeholder="{{ __('O que você está procurando?') }}" 
                    class="w-full border-b border-gray-300 py-2 pr-10 text-sm focus:outline-none focus:border-black transition-colors bg-transparent">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-black hover:text-gray-500 transition-colors bg-transparent border-none cursor-pointer">
                    <i class="fas fa-search text-base"></i>
                </button>
            </form>

            <div class="flex items-center space-x-4 md:space-x-5 text-lg md:text-xl text-black">
                @php
                    $cartCount = 0;
                    foreach(session('carrinho', []) as $item) { $cartCount += $item['quantidade']; }
                @endphp

                <a href="{{ route('produtos.index') }}" class="block md:hidden hover:text-gray-500 transition p-1">
                    <i class="fas fa-search text-base"></i>
                </a>

                <a href="{{ route('carrinho.index') }}" class="hover:text-gray-500 flex items-center gap-1 transition p-1 relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text-xs md:text-sm font-bold tracking-tighter">({{ $cartCount }})</span>
                </a>

                @guest
                    <a href="{{ route('login') }}" class="hover:text-gray-500 transition p-1" title="{{ __('Entrar') }}">
                        <i class="far fa-user"></i>
                    </a>
                @endguest

                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center text-xs font-black uppercase tracking-widest text-red-600 hover:underline mr-2">
                            <i class="fas fa-lock-open mr-1"></i> {{ __('Painel Admin') }}
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-500 transition p-1" title="{{ __('Minha Conta') }}">
                        <i class="fas fa-user"></i>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                        @csrf
                        <button type="submit" class="hover:text-gray-500 transition bg-transparent border-none cursor-pointer p-1" title="{{ __('Sair') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>

        <nav class="border-t border-gray-50 bg-white overflow-x-auto scrollbar-none">
            <div class="container mx-auto px-4 py-3 flex justify-start md:justify-center space-x-8 md:space-x-12 text-[11px] md:text-[13px] font-black tracking-[0.15em] uppercase text-gray-800 whitespace-nowrap">
                <a href="{{ route('produtos.index') }}" class="hover:text-gray-400 transition-colors py-1">{{ __('Produtos') }}</a>
                <a href="{{ route('colecoes.public') }}" class="hover:text-gray-400 transition-colors py-1">{{ __('Coleções') }}</a>
                <a href="{{ route('sobre') }}" class="hover:text-gray-400 transition-colors py-1">{{ __('Sobre') }}</a>
                <a href="{{ route('contato') }}" class="hover:text-gray-400 transition-colors py-1">{{ __('Contato') }}</a>
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="inline-block sm:hidden text-red-600 hover:text-red-800 transition-colors py-1 font-black">{{ __('Admin') }}</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('conteudo')
    </main>

    <footer class="bg-[#2a2a2a] text-white py-12 mt-20 flex flex-col items-center justify-center">
        <p class="text-[13px] tracking-wide text-gray-300">© 2026 RUBYE Store. {{ __('Todos os direitos reservados.') }}</p>
        <div class="mt-6 text-gray-500 text-sm">
            <i class="fas fa-lock"></i>
        </div>
    </footer>
</body>
</html>