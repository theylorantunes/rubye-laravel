<!DOCTYPE html>
<html lang="pt-BR">
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
    
    <header class="bg-white">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center max-w-7xl">
            <a href="/" class="text-6xl font-logo font-black tracking-widest text-black mt-2">RUBYE</a>

            <div class="hidden md:flex flex-1 max-w-2xl mx-12 relative">
                <input type="text" placeholder="O que você está procurando?" class="w-full border-b border-gray-300 py-2 text-sm focus:outline-none focus:border-black transition-colors bg-transparent">
                <button class="absolute right-0 top-2 text-black hover:text-gray-600">
                    <i class="fas fa-search text-lg"></i>
                </button>
            </div>

            <div class="flex items-center space-x-5 text-xl text-black">
                <a href="/carrinho" class="hover:text-gray-500 flex items-center gap-1 transition">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text-sm font-bold tracking-tighter">(0)</span>
                </a>
                <a href="/admin" class="hover:text-gray-500 transition"><i class="fas fa-user"></i></a>
                <a href="#" class="hover:text-gray-500 transition"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <nav class="border-b border-gray-100">
            <div class="container mx-auto px-4 pb-4 flex justify-center space-x-12 text-[13px] font-bold tracking-[0.15em] uppercase text-gray-800">
                <a href="/" class="hover:text-gray-400 transition">Produtos</a>
                <a href="#" class="hover:text-gray-400 transition">Coleções</a>
                <a href="#" class="hover:text-gray-400 transition">Sobre Nós</a>
                <a href="#" class="hover:text-gray-400 transition">Contato</a>
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('conteudo')
    </main>

    <footer class="bg-[#2a2a2a] text-white py-12 mt-20 flex flex-col items-center justify-center">
        <p class="text-[13px] tracking-wide text-gray-300">© 2026 RUBYE Store. Todos os direitos reservados.</p>
        <div class="mt-6 text-gray-500 text-sm">
            <i class="fas fa-lock"></i>
        </div>
    </footer>

</body>
</html>