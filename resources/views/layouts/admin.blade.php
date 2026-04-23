<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUBYE Admin</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Pirata+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-logo { font-family: 'Pirata One', cursive; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 flex min-h-screen">

    <aside class="w-64 bg-[#111] text-white flex flex-col hidden md:flex fixed h-full z-20">
        <div class="p-6 border-b border-gray-800 flex items-center justify-center">
            <a href="{{ route('home') }}" class="text-4xl font-logo font-black tracking-widest text-white mt-2" target="_blank" title="Ver Loja">
                RUBYE <span class="text-[10px] font-sans text-gray-500 uppercase tracking-widest block text-center -mt-2">Admin</span>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-bold tracking-widest uppercase">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-white bg-gray-800 rounded-sm">
                <i class="fas fa-chart-line w-6"></i> {{ __('Dashboard') }}
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-sm transition-colors">
                <i class="fas fa-box w-6"></i> {{ __('Produtos') }}
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-sm transition-colors">
                <i class="fas fa-tags w-6"></i> {{ __('Categorias') }}
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-sm transition-colors">
                <i class="fas fa-shopping-bag w-6"></i> {{ __('Pedidos') }}
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center px-4 py-3 text-xs text-gray-400">
                <i class="fas fa-user-circle text-lg mr-3"></i>
                <div class="truncate w-full">
                    <p class="font-bold text-white uppercase tracking-widest truncate">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 bg-gray-50">
        <header class="bg-white border-b border-gray-200 p-6 flex justify-between items-center md:hidden">
            <span class="text-2xl font-logo font-black tracking-widest">RUBYE</span>
            <i class="fas fa-bars text-xl"></i>
        </header>

        <div class="p-8 lg:p-12 max-w-7xl mx-auto">
            @yield('conteudo')
        </div>
    </main>

</body>
</html>